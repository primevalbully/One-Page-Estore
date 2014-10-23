<?php 
 //initialize the session
  if (!isset($_SESSION)) {
    session_start();
}

//Make a connection to the database.
$mysql = new mysqli("localhost", "ChinChinMonster", "one4PBchaos!", "metcdatabase");
if($mysql->connect_errno)
{
	echo "An error has occured, please try again.";
	exit;
}; 

//The following $variables are taken from the user input fields
//The $elementid represents a single input value that the user
   //is attempting to change and it is easily captured by setting 
   //$_POST['id'] based on the id which should have been set for 
   //target HTML tag.
//The $newValue variable is simply the captured data entered by
   //the suer.
$elementid = $mysql->real_escape_string(trim($_POST['id']));
$newValue = $mysql->real_escape_string(trim($_POST['value']));
$customerid = $mysql->real_escape_string($_SESSION['MM_UserGroup']);

//This query updates the user's information in the database 
$query = "UPDATE uspass SET $elementid = \"$newValue\" WHERE customerid = $customerid";
$result = $mysql->query($query);

//Whereas this query retrieves these updated details which 
   //are then sent back to the browser where the user can instantly
   //see the updated information.
$query2 = "SELECT * FROM uspass WHERE customerid = $customerid";
$result2 = $mysql->query($query2);
$row = $result2->fetch_object();
echo $row->$elementid;
sleep(1); 
?>
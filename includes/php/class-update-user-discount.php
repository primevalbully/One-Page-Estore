<?php 
 //initialize the session
  if (!isset($_SESSION)) {
    session_start();
}

//Make a connection to the database.
$mysqli = new mysqli("localhost", "ChinChinMonster", "one4PBchaos!", "metcdatabase");
if($mysqli->connect_errno)
{
	echo "done fucked up";
	exit;
}; 

//The following $variables are taken from the user input fields
//The $elementid represents a single input value that the user
   //is attempting to change and it is easily captured by setting 
   //$_POST['id'] based on the id which should have been set for 
   //target HTML tag.
//The $newValue variable is simply the captured data entered by
   //the suer.
$discountID = $mysqli->real_escape_string( trim($_POST['id']) );
$applied = $mysqli->real_escape_string( trim($_POST['applied']) );
$customerid = $mysqli->real_escape_string( trim($_SESSION['MM_UserGroup']) );

//This query updates the user's information in the database 
$query = "UPDATE discounts_customer SET applied = '$applied' WHERE id = $discountID AND customerid = $customerid";
$result = $mysqli->query($query);
//Whereas this query retrieves the just updated details which 
   //is then sent back to the browser where the user can instantly
   //see the updated information.
?>
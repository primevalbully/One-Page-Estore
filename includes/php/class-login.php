<?php require_once('metcdb.php'); ?>
<?php include('cs5_function.php'); ?>
<?php
 //initialize the session
  if (!isset($_SESSION)) {
    session_start();
}
/*
Written by Joe Abi Raad
http://joeabiraad.com
joe.abiraad@gmail.com

Happy Coding :D
*/	
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
  
// $action = "login.php";	 
// $action=trim($_GET['action']);
// switch($action) {
	// case 'login';
	 	$username = trim($_POST['username']);
		$password =trim($_POST['password']);
		$password = sha1($password);
		mysql_select_db($database_metcdb, $metcdb);
		$login_query = sprintf("SELECT * FROM uspass WHERE username = %s AND password = %s",
			GetSQLValueString($username, "text"),
			GetSQLValueString($password, "text"));
		$login = mysql_query($login_query, $metcdb) 
			or die(mysql_error());
			$customerid = mysql_result($login, 0, 'customerid');
			$row_login_query = mysql_fetch_assoc($login);
		//declare two session variables and assign them
		$_SESSION['MM_Username'] = $username;
        $_SESSION['MM_UserGroup'] = $customerid;		
		//$sub = trim($_POST['sub']);
		$msg="Email and password do not match";	
		$loginFoundUser = mysql_num_rows($login);
  			if($loginFoundUser) {
				# REGISTER SESSION HERE	
		   echo 'You are Now logged in as: ' . $_SESSION['MM_Username'] . " ID: " . $_SESSION['MM_UserGroup'] = $customerid;
		   
		   
		    } else {
		   echo $msg;
		}
		
		// echo 'Oops...Something went wrong, please try resubmiting the login form.';
		// echo $_POST['username'] . "<br>";
		// echo $_POST['password'] . "<br>";
}
sleep(1);

//#check if the mail is valid
//function fun_isemail($strng){
 //return preg_match('/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/i',$strng);
//}
?>
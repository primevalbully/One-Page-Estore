<?php require_once('../../Connections/metcdb.php'); ?>
<?php include('../../php/cs5_function.php'); ?>
<?php

if(!isset($_SESSION)) {
	session_start();
}
  include("../../php/securimage.php");
  $img = new Securimage();
  $valid = $img->check($_POST['code']);
  if($valid == true) {
	  
$colname_rs_discounts_db = "-1";
if (isset($_POST['discount_code'])) {
  $colname_rs_discounts_db = $_POST['discount_code'];
}
mysql_select_db($database_metcdb, $metcdb);
$query_rs_discounts_db = sprintf("SELECT * FROM discounts_database WHERE discount_code = %s", GetSQLValueString($colname_rs_discounts_db, "text"));
$rs_discounts_db = mysql_query($query_rs_discounts_db, $metcdb) or die(mysql_error());
$row_rs_discounts_db = mysql_fetch_assoc($rs_discounts_db);
$totalRows_rs_discounts_db = mysql_num_rows($rs_discounts_db);

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_UserGroup'])) {
  $colname_Recordset1 = $_SESSION['MM_UserGroup'];
}
mysql_select_db($database_metcdb, $metcdb);
$query_Recordset1 = sprintf("SELECT * FROM discounts_customer WHERE customerid = %s AND discount_code = %s", GetSQLValueString($colname_Recordset1, "int"),
GetSQLValueString($_POST['discount_code'], "text"));
$Recordset1 = mysql_query($query_Recordset1, $metcdb) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$_SESSION['expiration_date'] = $row_rs_discounts_db['expiration_date'];

$_SESSION['multiple_use'] = $row_rs_discounts_db['multiple_use'];
$_SESSION['combinable'] = $row_rs_discounts_db['combinable'];
$_SESSION['life_of_discount']= $row_rs_discounts_db['life_of_discount'];
$_SESSION['type'] = $row_rs_discounts_db['type'];
$_SESSION['amount'] = $row_rs_discounts_db['amount'];
?>
<?php
$_SESSION['E_not_logged_in'] = NULL;
$_SESSION['E_not_submitted'] = NULL;
$_SESSION['E_no_matches'] = NULL;
$_SESSION['M_open'] = NULL;
$_SESSION['E_do_have'] = NULL;
$_SESSION['M_added'] = NULL;
$_SESSION['E_not_added'] = NULL;
unset($_SESSION['E_not_logged_in']);
unset($_SESSION['E_not_submitted']);
unset($_SESSION['E_no_matches']);
unset($_SESSION['M_open']);
unset($_SESSION['E_do_have']);
unset($_SESSION['M_added']);
unset($_SESSION['E_not_added']);

if(!isset($_SESSION['MM_UserGroup'])) {
	$_SESSION['E_not_logged_in'] = "You must be logged in to register a discount.";		
}

if((@$_POST['discount_code'] == "")  && (isset($_POST["hidden"])) ) {
	$_SESSION['E_not_submitted'] = "Please make sure to enter a discount code before clicking submit.";	
}

if(($totalRows_rs_discounts_db == 0) && (isset($_POST["hidden"]) && ($_POST["hidden"] == "hidden"))) {
	$_SESSION['E_no_matches'] = "We're sorry, but we couldn't find any matches for the code you entered.";		
}
   
if((!isset($_POST["hidden"]) OR ($_POST["hidden"] !== "hidden")) && (!isset($row_rs_discount_db) OR !isset($customerid) OR !isset($discount_code) OR !isset($multiple_use) OR !isset($life_of_discount))) {
	exit();
}

?>
<?php 
   $row_rs_discounts_db['id'];

    $discount_name = htmlentities($row_rs_discounts_db['discount_name'], ENT_QUOTES);  
    $discount_code = htmlentities($row_rs_discounts_db['discount_code'], ENT_QUOTES); 
    "<br />";
    $row_rs_discounts_db['date_entered'];
    "<br />";
    $row_rs_discounts_db['expiration_date'];
    $row_rs_discounts_db['multiple_use'];
    $row_rs_discounts_db['website_max_use'];
    $row_rs_discounts_db['life_of_discount'];
    "Your search returned " . $totalRows_rs_discounts_db . " result.";   
?>
<?php   
    $row_Recordset1['id'];
    $customerid=$_SESSION['MM_UserGroup'];
    "<span class=\"p_blue\" />" . ($discount_code) . "</span>";
    "<span class=\"p_red\">";
    $life_of_discount=$_SESSION['life_of_discount'];
   
   //calculate expiration of discount by adding the timestamp and life_of_discount together.
   $timestamp = @mktime();
   $total_time = $timestamp + $life_of_discount;
     //convert exp_date to a viewable format.
	 $format = ('%B %d, %Y, %I:%M %p');
    $expiration_date = strftime($format, $total_time); 
    
    strtoupper($multiple_use=$_SESSION['multiple_use']);
 
if(($totalRows_Recordset1 < 1) ) {
	$chk_records = "true";
	$_SESSION['M_open']= 'You currently do not have this discount!';	
} else{
	$chk_records = "false";
	$_SESSION['E_do_have'] = 'Our records show you already have this discount.';	
}
   $combinable = $_SESSION['combinable'];
   $applied = "NO";
  if(($_SERVER['REQUEST_METHOD'] == "POST") && (isset($_POST["hidden"]) && ($_POST["hidden"] == "hidden")) && $chk_records == "true" && (isset($discount_name) && isset($customerid) && isset($discount_code) && isset($multiple_use) && isset($life_of_discount))) {
   $check = "true";
   $insert = "INSERT INTO discounts_customer (discount_name, customerid, discount_code, applied, date_obtained, expiration_date) VALUES('$discount_name', '$customerid', '$discount_code', '$applied', NOW(), '$expiration_date')";
   
   } else{
	   $check = "false";
   }
   if((($check == "true") && isset($_SESSION['MM_UserGroup'])) AND @mysql_query($insert, $metcdb)) {
	   $_SESSION['M_added'] = 'This discount has been added to your account!';
	   
	   $updateGoTo = "../add_discount.php";
	     if(isset($_SERVER['QUERY_STRING'])) {
			 $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
			 $updateGoTo .= $_SERVER['QUERY_STRING'];
			 }
			 header(sprintf("Location: %s", $updateGoTo));
   } else {
	  $_SESSION['E_not_added'] = 'We are sorry, but your discount could not be added.';
	   
	   $updateGoTo = "../add_disc_error.php";
	     if(isset($_SERVER['QUERY_STRING'])) {
			 $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
			 $updateGoTo .= $_SERVER['QUERY_STRING'];
			 }
			 header(sprintf("Location: %s", $updateGoTo));
   }
 

mysql_free_result($rs_discounts_db);

mysql_free_result($Recordset1);
  } else {
	  $_SESSION['E_incorrect_captcha'] = "The Captcha code you entered was not a match, please try resubmitting a new code.";
  	   $updateGoTo = "../add_disc_error.php";
	     if(isset($_SERVER['QUERY_STRING'])) {
			 $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
			 $updateGoTo .= $_SERVER['QUERY_STRING'];
			 }
			 header(sprintf("Location: %s", $updateGoTo));
}

?>
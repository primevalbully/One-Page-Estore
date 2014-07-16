<?php
 //initialize the session
  if (!isset($_SESSION)) {
    session_start();
  }
  $colname_rs_uspass = "-1";
  if (isset($_SESSION['MM_UserGroup'])) {
	$colname_rs_uspass = $_SESSION['MM_UserGroup'];
  }   
  mysql_select_db($database_metcdb, $metcdb);
  $query_rs_uspass = sprintf("SELECT * FROM uspass WHERE customerid = %s", GetSQLValueString($colname_rs_uspass, "int"));
  $rs_uspass = mysql_query($query_rs_uspass, $metcdb) or die(mysql_error());
  $row_rs_uspass = mysql_fetch_assoc($rs_uspass);
  $totalRows_rs_uspass = mysql_num_rows($rs_uspass); 
  $colname_rs_discounts = "-1";
  if (isset($_SESSION['MM_UserGroup'])) {
	$colname_rs_discounts = $_SESSION['MM_UserGroup'];
  }  
  mysql_select_db($database_metcdb, $metcdb);
  $query_rs_discounts = sprintf("SELECT * FROM discounts_customer WHERE customerid = %s", GetSQLValueString($colname_rs_discounts, "int"));
  $rs_discounts = mysql_query($query_rs_discounts, $metcdb) or die(mysql_error());
  $row_rs_discounts = mysql_fetch_assoc($rs_discounts);
  $totalRows_rs_discounts = mysql_num_rows($rs_discounts);
  //this code allows the user to apply or unapply a discount code within their account.
  if((isset($_POST["change"])) && ($_POST["change"] == "change")) {
	$updateSQL = sprintf("UPDATE discounts_customer SET applied=%s WHERE id=%s",
						 GetSQLValueString($_POST['applied'], "text"),
						 GetSQLValueString($_POST['id'], "id")); 
	mysql_select_db($database_metcdb, $metcdb);
	$Result1 = mysql_query($updateSQL, $metcdb) or die(mysql_error());  
	$updateGoTo = "../../myaccount/personal_info.php";
	if (isset($_SERVER['QUERY_STRING'])) {
	  $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
	  $updateGoTo .= $_SERVER['QUERY_STRING'];
	}
	header(sprintf("Location: %s", $updateGoTo));
  }
  $colname_query = "-1";
  if (isset($_SESSION['MM_UserGroup'])) {
	$colname_query = $_SESSION['MM_UserGroup'];
  }
  mysql_select_db($database_metcdb, $metcdb);
  $db_join = sprintf("SELECT discounts_customer.id, discounts_customer.customerid, discounts_database.discount_name, discounts_customer.discount_code, discounts_database.type, discounts_database.amount, discounts_customer.applied, discounts_customer.date_obtained, discounts_customer.expiration_date, discounts_database.multiple_use, discounts_database.combinable, discounts_database.life_of_discount FROM discounts_database LEFT JOIN discounts_customer ON discounts_database.discount_name = discounts_customer.discount_name WHERE discounts_customer.customerid = %s", GetSQLValueString($colname_query, "int"));
  $query = mysql_query($db_join, $metcdb) or die(mysql_error());
  $row_query = mysql_fetch_assoc($query);
  $totalRows_query = mysql_num_rows($query);  
  /* if(empty($totalRows_rs_uspass)) {
		header('Location: register_or_login.php');
		exit();
	} 
  */  
  if ($_SERVER['SERVER_PORT']!=443)
  {
  $url = "https://". $_SERVER['SERVER_NAME'] . ":443".$_SERVER['REQUEST_URI'];
  header("Location: $url");
  }
?>
<?php 
  if((isset($_SESSION['MM_UserGroup']) && $_SESSION['MM_UserGroup'] !== '')) {
	$buttonValue = "Sign Out";
	$url = "logout.php";	
  } else {
	$buttonValue = "Sign In";
	$url = "test.php";
  }; 
?>
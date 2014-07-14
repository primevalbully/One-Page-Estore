<?php 
 //initialize the session
  if (!isset($_SESSION)) {
    session_start();
}
  $colname_rsd = "-1";
if (isset($_SESSION['MM_UserGroup'])) {
  $colname_rsd = $_SESSION['MM_UserGroup'];
}	
mysql_select_db($database_metcdb, $metcdb);
$query_rsd = sprintf("SELECT discounts_customer.*, discounts_database.type, discounts_database.amount, discounts_database.multiple_use, discounts_database.combinable FROM discounts_customer, discounts_database WHERE discounts_customer.discount_code = discounts_database.discount_code && customerid = %s", GetSQLValueString($colname_rsd, "int"));
$rsd = mysql_query($query_rsd, $metcdb) or die(mysql_error());
$row_rsd = mysql_fetch_assoc($rsd);
$totalRows_rsd = mysql_num_rows($rsd);
  
  if(is_array($row_rsd)) {

  $MAYBE = 0;
  $YES = 0;
  $NO = 0;
  $SOMETIMES = 0;
  //tallys the number of discounts that can be categorized by these four different
  //possible combinations.
  do {
   if(($row_rsd['applied'] == "YES") && ($row_rsd['combinable'] == "YES")) {
	    $MAYBE += 1;
   } 
   if(($row_rsd['applied'] == "YES") && ($row_rsd['combinable'] == "NO")) {
	    $YES += 1;
   } 
   if(($row_rsd['applied'] == "NO") && ($row_rsd['combinable'] == "NO")) {
	    $NO += 1;
   } 
   if(($row_rsd['applied'] == "NO") && ($row_rsd['combinable'] == "YES")) {
	    $SOMETIMES += 1;
   }  
  } while($row_rsd = mysql_fetch_assoc($rsd));
  }

  $colname_Recordset1 = "-1";
if (isset($_SESSION['MM_UserGroup'])) {
  $colname_Recordset1 = $_SESSION['MM_UserGroup'];
  $applied = "NO";
  $combinable = "NO";
}
mysql_select_db($database_metcdb, $metcdb);
$query_no_no = sprintf("SELECT discounts_customer.*, discounts_database.type, discounts_database.amount, discounts_database.multiple_use, discounts_database.combinable FROM discounts_customer, discounts_database WHERE discounts_customer.discount_code = discounts_database.discount_code && customerid = %s && applied = %s && combinable = %s", GetSQLValueString($colname_Recordset1, "int"),@GetSQLValueString($applied, "text"),@GetSQLValueString($combinable, "text"));
$no_no = mysql_query($query_no_no, $metcdb) or die(mysql_error());
$row_no_no = mysql_fetch_assoc($no_no);
$totalRows_no_no = mysql_num_rows($no_no);
  
  return
?>
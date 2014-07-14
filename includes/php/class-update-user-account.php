<?php 
require_once('../Connections/metcdb.php'); 
include('cs5_function.php');

 //initialize the session
  if (!isset($_SESSION)) {
    session_start();
}
$elementid = trim($_POST['id']);
$newValue = trim($_POST['value']);
$customerid = $_SESSION['MM_UserGroup'];
  $updateSQL = "UPDATE uspass SET $elementid='$newValue' WHERE customerid='$customerid'";

  mysql_select_db($database_metcdb, $metcdb);
  $Result1 = mysql_query($updateSQL, $metcdb) or die(mysql_error());
  

mysql_select_db($database_metcdb, $metcdb);
$uspass = "SELECT * FROM uspass WHERE customerid='$customerid'";
$uspass_query = mysql_query($uspass, $metcdb) or die(mysql_error()); 
$row_uspass = mysql_fetch_assoc($uspass_query);
echo $row_uspass[$elementid];

?>
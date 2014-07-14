<?php 
require_once('metcdb.php'); ?>
<?php include('cs5_function.php'); ?>

<!--<script src="http://myeccentrictees.zymichost.com/js/google.js" type="text/javascript"></script>  -->
<?php
  //initialize the session
  if (!isset($_SESSION)) {
    session_start();
}
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  $_SESSION['item_sub_total'] = NULL;
  $_SESSION['total_items'] = NULL;
  $_SESSION['total_price'] = NULL;
  $_SESSION['totalRows_rs_cart_items'] = NULL;
  $_SESSION['quantity'] = NULL;
  $_SESSION['email'] = NULL;
  
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
  unset($_SESSION['item_sub_total']);
  unset($_SESSION['total_items']);
  unset($_SESSION['total_price']);
  unset($_SESSION['totalRows_rs_cart_items']);
  unset($_SESSION['quantity']);
  unset($_SESSION['email']);
  $_SESSION = array();
  session_destroy();

  $insertGoTo = "login.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo)); 
  sleep(1);
?>
  

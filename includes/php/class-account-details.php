<?php

if (! isset( $_SESSION )) {
	session_start();
}

//function getAccountDetails() {
	$customerid = $_SESSION['MM_UserGroup'];
$mysqli = new mysqli( "localhost", "ChinChinMonster", "one4PBchaos!", "metcdatabase" );
if( $mysqli->connect_errno ) {
	echo "Database connection not made.";
	exit();
} 
$query = "SELECT * FROM uspass WHERE customerid = " . $customerid;
$result = $mysqli->query( $query );
$row = $result->fetch_assoc();
echo $newJSON = json_encode( $row );
/*
$colname_rs_uspass = "-1";
if (isset( $_SESSION['MM_UserGroup'] )) {
	$colname_rs_uspass = $_SESSION['MM_UserGroup'];
}


mysql_select_db( $database_metcdb, $metcdb );
$uspass = sprintf( "SELECT * FROM uspass WHERE customerid = %s", GetSQLValueString( $colname_rs_uspass, "int" ) );
$uspass_query = mysql_query( $uspass, $metcdb ) or die( mysql_error() );
$row_uspass = mysql_fetch_assoc( $uspass_query );
echo $json_row_uspass = json_encode( $row_uspass );
$json_row_uspass; // echo json_encode(array("name"=>"John","time"=>"2pm","boys"=>"Penis","girls"=>"vagina"));

$colname_rs_discounts = "-1";
if (isset( $_SESSION['MM_UserGroup'] )) {
	$colname_rs_discounts = $_SESSION['MM_UserGroup'];
}

mysql_select_db( $database_metcdb, $metcdb );
$query_rs_discounts = sprintf( "SELECT * FROM discounts_customer WHERE customerid = %s", GetSQLValueString( $colname_rs_discounts, "int" ) );
$rs_discounts = mysql_query( $query_rs_discounts, $metcdb ) or die( mysql_error() );
$row_rs_discounts = mysql_fetch_assoc( $rs_discounts );
// $json_row_rs_discounts = json_encode($row_rs_discounts);
// $arrays_joined = array_merge($row_uspass, $row_rs_discounts);
// json_encode($arrays_joined);*/
//}
?>
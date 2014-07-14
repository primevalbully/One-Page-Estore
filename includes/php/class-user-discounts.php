<?php require_once('metcdb.php'); ?>
<?php include('cs5_function.php'); ?>
<?php
if(!isset($_SESSION)) {
	session_start();
}  

//$colname_rs_discounts = "-1";
//if (isset($_SESSION['MM_UserGroup'])) {
  //$colname_rs_discounts = $_SESSION['MM_UserGroup'];
//}
/*$customerid = 2;
mysql_select_db($database_metcdb, $metcdb);
$query_rs_discounts = sprintf('SELECT * FROM discounts_customer WHERE customerid = 2');
$rs_discounts = mysql_query($query_rs_discounts, $metcdb) or die(mysql_error());
$row_rs_discounts = mysql_fetch_assoc($rs_discounts);
echo $json_row_rs_discounts = json_encode($row_rs_discounts);*/
//$arrays_joined = array_merge($row_uspass, $row_rs_discounts);
//json_encode($arrays_joined);

$customerid = "-1";
if(isset($_SESSION['MM_UserGroup']))
{
	$customerid = $_SESSION['MM_UserGroup'];
}

mysql_select_db($database_metcdb, $metcdb);
$db_join = sprintf("SELECT discounts_customer.id, discounts_customer.customerid, discounts_database.discount_name, discounts_customer.discount_code, discounts_database.type, discounts_database.amount, discounts_customer.applied, discounts_customer.date_obtained, discounts_customer.expiration_date, discounts_database.multiple_use, discounts_database.combinable, discounts_database.life_of_discount FROM discounts_database LEFT JOIN discounts_customer ON discounts_database.discount_name = discounts_customer.discount_name WHERE discounts_customer.customerid = %s", GetSQLValueString($customerid, "int"));
$query = mysql_query($db_join, $metcdb) or die(mysql_error());

//$row = mysql_fetch_assoc($query);
$json = array();

    while($row=mysql_fetch_row($query)){
        $test_data[]=$row;
    }
    $json['aaData']=$test_data;

$encoded = json_encode($json);
echo $encoded;

mysql_close($metcdb);
/*
$names['id'] = array();
while($e = mysql_fetch_assoc($query)) {
   $names['id'][] = $e['id'];
}
print(json_encode($names));
echo "Fuck yOU!" . "<br><br>";
$arr = array();
while($row = mysql_fetch_assoc($query)) {
    $arr[] = $row; 
}
echo json_encode($arr);

$row_query = mysql_fetch_assoc($query);
do {
	//echo "<br><strong>Discount id = 18 should print the discount code (xmas2013): ";
	//print_r( $row_query['id'] );
	//echo "</strong><br>";
	$merged_discount_array = array($merged_discount_array);
	$merged_discount_array = array_merge($merged_discount_array, $row_query);
	//print_r($row_query);
	//echo "<br><br>";
	//print_r($merged_discount_array);
	//echo "<br><br>";
} while($row_query = mysql_fetch_assoc($query));

//convert data to json encoded values.

echo $json_row_rs_discounts = json_encode($merged_discount_array);

$json = 'get yo JSON';
$array = json_decode($json, true); // The `true` says to parse the JSON into an array,
                                   // instead of an object.
foreach($array['workers']['myemail@gmail.com'] as $stat => $value) {
  // Do what you want with the stats
  echo "$stat: $value<br>";
}
*/
?>
<?php
 
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

if (! isset ( $_SESSION )) {
	session_start ();
}
$customerid = @$_SESSION ['MM_UserGroup'];

// DB table to use
$dcTable = 'discounts_customer';
$dbTable = 'discounts_database';

$table2 = 'discounts_customer.id, discounts_customer.discount_name, discounts_customer.customerid, discounts_customer.applied, discounts_customer.date_obtained, discounts_customer.expiration_date';
$table = 'discounts_database.discount_name, discounts_database.discount_code, discounts_database.type, discounts_database.amount, discounts_database.multiple_use, discounts_database.combinable, discounts_database.life_of_discount';

$combinedTables = $table . ' ' . $table2;
$join = "$dbTable" . ' LEFT JOIN ' . "$dcTable" . ' ON ' . 'discounts_database.discount_name = discounts_customer.discount_name' . ' WHERE ' . ' discounts_customer.customerid ' . ' = ' . "'$customerid'";
$table = $join;

// Table's primary key
$primaryKey = 'discounts_database.discount_code';
$primaryKey2 = 'discount_code';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier - in this case object
// parameter names
$columns = array(
    array(
        'db' => 'id',
        'dt' => 'id',
        //'formatter' => function( $d, $row ) {
            // Technically a DOM id cannot start with an integer, so we prefix
            // a string. This can also be useful if you have multiple tables
            // to ensure that the id is unique with a different prefix
           // return 'row_'.$d;
     // }
    ),
	array( 'db' => 'customerid', 'dt' => 'customerid', 'formatter' => function( $d, $row ) {
            return $customerid = $_SESSION ['MM_UserGroup'];
        }
),
    array( 'db' => "discount_name", 'dt' => 'discount_name', 'formatter' => function( $d, $row ) {
           return $row[0];
       } ),
    array( 'db' => 'discount_code', 'dt' => 'discount_code'
         ), 
    array( 'db' => 'applied', 'dt' => 'applied' ),
    array( 'db' => 'date_obtained', 'dt' => 'date_obtained' ),
    array( 'db' => 'expiration_date', 'dt' => 'expiration_date' ),
 
    //array( 'db' => 'discounts_database.discount_name', 'dt' => 'discount_name' ),
    array( 'db' => 'type', 'dt' => 'type' ),
    array( 'db' => 'amount', 'dt' => 'amount' ),
    array( 'db' => 'multiple_use', 'dt' => 'multiple_use' ),
    array( 'db' => 'combinable', 'dt' => 'combinable' ),
    array( 'db' => 'life_of_discount', 'dt' => 'life_of_discount' ),
/*     array(
        'db'        => 'start_date',
        'dt'        => 'start_date',
        'formatter' => function( $d, $row ) {
            return date( 'jS M y', strtotime($d));
        }
    ),
    array(
        'db'        => 'salary',
        'dt'        => 'salary',
        'formatter' => function( $d, $row ) {
            return '$'.number_format($d);
        }
    ) */
);
 
$sql_details = array(
    'user' => 'ChinChinMonster',
    'pass' => 'one4PBchaos!',
    'db'   => 'metcdatabase',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
 
require( 'ssp.class2.php' );
 
echo json_encode(
    SSP::simple( $_POST, $sql_details, $table, $primaryKey, $columns )
);
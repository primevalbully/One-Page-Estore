<?php
header("location: includes/php/class-accordion_Module.php");
$base_url = $_SERVER['HTTP_HOST']; 
$findme   = 'www.';
$replacementStr = '';
$new_url = str_ireplace( $findme, $replacementStr, $base_url, $count);

if ( $count < 1 )
{
	// $new_url = "http://" . $new_url . $_SERVER['REQUEST_URI'];
	 //"The string '$findme' was not found in the string '$base_url'";
	 
} else {
	$new_url = "http://" . $new_url . $_SERVER['REQUEST_URI'];

	     "The string '$findme' was found in the string '$base_url'";
		 header( "location: $new_url" );
}
?>
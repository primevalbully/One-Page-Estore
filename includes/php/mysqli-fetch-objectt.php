<?php 
   $db = new mysqli('localhost', 'ChinChinMonster', 'one4PBchaos!', 'metcdatabase');
   if( mysqli_connect_errno() ) {
	   echo "It done fucked up!";
	   exit;
   } else { echo "Good fucking job!"; }
   $query = "SELECT * FROM uspass WHERE customerid = 2";
   $result = $db->query($query);
   $row = $result->fetch_object();
   print_r( $row->customerid );
   print_r( $row->username );
?>
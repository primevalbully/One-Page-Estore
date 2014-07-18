<?php 
   $db = new mysqli('localhost', 'ChinChinMonster', 'one4PBchaos!', 'metcdatabase');
   if( mysqli_connect_errno() ) {
	   echo "It done fucked up!";
	   exit;
   }
?>
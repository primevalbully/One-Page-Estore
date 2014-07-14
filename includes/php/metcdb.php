<?php
$hostname_metcdb = "localhost";
$database_metcdb = "metcdatabase";
$username_metcdb = "ChinChinMonster";
$password_metcdb = "one4PBchaos!";
$metcdb = mysql_connect($hostname_metcdb, $username_metcdb, $password_metcdb, $database_metcdb) or trigger_error(mysql_error(),E_USER_ERROR); 
?>
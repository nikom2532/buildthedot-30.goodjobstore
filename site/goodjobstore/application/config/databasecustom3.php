<?php
$hostname_connection = "localhost";
$database_connection = "buildthedot_30goodjobstore";
$username_connection = "iming";
$password_connection = "iming";
$connection = mysql_pconnect($hostname_connection, $username_connection, $password_connection)
		or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query( "SET NAMES UTF8" ) ;
?>
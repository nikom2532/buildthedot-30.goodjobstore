<?php
$hostname_connection = "localhost";
$database_connection = "goodjob";
$username_connection = "dev";
$password_connection = "0823248713";
$connection = mysql_pconnect($hostname_connection, $username_connection, $password_connection)
		or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query( "SET NAMES UTF8" ) ;
?>
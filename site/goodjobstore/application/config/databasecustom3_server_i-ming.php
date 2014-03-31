<?php
$hostname_connection = "localhost";
$database_connection = "imingcom_30goodjobstore";
$username_connection = "imingcom_arming";
$password_connection = "cominter";
$connection = mysql_pconnect($hostname_connection, $username_connection, $password_connection)
		or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query( "SET NAMES UTF8" ) ;
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$sonID = $_GET["sonID"];
	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "DELETE FROM son_menu WHERE Son_ID=".$sonID;
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
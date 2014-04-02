<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$proID = $_GET["proID"];
	$proStat = $_GET["proStat"];

	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","iming","iming") or die(mysql_error());
	$objDB = mysql_select_db("buildthedot_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE banner SET status = '$proStat' WHERE banner_id = '$proID'";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$rateID = $_GET["rateID"];
	$changeRate = $_GET["changeRate"];

	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","iming","iming") or die(mysql_error());
	$objDB = mysql_select_db("buildthedot_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE usd_rate SET rate = '$changeRate' WHERE id = '$rateID'";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
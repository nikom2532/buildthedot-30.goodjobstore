<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$optionID = $_GET["optionID"];
	$changePrice = $_GET["changePrice"];

	include(APPPATH."config/databasecustom.php");
	// $objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	// $objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	// mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE shipping_option SET Price = '$changePrice' WHERE Option_ID = '$optionID'";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
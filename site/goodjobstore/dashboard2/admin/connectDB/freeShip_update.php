<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$freeshipID = $_GET["freeshipID"];
	$changePrice = $_GET["changePrice"];
	$changeStatus = $_GET["changeStatus"];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE free_shipping SET min_price='$changePrice', status='$changeStatus' WHERE id = '$freeshipID'";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
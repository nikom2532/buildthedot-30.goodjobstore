<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$proID = $_GET["proID"];
	
	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sqlDelPro = "DELETE FROM products WHERE Product_ID='".$proID."'";
	mysql_query($sqlDelPro, $objCon) or die(mysql_error());

	$sqlDelImage = "DELETE FROM images WHERE Product_ID='".$proID."'";
	mysql_query($sqlDelImage, $objCon) or die(mysql_error());

	mysql_close($objCon);
?>
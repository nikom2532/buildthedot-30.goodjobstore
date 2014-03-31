<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$nameEN = $_GET["nameEN"];
	$nameTH = $_GET["nameTH"];
	$mainUrl = $_GET["mainUrl"];

	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "INSERT INTO main_menu (Name_En,Name_Th,main_url) 
			VALUES ('".$nameEN."','".$nameTH."','".$mainUrl."')";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
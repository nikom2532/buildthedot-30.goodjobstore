<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$mainID = $_GET["mainID"];
	$nameEN = $_GET["nameEN"];
	$nameTH = $_GET["nameTH"];
	$subUrl = $_GET["subUrl"];

	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "INSERT INTO sub_menu (Main_ID,Name_En,Name_Th,sub_url) 
			VALUES ('".$mainID."','".$nameEN."','".$nameTH."','".$subUrl."')";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
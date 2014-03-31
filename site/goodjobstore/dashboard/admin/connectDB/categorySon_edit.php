<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$sonID = $_GET['sonID'];
	$nameEN = $_GET['nameEN'];
	$nameTH = $_GET['nameTH'];
	$sonUrl = $_GET['sonUrl'];

	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE son_menu SET Name_En = '$nameEN',Name_Th = '$nameTH',son_url = '$sonUrl' WHERE Son_ID = $sonID";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
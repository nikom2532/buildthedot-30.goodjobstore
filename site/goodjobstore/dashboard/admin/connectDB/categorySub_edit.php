<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$subID = $_GET['subID'];
	$nameEN = $_GET['nameEN'];
	$nameTH = $_GET['nameTH'];
	$subUrl = $_GET['subUrl'];

	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","iming","iming") or die(mysql_error());
	$objDB = mysql_select_db("buildthedot_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE sub_menu SET Name_En = '$nameEN',Name_Th = '$nameTH',sub_url = '$subUrl' WHERE Sub_ID = $subID";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
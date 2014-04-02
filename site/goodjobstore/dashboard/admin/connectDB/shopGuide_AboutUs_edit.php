<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$Descrip_EN = $_GET["descripEN"];
	$Descrip_TH = $_GET["descripTH"];

	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","iming","iming") or die(mysql_error());
	$objDB = mysql_select_db("buildthedot_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE shopping_guide SET 
				About_Us_Th='$Descrip_TH',
				About_Us_En='$Descrip_EN' 
				WHERE Guide_ID = 1";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
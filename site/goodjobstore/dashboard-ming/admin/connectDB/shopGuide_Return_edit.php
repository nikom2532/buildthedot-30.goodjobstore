<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$Descrip_EN = $_GET["descripEN"];
	$Descrip_TH = $_GET["descripTH"];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE shopping_guide SET 
				Return_Change_Th='$Descrip_TH',
				Return_Change_En='$Descrip_EN' 
				WHERE Guide_ID = 1";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
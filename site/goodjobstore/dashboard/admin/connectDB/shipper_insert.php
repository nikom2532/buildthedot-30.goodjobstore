<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$m_Name_EN = $_GET["shipperEN"];
		$Name_EN = str_replace("'","''",$m_Name_EN);
	$Name_TH = $_GET["shipperTH"];
	$m_Descrip_EN = $_GET["descripEN"];
		$Descrip_EN_64 = str_replace("'","''",$m_Descrip_EN);
		$Descrip_EN = base64_decode($Descrip_EN_64);
	$Descrip_TH = $_GET["descripTH"];
	
	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "INSERT INTO how_delivery (Name_Th,Name_En,Description_Th,Description_En) 
			VALUES ('".$Name_TH."','".$Name_EN."','".$Descrip_TH."','".$Descrip_EN."')";
	mysql_query($sql, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
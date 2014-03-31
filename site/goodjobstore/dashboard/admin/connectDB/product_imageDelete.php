<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$imageID = $_GET["imageID"];
	
	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sqlCheckPrim = "SELECT Image_ID FROM images WHERE Image_ID = $imageID AND primary_product=1";
	$resultCheckPrim = mysql_query($sqlCheckPrim, $objCon) or die(mysql_error());
	$checkPrim = mysql_fetch_row($resultCheckPrim);
	
	if(!$checkPrim)
	{
		$strSQL = "DELETE FROM images WHERE Image_ID=".$imageID;
		mysql_query($strSQL, $objCon) or die(mysql_error());
		mysql_close($objCon);
	}
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$imgID = $_GET["imgID"];
	$proCode = $_GET["proCode"];

	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","iming","iming") or die(mysql_error());
	$objDB = mysql_select_db("buildthedot_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strDelSQL = "UPDATE images SET primary_product = '0' WHERE primary_product = '1' AND Product_Code = '$proCode'";
	mysql_query($strDelSQL, $objCon) or die(mysql_error());

	$strSQL = "UPDATE images SET primary_product = '1' WHERE Image_ID = '$imgID'";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
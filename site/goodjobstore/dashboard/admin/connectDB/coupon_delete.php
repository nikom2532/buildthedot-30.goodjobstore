<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$couponID = $_GET["couponID"];
	
	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	//--- Delete from table coupon ---
	$sqlDelCoupon = "DELETE FROM coupon WHERE Coupon_ID='".$couponID."'";
	mysql_query($sqlDelCoupon, $objCon) or die(mysql_error());

	//--- Delete from table coupon_customers ---
	$sqlDelCusCoupon = "DELETE FROM coupon_customers WHERE Coupon_ID='".$couponID."'";
	mysql_query($sqlDelCusCoupon, $objCon) or die(mysql_error());

	//--- close database ---
	mysql_close($objCon);
?>
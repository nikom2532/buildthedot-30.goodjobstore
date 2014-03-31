<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$proCode = $_GET['proCode'];

	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sqlTest = "SELECT Product_Code,sort FROM product_groups ORDER BY sort";
	$resultTest = mysql_query($sqlTest, $objCon) or die(mysql_error());
	
	while($dataTest=mysql_fetch_array($resultTest))
	{
		if ($dataTest['Product_Code']==$proCode)
		{
			$upSort = $dataTest['sort']-1;
			$sqlUp = "UPDATE product_groups SET sort = $upSort WHERE Product_Code = '$proCode'";
			mysql_query($sqlUp, $objCon) or die(mysql_error());
			
			$downSort = $dataTest['sort'];
			$sqlDown = "UPDATE product_groups SET sort = $downSort WHERE Product_Code = '$beforCode'";
			mysql_query($sqlDown, $objCon) or die(mysql_error());
		}
		$beforCode = $dataTest['Product_Code'];
	}
?>
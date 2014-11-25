<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$proCode = $_GET["proCode"];
	$proStat = $_GET["proStat"];

	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE product_groups SET Group_Status = '$proStat' WHERE Product_Code = '$proCode'";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
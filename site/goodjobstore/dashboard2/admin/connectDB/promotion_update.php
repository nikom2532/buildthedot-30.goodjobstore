<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$proID = $_GET["proID"];
	$proStat = $_GET["proStat"];

	$objCon = mysql_connect("localhost","iming","iming") or die(mysql_error());
	$objDB = mysql_select_db("buildthedot_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE promotions SET status = '$proStat' WHERE id = '$proID'";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
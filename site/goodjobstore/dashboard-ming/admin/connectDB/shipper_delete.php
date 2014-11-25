<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$how_ID = $_GET["howID"];
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "DELETE FROM how_delivery WHERE How_ID=".$how_ID;
	mysql_query($sql, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
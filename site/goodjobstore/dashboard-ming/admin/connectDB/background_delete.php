<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$backgroundID = $_GET["backgroundID"];
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "DELETE FROM background WHERE id=".$backgroundID;
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
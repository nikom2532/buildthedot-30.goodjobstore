<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$groupID = $_GET["groupID"];
	$cusID = $_GET["cusID"];

	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "INSERT INTO group_item (Group_ID,Cus_ID) 
			VALUES ('".$groupID."','".$cusID."')";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
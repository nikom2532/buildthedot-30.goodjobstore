<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$subID = $_GET['subID'];
	$nameEN = $_GET['nameEN'];
	$nameTH = $_GET['nameTH'];
	$subUrl = $_GET['subUrl'];

	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE sub_menu SET Name_En = '$nameEN',Name_Th = '$nameTH',sub_url = '$subUrl' WHERE Sub_ID = $subID";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
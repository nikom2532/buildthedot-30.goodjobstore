<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$Name_EN = $_GET["prop_en"];
	$Name_TH = $_GET["prop_th"];
	$objCon = mysql_connect("localhost","iming","iming") or die(mysql_error());
	$objDB = mysql_select_db("buildthedot_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "INSERT INTO property (name_th,name_en) 
			VALUES ('".$Name_TH."','".$Name_EN."')";
	mysql_query($sql, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>
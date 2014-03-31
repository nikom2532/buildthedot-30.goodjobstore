<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);		
	
	//----- Color -----
	$sqlColor = "SELECT * FROM color";
	$resultColor = mysql_query($sqlColor, $objCon) or die(mysql_error());
?>


<select name="selectColor">
	<option value=""><-- Please Select Color --></option>
	<?
	while ($data=mysql_fetch_array($resultColor))
	{?>
		<option value="<?=$data['Color_ID']?>"><?=$data['Name_EN']?></option>
	<?}?>
</select>
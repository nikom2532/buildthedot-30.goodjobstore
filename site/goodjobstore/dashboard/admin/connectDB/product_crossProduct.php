<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$num = $_GET['num'];

	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","iming","iming") or die(mysql_error());
	$objDB = mysql_select_db("buildthedot_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);	
	
	//----- Product ----
	$sql = "SELECT * FROM products";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>



	<select name="selectCross<?=$num?>">
		<option value=""><-- Please Select Cross Product <?=$num?>--></option>
		<?php
		while ($data=mysql_fetch_array($result))
		{ ?>
			<option value="<?=$data['Product_ID']?>"><?=$data['Pro_Name_En']?></option>
		<?php } ?>
	</select>
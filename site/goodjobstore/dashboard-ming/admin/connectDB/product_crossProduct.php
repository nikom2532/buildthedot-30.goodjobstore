<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$num = $_GET['num'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);	
	
	//----- Product ----
	$sql = "SELECT * FROM products";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>



	<select name="selectCross<?php echo $num?>">
		<option value=""><-- Please Select Cross Product <?php echo $num?>--></option>
		<?php
		while ($data=mysql_fetch_array($result))
		{ ?>
			<option value="<?php echo $data['Product_ID']?>"><?php echo $data['Pro_Name_En']?></option>
		<?php } ?>
	</select>
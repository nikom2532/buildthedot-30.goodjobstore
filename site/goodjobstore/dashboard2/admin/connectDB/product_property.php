<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);		
	
	//----- Property ----
	$sqlProperty = "SELECT * FROM property WHERE Property_ID!=1";
	$resultProperty = mysql_query($sqlProperty, $objCon) or die(mysql_error());
?>



<select name="property">
	<option value=""><-- Please Select Property --></option>
	<?php
	while ($data=mysql_fetch_array($resultProperty))
	{ ?>
		<option value="<?php echo $data['Name_En']?>"><?php echo $data['Name_En']?></option>
	<?php } ?>
</select>
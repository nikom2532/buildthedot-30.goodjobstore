<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$objCon = mysql_connect("localhost","iming","iming") or die(mysql_error());
	$objDB = mysql_select_db("buildthedot_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);		
	
	//----- Property ----
	$sqlProperty = "SELECT * FROM property WHERE Property_ID!=1";
	$resultProperty = mysql_query($sqlProperty, $objCon) or die(mysql_error());
?>



<select name="property">
	<option value=""><-- Please Select Property --></option>
	<?
	while ($data=mysql_fetch_array($resultProperty))
	{?>
		<option value="<?=$data['Name_En']?>"><?=$data['Name_En']?></option>
	<?}?>
</select>
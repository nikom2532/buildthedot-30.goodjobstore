<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$subID = $_GET['subID'];

	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM son_menu WHERE Sub_ID = '$subID'";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>




<table style="width:75%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>Son [En]</td>
			<td>Son [Th]</td>
			<td>Url</td>
			<td></td>
			<td></td>
		</tr>
		<?
		while ($data=mysql_fetch_array($result))
		{?>
			<tr style="height:20px;">
				<td><?=$data['Name_En']?></td>
				<td><?=$data['Name_Th']?></td>
				<td><?=$data['son_url']?></td>

				<td>
					<input type="button" value="Edit" 
					onclick="window.location.href='categorySon_viewEdit.php?subID=<?=$data['Sub_ID']?>&sonID=<?=$data['Son_ID']?>'" 
					style="width:60px">
				</td>
				<td><input type="button" value="Delete" onclick="deleteCategorySon(<?=$data['Sub_ID']?>,<?=$data['Son_ID']?>);" style="width:60px"></td>
			</tr>
		<?}?>
	</tbody>
</table>
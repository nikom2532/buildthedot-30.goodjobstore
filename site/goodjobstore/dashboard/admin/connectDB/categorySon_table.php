<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$subID = $_GET['subID'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
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
		<?php
		while ($data=mysql_fetch_array($result))
		{ ?>
			<tr style="height:20px;">
				<td><?php echo $data['Name_En']?></td>
				<td><?php echo $data['Name_Th']?></td>
				<td><?php echo $data['son_url']?></td>

				<td>
					<input type="button" value="Edit" 
					onclick="window.location.href='categorySon_viewEdit.php?subID=<?php echo $data['Sub_ID']?>&sonID=<?php echo $data['Son_ID']?>'" 
					style="width:60px">
				</td>
				<td><input type="button" value="Delete" onclick="deleteCategorySon(<?php echo $data['Sub_ID']?>,<?php echo $data['Son_ID']?>);" style="width:60px"></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM slide";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>




<table style="width:95%; border-collapse:collapse; align:center;" >
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>Slide</td>
			<td>Url</td>
			<td>Enable</td>
			<td></td>
			<td></td>
		</tr>
		<?php
		while ($data=mysql_fetch_array($result))
		{ ?>
			<tr align="center">
				<td><img src="../../public/<?php echo $data['path']?>" style="height:100px;"></td>
				<td><?php echo $data['url']?></td>
				<td style="text-align:center;">
					<input type="checkbox" name="change_proStatus" id="change_proStatus_<?php echo $data['slideID']?>" <?php if($data['status']==1){ ?>checked<?php } ?> onclick="change_productStatus('<?php echo $data['slideID']?>');" value="1">
				</td>


				<td><input type="button" style="width:60px;" value="Edit" onclick="window.location.href='slide_viewEdit.php?slide_ID=<?php echo $data['slideID']?>'"></td>
				<td><input type="button" style="width:60px;" value="Delete" onclick="deleteSlide('<?php echo $data['slideID']?>');"></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$colorID = $_GET['colorID'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM color";
	if($colorID!=NULL)
		$sql .= " WHERE Color_ID = $colorID";
	$sql .= " ORDER BY Name_EN";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>

<table style="width:50%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>Color [En]</td>
			<td>Color [Th]</td>
			<td>Image</td>
			<td></td>
			<td></td>
		</tr>
		<?php
		while ($data=mysql_fetch_array($result))
		{ ?>
			<tr>
				<td style="text-align:center;"><?php echo $data['Name_EN']?></td>
				<td style="text-align:center;"><?php echo $data['Name_TH']?></td>
				<td style="text-align:center;">
					<?php if($data['path']!=NULL){ ?><img src="../../public/<?php echo $data['path']?>"><?php } ?>
				</td>
				<td>
					<input type="button" value="Edit" 
					onclick="window.location.href='color_viewEdit.php?colorID=<?php echo $data['Color_ID']?>
					&nameEN=<?php echo $data['Name_EN']?>
					&nameTH=<?php echo $data['Name_TH']?>'" 
					style="width:60px">
				</td>
				<td><input type="button" value="Delete" onclick="deleteColor(<?php echo $data['Color_ID']?>);" style="width:60px"></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
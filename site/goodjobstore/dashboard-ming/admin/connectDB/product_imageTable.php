<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$productID = $_GET['productID'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM images JOIN color
			ON images.Color_ID = color.Color_ID
			WHERE images.Product_ID = '$productID'
			ORDER BY Level";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>
																<div style="width: 800px; height: 350px; overflow: auto; padding: 5px">

<table style="border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td style="width:120px; text-align:center;">Images</td>
			<td style="width:120px; text-align:center;">Color</td>
			<td style="width:120px; text-aligh:center;">Primary</td>
			<td></td>
			<td></td>
		</tr>
		<?php
		while ($data=mysql_fetch_array($result))
		{ ?>
			<tr>
				<td style="text-align:center;"><img src="../../public/<?php echo $data['Thumbnail_path']?>"></td>
				<td style="text-align:center;">
					<?php $sqlColor = "SELECT * FROM color ORDER BY Name_EN";
					$resultColor = mysql_query($sqlColor, $objCon) or die(mysql_error());?>
					<select name="change_color" id="change_color_<?php echo $data['Image_ID']?>" onchange="updateColor('<?php echo $productID?>','<?php echo $data['Image_ID']?>');">
						<?php while($dataColor=mysql_fetch_array($resultColor)){ ?>
							<option value="<?php echo $dataColor['Color_ID']?>" <?php if($dataColor['Color_ID']==$data['Color_ID']){ ?>selected<?php } ?>>
								<?php echo $dataColor['Name_EN']?>
							</option>
						<?php } ?>
					</select>
				</td>
				<td style="text-align:center;"><?php if($data['primary_product']==1){ ?>Yes<?php } ?></td>

				<td><input type="button" value="Primary" onclick="setPrimProduct('<?php echo $productID?>','<?php echo $data['Product_Code']?>',<?php echo $data['Image_ID']?>);"></td>
<!--			<td><input type="button" value="Edit" onclick="editColor(<?php echo $data['Color_ID']?>);"></td>	-->
				<td><input type="button" value="Delete" onclick="deleteImagePro(<?php echo $data['Image_ID']?>,'<?php echo $productID?>');"></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
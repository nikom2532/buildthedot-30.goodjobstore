<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT coupon.Coupon_ID,Discount_Status,Discount_PC,Discount_Cash,Start_Date,Expired_Date,status,Cus_ID
			FROM coupon JOIN coupon_customers
			ON coupon.Coupon_ID = coupon_customers.Coupon_ID
			ORDER BY run_coupon DESC";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>




<table style="width:90%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>Coupon ID</td>
			<td>Discount</td>
			<td>Type</td>
			<td>Start</td>
			<td>Expired</td>
			<td>Customer ID</td>
			<td>Used</td>
			<td></td>
		</tr>
		<?php
		while ($data=mysql_fetch_array($result))
		{
			$type = $data['Discount_Status'];
			$use = $data['status'];
		?>
			<tr>
				<td style="text-align:center;"><?php echo $data['Coupon_ID']?></td>
				<?php if($type==1)
				{ ?>
					<td style="text-align:center;"><?php echo $data['Discount_PC']?></td>
					<td style="text-align:center;">Percen</td>
				<?php } 
				else
				{ ?>
					<td style="text-align:center;"><?php echo $data['Discount_Cash']?></td>
					<td style="text-align:center;">Cash</td>
				<?php } ?>
				<td style="text-align:center;"><?php echo $data['Start_Date']?></td>
				<td style="text-align:center;"><?php echo $data['Expired_Date']?></td>
				<td style="text-align:center;"><?php echo $data['Cus_ID']?></td>
				<?php if($use==1)
				{ ?>
					<td style="text-align:center;">NO</td>
				<?php } 
				else
				{ ?>
					<td style="text-align:center;">YES</td>
				<?php } ?>
				<td><input type="button" value="Delete" onclick="deleteCoupon('<?php echo $data['Coupon_ID']?>');" style="width:60px"></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
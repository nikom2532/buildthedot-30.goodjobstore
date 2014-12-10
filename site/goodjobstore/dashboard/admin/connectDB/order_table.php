<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

<?php
	$filterStat = $_GET['filterStat'];
	$orderID = $_GET['orderID'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM orders
			WHERE Order_Status = 1";
	if ($filterStat!=0){
		$sql .= " AND status = $filterStat";}
	if ($orderID!=NULL){
		$sql .= " AND Order_ID LIKE '$orderID'";}
	$sql .= " ORDER BY created_at desc";

	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>




<table style="width:90%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>Order</td>
			<td>Price</td>
			<td>Status</td> 
			<td <?php if($filterStat==1 or $filterStat==2 or $filterStat==5){ ?>style="display:none;"<?php } ?>>Shipping number</td>
			<td></td>
			<td <?php if($filterStat==1 or $filterStat==3 or $filterStat==4 or $filterStat==5){ ?>style="display:none;"<?php } ?>>Gen coupon</td>
			<td>Create</td>
		</tr>
		<form name="frmTableOrder">
			<?php
			while ($data=mysql_fetch_array($result))
			{
				$orderID = $data['Order_ID'];
			?>
				<tr>
					<td style="text-align:center;">
						<a href="order_detail.php?orderID=<?php echo $data['Order_ID']?>&cusID=<?php echo $data['Cus_ID']?>">
						<?php echo $data['Order_ID']?></a></td>
					<td style="text-align:right;"><?php echo $data['Final_Price']?></td>
					<td style="text-align:center;">
						<select name="change_status" id="change_status_<?php echo $data['Order_ID']?>" 
						onchange="showMe('<?php echo $data['Order_ID']?>','ship_num_<?php echo $data['Order_ID']?>', this)">
							<option value="1" <?php if($data['status']==1){ ?>selected<?php } ?>>Pending</option>
							<option value="2" <?php if($data['status']==2){ ?>selected<?php } ?>>Payment Received</option>
							<option value="3" <?php if($data['status']==3){ ?>selected<?php } ?>>Shipped</option>
							<option value="4" <?php if($data['status']==4){ ?>selected<?php } ?>>Refund</option>
							<option value="5" <?php if($data['status']==5){ ?>selected<?php } ?>>Cancel</option>
						</select>
					</td>
					<td style="text-align:center; <?php if($filterStat==1 or $filterStat==2 or $filterStat==5){ ?>display:none;<?php } ?>">
						<input type="text" id="ship_num_<?php echo $data['Order_ID']?>" name="ship_num" value="<?php echo $data['shipping_number']?>"
							<?php if($data['status']==1 or $data['status']==2 or $data['status']==5){ ?>style="display:none;"<?php } ?>
						>
					</td>
					<td>
						<input type="button" value="Update" onclick="updateOrder('<?php echo $data['Order_ID']?>',<?php echo $filterStat?>,<?php echo $data['status']?>);" style="width:60px">
					</td>
					<td <?php if($filterStat==1 or $filterStat==3 or $filterStat==4 or $filterStat==5){ ?>style="display:none"<?php } ?>>
						<input type="button" id="gen_coupon_<?php echo $data['Order_ID']?>" value="gen coupon" 
						onclick="window.location.href='coupon.php?cusID=<?php echo $data['Cus_ID']?>'" 
						style="width:80px;
							<?php if($data['status']!=2){ ?>display:display;<?php } ?>
						">
					</td>
					<td><?php echo $data['created_at']?></td>
				</tr>
			<?php } ?>
		</form>
	</tbody>
</table>
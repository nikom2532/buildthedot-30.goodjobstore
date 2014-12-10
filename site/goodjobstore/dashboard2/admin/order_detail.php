<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<!--Permission-->

<?php
session_start(); //à»Ô´ session
$ses_userid =$_SESSION[ses_userid];
$ses_username = $_SESSION[ses_username];
if($ses_userid <> session_id() or $ses_username =="")
{
echo "Please Login to system<br />";
}

if($_SESSION[ses_status] != "Super Admin") 
{
echo "This page for Super Admin only!";
echo "<br><a href=index.php>Back</a>";
exit();
}
?>

<!--Permission-->
<?php
	$orderID = $_GET['orderID'];
	$cusID = $_GET['cusID'];
	$backTo = $_GET['backTo'];

	//include_once '../classes/Products.php';
	//Initialization
	include_once '../classes/Employees.php';
	$login = 'Log in';
	$logout = 'Register';
	$link = 'profile.php';
		$get_empid = '0001';
		//$get_empid = $_GET['id'];
		$getemp = new Employees();
		$get = $getemp->emp($get_empid);
		$getlastname = $getemp->getLastName();
		$getemail = $getemp->getEmail();
		$login = $getemp->getFirstName()." ".$getemp->getLastName();
		$logout = 'Log out';
		if(isset($getfirstname)==0&&isset($getlastname)==0)
			{
				$login = $getemp->getEmail();
			} 

	//------- connect Database ----------
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	//------ Customer --------
	$sqlCus = "SELECT * FROM customers WHERE Cus_ID = '$cusID'";
	$resultCus = mysql_query($sqlCus, $objCon) or die(mysql_error());

	//------ Shipping --------
	$sqlShip = "SELECT * FROM shipping JOIN city 
				ON shipping.s_City_ID = city.City_ID
				LEFT JOIN country ON shipping.s_Country_ID = country.Country_ID
				WHERE Cus_ID = '$cusID'";
	$resultShip = mysql_query($sqlShip, $objCon) or die(mysql_error());

	//------ Ship Option -----
		//------ Gift warp -------
		$sqlGift = "SELECT Have_ID FROM have_option WHERE Order_ID = '$orderID' AND Option_ID=1";
		$resultGift = mysql_query($sqlGift, $objCon) or die(mysql_error());
		$gift = mysql_fetch_row($resultGift);
		//------ Invoice ---------
		$sqlInvoice = "SELECT Have_ID FROM have_option WHERE Order_ID = '$orderID' AND Option_ID=2";
		$resultInvoice = mysql_query($sqlInvoice, $objCon) or die(mysql_error());
		$invoice = mysql_fetch_row($resultInvoice);

	//----- Shipping method -----
	$sqlShipMet = "SELECT * FROM orders JOIN how_delivery
					ON orders.How_ID = how_delivery.How_ID
					WHERE Order_ID = '$orderID'";
	$resultShipMet = mysql_query($sqlShipMet, $objCon) or die(mysql_error());

	//----- Shipping method -----
	$sqlPayMet = "SELECT * FROM orders JOIN payments
					ON orders.payment_id = payments.id
					WHERE Order_ID = '$orderID'";
	$resultPayMet = mysql_query($sqlPayMet, $objCon) or die(mysql_error());

	//------- Order Item -------
	$sqlItem = "SELECT products.Product_Code,Pro_Name_En,property.name_en,Thumbnail_path,color.Name_EN,order_item.Qty,
				Price_Buy,Price_sale,Total_Price, order_gifts.gift_type
				FROM order_item 
				JOIN images ON order_item.Product_ID = images.Product_ID
				JOIN products ON order_item.Product_ID = products.Product_ID
				JOIN property ON products.Property_ID = property.prop_id
				JOIN color ON order_item.Color_ID = color.Color_ID AND order_item.Color_ID = images.Color_ID
				LEFT JOIN order_gifts ON order_item.Order_ID = order_gifts.Order_ID AND order_item.Product_ID = order_gifts.Product_ID
				WHERE order_item.Order_ID =  '$orderID'
				GROUP BY products.Product_ID,images.Color_ID
				ORDER BY products.Product_Code";
	$resultItem = mysql_query($sqlItem, $objCon) or die(mysql_error());

	//------- Price -------
	$sqlPrice = "SELECT Total_Price,shipping_price,service_price,Final_Price FROM orders WHERE orders.Order_ID = '$orderID'";
	$resultPrice = mysql_query($sqlPrice, $objCon) or die(mysql_error());
?>

<!--Export excel-->
<?php
	unset($_SESSION['report_header']);
	unset($_SESSION['report_values']);
	$_SESSION['report_header']=array("Order ID","Product Code","Product Name","Property","Color","Qty.","Price","Total Price"); 
?>

<html>
<head>
	<title>GOODJOB - Administration</title>
	
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
</head>
<body>

<!--logout-->

	<div id="wrapper">
		<div id="header">
			<div class="logo"><a href ="http://online.goodjobstore.com"><img src="../images/logo.jpg" /></a></div>
			<div class="right">
				<ul class="member_style">
					
					<li><a href="logout.php">log out</a></li>
				</ul>
			</div>
		</div>
		
<!--logout-->
		
		<!-- Body Section -->
		<div id="title_head">
		Back Office
		</div>
		<div id="content">
		    <div id="leftcolum">
<!--menu-->

									<b><a href="order.php">Order</a></b>
								<?php if($_SESSION[ses_status] == "Super Admin") 
			{ ?>
								<!-- End Admin -->
									<b><br><br><a href="saleReport.php">Sale Report</a>
									<br><br><a href="record.php">Customer Record</a>
									<br><br><a href="productGroup.php">Product</a>
									<br><br><a href="category.php">Category</a>
									<br><br><a href="property.php">Property</a>
									<br><br><a href="color.php">Color</a>
									<br><br><a href="banner.php">Banner</a>
									<br><br><a href="banner_notice.php">Notice Banner</a>
									<br><br><a href="slide.php">Slide</a>
									<br><br><a href="background.php">Background</a>
									<br><br><a href="giftwarp.php">Gift warp price</a>
									<br><br><a href="shipper.php">Shipper</a>
									<br><br><a href="cusGroup.php">Group Customers</a>
									<br><br><a href="freeShip.php">Free Shipping</a>
									<br><br><a href="payment.php">Payment</a>
									<br><br><a href="shopGuide_main.php">Shopping Guide</a>
									<br><br><a href="privacy.php">Permission</a>
									<br><br><a href="usdRate.php">USD Rate</a></b>
			<?php } ?>	

<!--menu-->
		   	</div>
			<div id="dashboard"> 

					<div class="viewport">
						<div class="overview">
							<h2>Order: <?php echo $orderID?></h2>

							<br>Customer ID: <?php echo $cusID?>
							<?php while($dataCus=mysql_fetch_array($resultCus))
							{ ?>
								<br>Name: <?php echo $dataCus['FirstName']?> <?php echo $dataCus['LastName']?>
								<br>E-mail: <?php echo $dataCus['Email']?>
								<br>Tel: <?php echo $dataCus['Phone_Number']?>
							<?php } ?>
							<br><br><br>
							<?php while($dataShip=mysql_fetch_array($resultShip))
							{ ?>
								<br>Shipping Name: <?php echo $dataShip['s_FirstName']?> <?php echo $dataShip['s_LastName']?> 
								<br>Shipping Address: <?php echo $dataShip['s_Address']?>
								<?php if($dataShip['s_Country_ID']==222)
								{ ?>
									<br>Province: <?php echo $dataShip['Name_Th']?>
								<?php } 
								else
								{ ?>
									<br>City: <?php echo $dataShip['s_City_Name']?>
								<?php } ?>
								<br>Country: <?php echo $dataShip['country_name']?>
								<br>Postcode: <?php echo $dataShip['s_Postal_Code']?>
								<br>Tel: <?php echo $dataShip['s_Phone_Number']?>
							<?php } 
							while($dataShipMet=mysql_fetch_array($resultShipMet))
							{ ?>
								<br>Shipping Method: <?php echo $dataShipMet['Name_En']?>
							<?php } 
							while($dataPayMet=mysql_fetch_array($resultPayMet))
							{ ?>
								<br>Payment Method: <?php echo $dataPayMet['name_en']?>
							<?php } ?>
<!--							<br>Gift warp: <?php echo (!$gift)?NO:YES;?>	-->
							<br>Invoice: <?php echo (!$invoice)?NO:YES;?>
							<br><br>
							<?php if($backTo==1){ ?>
								<input type="button" value="Back" style="width:60px" onclick="window.location.href='saleReport.php'"><?php } 
							else if ($backTo==2){ ?>
								<input type="button" value="Back" style="width:60px" onclick="window.location.href='record_order.php?cusID=<?php echo $cusID?>'"><?php } 
							else{ ?>
								<input type="button" value="Back" style="width:60px" onclick="window.location.href='order.php'"><?php } ?>
							<br><br>
							<?php if($backTo==1){ ?>
								<input type="button" style="width:100px;" value="Export to excel" onclick="window.location.href='report_export.php?fn=Order_Detail'"><?php } ?>
							<br><br>
							<div id="line"></div>
<div style="width: 800px; height: 250px; overflow: auto; padding: 5px">
							<div id="order_detail_content">
								<table style="width:95%; border-collapse:collapse;">
									<tbody>
										<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
											<td>Product Code</td>
											<td>Product</td>
											<td>Name</td>
											<td>Property</td>
											<td>Color</td>
											<td>Quantity</td>
											<td>Gift warp</td>
											<td>Price</td>
											<td>Total Price</td>
										</tr>
										<?php	$i=1;
											$j=0;
										while ($dataItem=mysql_fetch_array($resultItem))
										{ ?>
											<?php echo ($i%2==1)?'<tr style="background-color:#DDDDDD;">':'<tr style="background-color:#EEEEEE;">'?>
												<?php if($j==0){$_SESSION['report_values'][$j][0]="#".$orderID;}
												else{$_SESSION['report_values'][$j][0]=" ";}?>
												<td style="text-align:center;"><?php echo $dataItem['Product_Code']?></td>
													<?php $_SESSION['report_values'][$j][1]=(string)$dataItem['Product_Code'];?>
												<td style="text-align:center;">
													<img src="../../public/<?php echo $dataItem['Thumbnail_path']?>">
												</td>
												<td style="text-align:center;"><?php echo $dataItem['Pro_Name_En']?></td>
													<?php $_SESSION['report_values'][$j][2]=$dataItem['Pro_Name_En'];?>
												<td style="text-align:center;"><?php echo $dataItem['name_en']?></td>
													<?php $_SESSION['report_values'][$j][3]=$dataItem['name_en'];?>
												<td style="text-align:center;"><?php echo $dataItem['Name_EN']?></td>
													<?php $_SESSION['report_values'][$j][4]=$dataItem['Name_EN'];?>
												<td style="text-align:center;"><?php echo $dataItem['Qty']?></td>
													<?php $_SESSION['report_values'][$j][5]=$dataItem['Qty'];?>
												<td style="text-align:center;">
													<?php
														if($dataItem['gift_type']=='')
															echo 'NO';
														else
															echo 'YES';
													?>
												</td>
												<td style="text-align:right;">
													<?php
													if($dataItem['Price_sale']==0){
														echo $dataItem['Price_Buy'];
														$_SESSION['report_values'][$j][6]=$dataItem['Price_Buy'];}
													else{
														echo $dataItem['Price_sale'];
														$_SESSION['report_values'][$j][6]=$dataItem['Price_sale'];}
													?>
												</td>
												<td style="text-align:right;"><?php echo $dataItem['Total_Price']?></td>
													<?php $_SESSION['report_values'][$j][7]=$dataItem['Total_Price'];?>
											</tr>
										<?php	$i++;
											$j++;
										}?>
									</tbody>
								</table>
								</div>
							</div>
							<?php while($dataPrice=mysql_fetch_array($resultPrice))
							{
							?>
								<br>Products Total: <b><?php echo $dataPrice['Total_Price']?></b> Bath.
									<?php $j++;?>
									<?php $_SESSION['report_values'][$j][0]=" ";?>
									<?php $_SESSION['report_values'][$j][1]=" ";?>
									<?php $_SESSION['report_values'][$j][2]=" ";?>
									<?php $_SESSION['report_values'][$j][3]=" ";?>
									<?php $_SESSION['report_values'][$j][4]=" ";?>
									<?php $_SESSION['report_values'][$j][5]=" ";?>
									<?php $_SESSION['report_values'][$j][6]="Products Total";?>
									<?php $_SESSION['report_values'][$j][7]=$dataPrice['Total_Price'];?>
								<br>Shipping Price: <b><?php echo $dataPrice['shipping_price']?></b> Bath.
									<?php $j++;?>
									<?php $_SESSION['report_values'][$j][0]=" ";?>
									<?php $_SESSION['report_values'][$j][1]=" ";?>
									<?php $_SESSION['report_values'][$j][2]=" ";?>
									<?php $_SESSION['report_values'][$j][3]=" ";?>
									<?php $_SESSION['report_values'][$j][4]=" ";?>
									<?php $_SESSION['report_values'][$j][5]=" ";?>
									<?php $_SESSION['report_values'][$j][6]="Shipping Price";?>
									<?php $_SESSION['report_values'][$j][7]=$dataPrice['shipping_price'];?>
								<br>Service Price: <b><?php echo $dataPrice['service_price']?></b> Bath.
									<?php $j++;?>
									<?php $_SESSION['report_values'][$j][0]=" ";?>
									<?php $_SESSION['report_values'][$j][1]=" ";?>
									<?php $_SESSION['report_values'][$j][2]=" ";?>
									<?php $_SESSION['report_values'][$j][3]=" ";?>
									<?php $_SESSION['report_values'][$j][4]=" ";?>
									<?php $_SESSION['report_values'][$j][5]=" ";?>
									<?php $_SESSION['report_values'][$j][6]="Service Price";?>
									<?php $_SESSION['report_values'][$j][7]=$dataPrice['service_price'];?>
								<br>Total: <b><?php echo $dataPrice['Final_Price']?></b> Bath.
									<?php $j++;?>
									<?php $_SESSION['report_values'][$j][0]=" ";?>
									<?php $_SESSION['report_values'][$j][1]=" ";?>
									<?php $_SESSION['report_values'][$j][2]=" ";?>
									<?php $_SESSION['report_values'][$j][3]=" ";?>
									<?php $_SESSION['report_values'][$j][4]=" ";?>
									<?php $_SESSION['report_values'][$j][5]=" ";?>
									<?php $_SESSION['report_values'][$j][6]="Total";?>
									<?php $_SESSION['report_values'][$j][7]=$dataPrice['Final_Price'];?>
							<?php } ?>
						</div>
					</div>

			</div>
		</div> <!-- End Content -->       
		
	<!-- Footer Section -->
		<div id="footer">
			<div class="payment_logo"><img src="../images/payment_logo.jpg" /></div>
			<div class="copyright">? 2011 - 2015 GOODJOB CO., LTD</div>
		</div>
	
	</div>
</body>
</html>

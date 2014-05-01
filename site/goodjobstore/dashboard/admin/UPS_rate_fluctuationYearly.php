<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?php
session_start();
$ses_userid =$_SESSION[ses_userid];
$ses_username = $_SESSION[ses_username];
if($ses_userid <> session_id() or $ses_username =="")
{
echo "Please Login to system<br />";
}

if($_SESSION[ses_status] != "Super Admin" && $_SESSION[ses_status] != "Admin") 
{
echo "This page for Admin only!";
echo "<br><a href=index.php>Back</a>";
exit();
}
?>


<html>
<head>
	<title>GOODJOB - Administration</title>

	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="ajax/ajax.order.java"></script>
	<script>
		function filterStatus()
		{
			var filterStat = document.frmFilterStatus.filter_status.value;
			viewTable(filterStat,'');
		}
	</script>
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
			  							<b><a href="order.php">Order</a></b>
			<?if($_SESSION[ses_status] == "Super Admin") 
			{?>
								<!-- End Admin -->
									<b><br><br><a href="saleReport.php">Sale Report</a>
									<br><br><a href="UPS_rate_fluctuationYearly.php">UPS Rate</a>
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
			<?}?>	
		   	</div>
			<div id="dashboard"> 

				<div class="viewport">
					<div class="overview">
						<h2>UPS Rate</h2>
						<div style="text-align:center;">
							<table>
								<tr>
									<form action="UPS_rate_fluctuationYearly_proc.php" name="UPS_rate_form" id="UPS_rate_form" method="post" >
										<td style="width:70px;">UPS Rate</td>
										<td style="width:15px;"><img src="../images/dot.gif" /></td>
										<td>
											<input type="text" name="ups_rate" id="ups_rate" value="<?php
											$objCon = @mysql_connect("localhost","iming","iming") or die(mysql_error());
											$objDB = @mysql_select_db("buildthedot_30goodjobstore") or die("Can't connect Database");
											mysql_query("SET NAMES utf8",$objCon);
											$sql_ups_rate_fluctuationyearly = "
												SELECT `rate`
												FROM  `ups_rate_fluctuationyearly` 
												WHERE  `year` = 2014;
											";
											$result_ups_rate_fluctuationyearly = @mysql_query($sql_ups_rate_fluctuationyearly, $objCon) or die(mysql_error());
											while($rs_ups_rate_fluctuationyearly = @mysql_fetch_array($result_ups_rate_fluctuationyearly)){
												echo $rs_ups_rate_fluctuationyearly["rate"];
											}
											?>" onKeyPress="javascript:if(event.keyCode==13) document.getElementById("UPS_rate_form").submit();">
										</td>
										
										<td><input type="submit" value="Submit" style="width:70px;" ></td>
									</form>
								</tr>
								<tr><td><br /></td></tr>
							</table>
							<div id="line"></div>
						</div>
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

	<script type="text/javascript"> 
		function showMe (id, ship, box) 
		{ 
		  var status = $("#change_status_"+id).val();
		  if (status==3 || status==4)
		  {
			  document.getElementById(ship).style.display = "block";
		  }
		  else
		  {
			  document.getElementById(ship).style.display = "none";
		  }
		} 
	</script>
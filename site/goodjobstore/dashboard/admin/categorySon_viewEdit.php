<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<!--Permission-->

<?php
session_start(); //�Դ session
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
	$subID = $_GET['subID'];
	$sonID = $_GET['sonID'];

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

	// include(APPPATH."config/databasecustom.php");
	$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
	$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);
			
	$sql = "SELECT Name_En,Name_Th,son_url FROM son_menu WHERE Son_ID = '$sonID'";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
	while ($data=mysql_fetch_array($result)) {
		$nameEN = $data['Name_En'];
		$nameTH = $data['Name_Th'];
		$sonUrl = $data['son_url'];
	}

	$sqlSub = "SELECT Name_En FROM sub_menu WHERE Sub_ID = '$subID'";
	$resultSub = mysql_query($sqlSub, $objCon) or die(mysql_error());
	while ($dataSub=mysql_fetch_array($resultSub)) {
		$nameSubEN = $dataSub['Name_En'];
	}
	
/*	$sqlMain = "SELECT Name_En FROM main_menu WHERE main_ID = '$mainID'";
	$resultMain = mysql_query($sqlMain, $objCon) or die(mysql_error());
	while ($dataMain=mysql_fetch_array($resultMain)) {
		$nameMainEN = $dataMain['Name_En'];
	}*/

/*	$sqlSub = "SELECT Name_En FROM sub_menu WHERE Sub_ID = '$subID'";
	$resultSub = mysql_query($sqlMain, $objCon) or die(mysql_error());
	while ($dataSub=mysql_fetch_array($resultSub)) {
		$nameSubEN = $dataSub['Name_En'];
	}*/
?>


<html>
<head>
	<title>GOODJOB - Administration</title>

	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="ajax/ajax.categorySon.java"></script>
</head>
<body>
	<script>
		viewTable('<?=$subID?>');
	</script>
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
								<?if($_SESSION[ses_status] == "Super Admin") 
			{?>
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
			<?}?>	

<!--menu-->
		   	</div>
			<div id="dashboard"> 

					<div class="viewport">
						<div class="overview">
							<h2>Edit Son Category</h2>
								<h3>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<?=$nameSubEN?><br>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<?=$nameEN?>
								</h3><br>
						 	<form name="frmAddCategorySon">
								<table>
									<tbody>
										<tr style="height:30px;">
											<td style="width:70px;">Son [En]</td>
											<td style="width:15px;"><img src="../images/dot.gif" /></td>
											<td><input type='text' name='nameEN' value="<?=$nameEN?>"></td>
										</tr>
										<tr style="height:30px;">
											<td style="width:70px;">Son [Th]</td>
											<td style="width:15px;"><img src="../images/dot.gif" /></td>
											<td><input type='text' name='nameTH' value="<?=$nameTH?>"></td>
										</tr>
										<tr style="height:30px;">
											<td style="width:70px;">Url</td>
											<td style="width:15px;"><img src="../images/dot.gif" /></td>
											<td><input type='text' name='sonUrl' value="<?=$sonUrl?>"></td>
										</tr>
										<tr>
											<td><br></td>
										</tr>
									</tbody>
								</table>
								<input type='button' value='Edit' 
								onclick="editCategorySon(<?=$subID?>,<?=$sonID?>);" style="width:60px">
								<input type='button' value='Cancel' onclick="window.location.href='category.php'" style="width:60px">

								<!--<input type='button' value='Cancel' onclick="window.location.href='mainBO.php'" style="width:60px">-->
							</form>		
<br><br>
							<div id="line"></div>

							<div id="son_content">
								<div style="width: 800px; height: 400px; overflow: auto; padding: 5px">
								<!-- table show color -->
							</div>
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

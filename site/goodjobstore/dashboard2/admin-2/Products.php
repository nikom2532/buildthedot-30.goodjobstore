<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
//include_once '../classes/Products.php';
//Initialization
include_once '../classes/Employees.php';
$login = 'Log in';
$logout = 'Register';
$link = 'profile.php';
    //$get_empid = '0001';
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
include_once '../classes/Products.php';
$products = new Products();
$AllProduct = $products->Allproducts();
?>
<html>
<head>
	<title>GOODJOB - Administration</title>
	<meta name="description" content="Shop powered by PrestaShop">
	<meta name="keywords" content="shop, prestashop">
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
	<meta name="generator" content="GoodJobStore">
	<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="../scripts/droplinemenu.js" type="text/javascript"></script>
	<script type="text/javascript">
		//build menu with DIV ID="myslidemenu" on page:
		droplinemenu.buildmenu("droplinetabs1")
	</script>
	<script type="text/javascript" src="../scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>	
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div class="logo"><a href ="../"><img src="../images/logo.jpg" /></a></div>
			<div class="right">
				<ul class="member_style">
					<li class="line"><a href="<?php echo $link?>?id=<?php echo $id?>"><?php echo $login?></a></li> 
					<li><a href="../admin/"><?php echo $logout?></a></li>
				</ul>
			</div>
		</div>
		
		<!-- Body Section -->
		<div id="title_head">
		Back Office
		</div>
		<div id="content">
		    <div id="leftcolum">
			    <ul>
			        <li><a href="profile.php?id=<?php echo $get_empid?>">Profile</a></li>
			        <li><a href="category.php?id=<?php echo $get_empid?>">Category</a></li>
			        <li><a href="sub-category.php?id=<?php echo $get_empid?>">Sub Category</a></li>
					<li><a class="active" href="product.php?id=<?php echo $get_empid?>">Product</a></li>
					<li><a href="employee.php?id=<?php echo $get_empid?>">Employee</a></li>
					<li><a href="customer.php?id=<?php echo $get_empid?>">Customer</a></li>
					<li><a href="Shopping Guide.php?id=<?php echo $get_empid?>">Shopping Guide</a></li>
			    </ul>
		   	</div>
			<div id="dashboard"> 
				<div id="scrollbar1">
					<div class="scrollbar">
						<div class="track">
							<div class="thumb">
								<div class="end">
								</div>
							</div>
						</div>
					</div>
					<div class="viewport">
						 <div class="overview">
					</form>
					<h2>Products</h2>
					<a href="Product.php">Add New Product</a>
						 	<form action="Upload.php" method="POST" name="product" enctype="multipart/form-data">
					<table>
						<tbody>
							<tr>								
								<?php
								echo $products->getAllproducts();
								?>
							</tr>
						</tbody>
					</table>
					
					</form>
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


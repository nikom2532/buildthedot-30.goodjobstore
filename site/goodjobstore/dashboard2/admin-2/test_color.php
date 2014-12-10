<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
include_once '../classes/Products.php';
//Initialization
include_once '../classes/Employees.php';
include_once '../classes/Images.php';
include_once '../classes/color.php';
include_once '../classes/Main_Menu.php';
include_once '../classes/Cross_Sale.php';
$login = 'Log in';
$logout = 'Register';
$link = 'profile.php';
	//$get_empid = $_GET['id'];
	$getemp = new Employees();
	//$get = $getemp->emp($get_empid);
	$getlastname = $getemp->getLastName();
	$getemail = $getemp->getEmail();
	$login = $getemp->getFirstName()." ".$getemp->getLastName();
	$logout = 'Log out';
	if(isset($getfirstname)==0&&isset($getlastname)==0)
		{
			$login = $getemp->getEmail();
		}
//color
		$pro_code = new Products();
		$get_pro = $pro_code->selectPro_code();	
		
		$color = new Color();
		$get_color = $color->selectcolor();
//Menu		
		$menu = new Main_Menu();
		$get_menu = $menu->selectmenu();
		$get_menus = $menu->selectmenus();

//Cross
		$cross = new Cross_Sale();
		$get_cross = $cross->selectcross();
		
//Product Page
	if(!empty($_POST['UPDATE']))
{
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$Product_Code = $_POST['Product_Code'];
		$Product_Name_Th = $_POST['Product_Name_Th'];
		$Product_Name_En = $_POST['Product_Name_En'];
		$Description_Th = $_POST['Description_Th'];
		$Description_En = $_POST['Description_En'];
		$Size = $_POST['Size'];
		$Property_Th = $_POST['Property_Th'];
		$Property_En = $_POST['Property_En'];
		$Price_Buy = $_POST['Price_Buy'];
		$Price_sale = $_POST['Price_sale'];
		$Discount_PC = null;
		$Discount_Num = null;
		$Short_msg_Th = $_POST['Short_msg_Th'];
		$Short_msg_En = $_POST['Short_msg_En'];
		$Qty = $_POST['Qty'];
		$Sale_min = $_POST['Sale_min'];
		$Sale_max = $_POST['Sale_max'];
		$KeyWord = $_POST['KeyWord'];
		$Weight = $_POST['Weight'];
		$Url_Th = $_POST['Url_Th'];
		$Url_En = $_POST['Url_En'];
		$Discount_Status = $_POST['Discount_Status'];
		$Product_Status = $_POST['Product_Status'];
		
		//Discount
		$Discount = $_POST['Discount'];
		$operator = $_POST['operator'];

		if($operator == "Discount_num")
		$Price_sale = ($Price_sale - $Discount);
		
		elseif($operator == "Discount_PC")
		$Price_sale = ($Price_sale-($Price_sale*($Discount/100)));
		
		//Color ID
		$Color_ID = $_POST['color'];
		
		$product = new Products();
		$pro_id = $product->createPro_ID();
		
		
		//Upload Picture
		
		for($i=0;$i<count($_FILES["filUpload"]["name"]);$i++)
		{
		if($_FILES["filUpload"]["name"][0] != "")
		{
		if(move_uploaded_file($_FILES["filUpload"]["tmp_name"][0],"../product/Full/".$_FILES["filUpload"]["name"][0]))
		{
			$file = $_FILES["filUpload"]["name"][0];
			$picture = 'product/Full/'.$file;
			$img = new Images();
			$status = $_POST['Status'];
			$sequence = '1';
			$mode = 'Main';
			$images = $img->uploadfull($pro_id,$picture,$status,$mode,$sequence,$Color_ID);
			echo "Copy/Upload Complete<br>";
		}
		}
		if ($_FILES["filUpload"]["name"][1] != "")
		{
		if(move_uploaded_file($_FILES["filUpload"]["tmp_name"][1],"../product/Small/".$_FILES["filUpload"]["name"][1]))
		{
			$file = $_FILES["filUpload"]["name"][1];
			$picture = 'product/Small/'.$file;
			$img = new Images();
			$status1 = $_POST['Status'];
			$sequence1 = '1';
			$mode1 = 'Main';
			$images = $img->uploadsmall($pro_id,$picture,$status1,$mode1,$sequence1,$Color_ID);	
			echo "Copy/Upload Complete<br>";
		}
		}
		if($_FILES["filUpload"]["name"][2] != "")
		{
		if(move_uploaded_file($_FILES["filUpload"]["tmp_name"][2],"../product/Tumbs/".$_FILES["filUpload"]["name"][2]))
		{
			$file = $_FILES["filUpload"]["name"][2];
			$picture = 'product/Tumbs/'.$file;
			$status1 = $_POST['Status'];
			$sequence1 = '1';
			$mode1 = 'Main';
			$img = new Images();
			$images = $img->uploadtumb($pro_id,$picture,$status,$mode,$sequence,$Color_ID);
			echo "Copy/Uploads Complete<br>";
		}
		}
		}
		if($pro == 0)
		{		
			$_SESSION['PRODUCT']= $product;
			echo "<script>alert('INSERT')</script>";
		}
		$color = new Color();
		$cross = $color->insert_crosscolor($Color_ID,$pro_id);
		
		//Cross
		$cross = new Cross_Sale();
		
		$cross1 = $_POST['cross1'];
		$cross_1 = $cross->insertAll($pro_id,$cross1);
		
		$cross2 = $_POST['cross2'];
		$cross_2 = $cross->insertAll($pro_id,$cross2);
		
		$cross3 = $_POST['cross3'];
		$cross_3 = $cross->insertAll($pro_id,$cross3);
		
		$cross4 = $_POST['cross4'];
		$cross_4 = $cross->insertAll($pro_id,$cross4);
		
		
	}
	header("location:products.php");
}
	
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

</head>
<body onLoad="hide();">
	<div id="wrapper">
		<div id="header">
			<div class="logo"><a href ="../"><img src="../images/logo.jpg" /></a></div>
			<div class="right">
			<table>
					<tbody>
						<tr>
							<td style="vertical-align:middle">
								<div id="member">
									<ul class="member_style">
										<li class="line"><a href="<?php echo $link?>?id=<?php echo $id?>"><?php echo $login?></a></li> 
										<li><a href="../admin/"><?php echo $logout?></a></li>
									</ul>
								</div>
							</td>
							<td>
								<div id="search">
								<form method="get" action="#" id="searchbox">
									<input type="hidden" name="orderby" value="position">
									<input type="hidden" name="orderway" value="desc">
					            	<input type="submit" name="submit_search" value="Search" class="submit_search"><input class="search_query ac_input" type="text" id="search_query_top" name="search_query" value="" autocomplete="off">
								</form>
								</div>
							</td>
						</tr>
					</tbody>
				</table>	
				<div id="language">
					<span class="guide"><a href="../shopping_guide">Shopping Guide</a></span>
					<ul>
						<li class="first"><a href="index.php?lang=th">TH</a></li>
						<li class="select"><a href="index.php?lang=en">EN</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Navigation Section -->
		<div id="nav">
			<div id="droplinetabs1" class="droplinetabs">
				<ul>
					<li class="first">
						<a href="#" title="">New Arrivals</a>
						<ul>
							<li><a href="#">Spacial</a></li>
							<li><a href="#">Corporate Gift</a></li>
							<li><a href="#">Skirt</a></li>
							<li><a href="#">Notebook case</a></li>
						</ul>
					</li>
					<li><a href="#" title="">Stationery</a></li>
					<li>
						<a href="#" title="">Bags & Accessories</a>
						<ul>
							<li><a href="#">Document Bag </a></li>
							<li><a href="#">Presentation Bag </a></li>
							<li><a href="#">Laptop Bag</a></li>
							<li><a href="#">Wine Holder</a></li>
							<li><a href="#">Tissue Holder</a></li>
						</ul>
					</li>
					<li><a href="#" title="">Awesome</a></li>
					<li><a href="#" title="">Designers' tools</a></li>
					<li><a href="#" title="" class="last">Sales</a></li>
				</ul>
			</div>
			<div id="shopping_info">
				<a href="my-cart.php"><img src="../images/cart.jpg" align="absmiddle" />Shopping Cart</a>
				<a href="#"><img src="../images/location.jpg" align="absmiddle" />Store Locator</a>
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
						 	<h2>Product</h2>
						 	<form action="product.php" method="POST" name="product" enctype="multipart/form-data">
					<table>
						<tbody>
								
								<select name="Status" id="Status">
								<option value="Active">Active</option>
								<option value="UnActive">UnActive</option>
								
								<input type="file" name="filUpload[]"><br>
								<input type="file" name="filUpload[]"><br>
								<input type="file" name="filUpload[]"><br>
						
							<tr>
								<td>Color</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<select name="color">
									<option value=""><-- Please Select Color --></option>
									<?php echo $color->getcolor();?>
									</select>
								</td>
							</tr>	

								<td>
							
									<input type="submit" id="submit1" name="UPDATE" value=" Submit ">
								</td>
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

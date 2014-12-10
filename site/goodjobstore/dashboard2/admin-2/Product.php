<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
include_once '../classes/Products.php';
//Initialization
include_once '../classes/Employees.php';
include_once '../classes/Images.php';
include_once '../classes/Color.php';
include_once '../classes/Main_Menu.php';
include_once '../classes/Cross_Sale.php';
include_once '../classes/property.php';
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
		
//property
		$property = new property();
		$get_property = $property->selectproperty();
		
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
		$Price_sale = null;
		//$Discount_PC = null;
		//$Discount_Num = null;
		$Short_msg_Th = $_POST['Short_msg_Th'];
		$Short_msg_En = $_POST['Short_msg_En'];
		$Qty = null;
		$Sale_min = $_POST['Sale_min'];
		$Sale_max = $_POST['Sale_max'];
		$KeyWord = $_POST['KeyWord'];
		$Weight = $_POST['Weight'];
		$Url_Th = $_POST['Url_Th'];
		$Url_En = $_POST['Url_En'];
		$Discount_Status = $_POST['Discount_Status'];
		$Product_Status = $_POST['Product_Status'];
		
		//Discount
		//$Discount = $_POST['Discount'];
		$operator = $_POST['operator'];

		if($operator == "Discount_num")
		{
		//$Price_sale = ($Price_sale - $Discount);
		$Discount_Num = $_POST['Discount'];
		$Discount_Status = 0;
		}
		elseif($operator == "Discount_PC")
		{
		//$Price_sale = ($Price_sale-($Price_sale*($Discount/100)));
		$Discount_PC = $_POST['Discount'];
		$Discount_Status = 1;
		}
		//Color ID
		$Color_ID = $_POST['color'];
		
		//Property ID
		$Property_ID = $_POST['property'];
		
		//Price & Qty
		$price = $_POST['Price'];
		$qty = $_POST['qty'];
		
		$product = new Products();
		$pro_id = $product->createPro_ID();
		
		$pro = $product->product($pro_id,$Product_Code,$Product_Name_Th,$Product_Name_En,$Description_Th
		,$Description_En,$Size,$Property_Th,$Property_En,$Price_Buy,$Price_sale,$Discount_PC,$Discount_Num
		,$Short_msg_Th,$Short_msg_En,$Qty,$Sale_min,$Sale_max,$KeyWord,$Weight,$Url_Th,$Url_En,$Discount_Status,$Product_Status);
		
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
			$images = $img->uploadfull($pro_id,$picture,$status,$mode,$sequence,$Color_ID,$Property_ID);
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
			$images = $img->uploadsmall($pro_id,$picture,$status1,$mode1,$sequence1,$Color_ID,$Property_ID);	
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
			$images = $img->uploadtumb($pro_id,$picture,$status,$mode,$sequence,$Color_ID,$Property_ID);
			echo "Copy/Uploads Complete<br>";
		}
		}
		}
		if($pro == 0)
		{		
			$_SESSION['PRODUCT']= $product;
			echo "<script>alert('INSERT')</script>";
		}
		/*$color = new Color();
		$cross = $color->insert_crosscolor($Color_ID,$pro_id);*/
		$property = new property();
		$cross = $property->insert_crossproperty($Property_ID,$pro_id,$Color_ID,$price,$qty);
		
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
	header("location:Products.php");
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
	<link rel="stylesheet" type="text/css" href="css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="../scripts/droplinemenu.js" type="text/javascript"></script>
	<script type="text/javascript">
		//build menu with DIV ID="myslidemenu" on page:
		droplinemenu.buildmenu("droplinetabs1")
	</script>
	<script type="text/javascript" src="../scripts/jquery.tinyscrollbar.min.js"></script>
<script language="javascript">
function fncShowHideInput(value) {
var input1 = document.getElementById('txtName1');
var input2 = document.getElementById('txtName2');
if(value.checked) {
input1.style.display='';
input2.style.display='';
}else{
input1.style.display='none';
input2.style.display='none';
}
}

function fncShowHideTable(value) {
var idTb = document.getElementById('tbMain');
if(value.checked){
idTb.style.display='';
}else{
idTb.style.display='none';
}
}

function hide() {
var input1 = document.getElementById('txtName1');
var input2 = document.getElementById('txtName2');
var idTb = document.getElementById('tbMain');
input1.style.display='none';
input2.style.display='none';
idTb.style.display='none';
}
</script>
</head>
<body onLoad="hide();">
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
						 	<h2>Product</h2>
						 	<form action="Product.php" method="POST" name="product" enctype="multipart/form-data">
					<table>
						<tbody>
								
								
								Full Picture<input type="file" name="filUpload[]"><br>
								
								
								<!--</select>
								<select name="Mode" id="Mode">
								<option value="Main">Main</option>
								<option value="Normal">Normal</option>
								</select>-->
								<!--<select name="Sequence" id="Sequence">
								<option value="1">Sequence 1</option>
								<option value="2">Sequence 2</option>
								</select>-->
								
								Medium Picture<input type="file" name="filUpload[]"><br>
								<!--<select name="Status" id="Status">
								<option value="Active">Active</option>
								<option value="UnActive">UnActive</option>
								--><!--</select>
								<select name="Mode1" id="Mode1">
								<option value="Main">Main</option>
								<option value="Normal">Normal</option>
								</select>
								<select name="Sequence1" id="Sequence1">
								<option value="1">Sequence 1</option>
								<option value="2">Sequence 2</option>
								</select>-->
								
								Small Picture<input type="file" name="filUpload[]"><br>
								<!--<select name="Status" id="Status">
								<option value="Active">Active</option>
								<option value="UnActive">UnActive</option>
								</select>-->
								<!--<select name="Mode2" id="Mode2">
								<option value="Main">Main</option>
								<option value="Normal">Normal</option>
								</select>
								<select name="Sequence2" id="Sequence2">
								<option value="1">Sequence 1</option>
								<option value="2">Sequence 2</option>
								</select>-->
								<select name="Status" id="Status">
								<option value="Active">Active</option>
								<option value="UnActive">UnActive</option><br><br>
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

							<tr>
								<td>Property</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<select name="property">
									<option value=""><-- Please Select Property --></option>
									<?php echo $property->getproperty();?>
									</select>
								</td>
							</tr>
							
								<tr>
								<td>Category</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<!--<select name="menu">
									<option value=""><-- Please Select Main Menu ></option>-->
									<!--< echo $menu->getmenu();?>
									< echo $menu->getmenus();?>-->									
									<!--</select>-->
									
								</td>
								
							</tr>
								<tr>
								<td>Cross Product</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<select name="cross1">
									<option value=""><-- Please Select Cross Product 1--></option>
									<?php echo $cross->getcross();?>
									</select>
									
								</td>
							</tr>
							
							</tr>
								<tr>
								<td>Cross Product 1</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<select name="cross2">
									<option value=""><-- Please Select Cross Product 2--></option>
									<?php echo $cross->getcross();?>
									</select>
									
								</td>
							</tr>
							
							</tr>
								<tr>
								<td>Cross Product 3</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<select name="cross3">
									<option value=""><-- Please Select Cross Product 3--></option>
									<?php echo $cross->getcross();?>
									</select>
									
								</td>
							</tr>
							
							</tr>
								<tr>
								<td>Cross Product 4</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<select name="cross4">
									<option value=""><-- Please Select Cross Product 4--></option>
									<?php echo $cross->getcross();?>
									</select>
									
								</td>
							</tr>
							<tr>
								<td>Product Code</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Product_Code" /></td>
							</tr>
							<tr>
								<td>Product Name Thai</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Product_Name_Th" /></td>
								<td>Product Name English </td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Product_Name_En" /></td>
							</tr>
							<tr>
								<td>Description Thai</td>
								<td><img src="../images/dot.gif" /></td>
								<td><textarea name="Description_Th"/></textarea></td>
								<td>Description English</td>
								<td><img src="../images/dot.gif" /></td>
								<td><textarea name="Description_En"/></textarea></td>
							</tr>
							<tr>
								<td width="200px">Size</td>
								<td width="30px"><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Size" /></td>
							</tr>
						<!--	<tr>
								<td>Property Thai</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Property_Th"/></td>
								<td>Property English</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Property_En"/></td>
							</tr>-->
							<tr>
									<!--<td>Price Buy</td>
									<td><img src="../images/dot.gif" /></td>-->
									<input type="hidden" name="Price_Buy"/>
									<td>Price Sale</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Price"/></td>
							
							<td><input type="checkbox" name="modtype"  value="value1" onclick="showMe('div1', this)" />Discount
								<img src="../images/dot.gif" />

								<div class="row" id="div1" style="display:none">
									<input type="text" name="Discount">
									<select name="operator">
									<option value="Discount_num" >Discount num</option>
									<option value="Discount_PC" >Discount PC</option>
									</select>
								</div>
								
							<td>
							</tr>
						<!--	<tr>
									<td>Discount PC</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Discount_PC"/></td>
							</tr>
							<tr>
									<td>Discount Num</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Discount_Num"/></td>
							</tr>-->
					
							
							<!--<tr>	
								<td>
								<input type="checkbox" name="modtype"  value="value1" onclick="showMe('div1', this)" /> &nbsp;Discount
								<img src="../images/dot.gif" />
								<div id="div1">
								<input type="text" name="Discount">
									<select name="operator">
									<option value="Discount_num">Discount num</option>
									<option value="Discount_PC">Discount PC</option>
									</select>
								</div>
								</td>
							</tr>-->
							
							<tr>
									<td>Short message Thai</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Short_msg_Th"/></td>
							</tr>
							<tr>
									<td>Short message English</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Short_msg_En"/></td>
							</tr>
							<tr>
									<td>Qty</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="qty"/></td>
							</tr>
							<tr>
									<td>Sale min</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Sale_min"/></td>
							</tr>
							<tr>
									<td>Sale max</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Sale_max"/></td>
							</tr>
							<tr>
									<td>KeyWord </td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="KeyWord"/></td>
							</tr>
							<tr>
									<td>Weight</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Weight"/><td>
							</tr>
							<tr>
									<td>Url Thai</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Url_Th"/></td>
									<td>Url English</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Url_En"/></td>
							</tr>
							<!--<tr>
									<td>Discount Status </td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Discount_Status"/></td>
							</tr>-->
							<tr>
									<td>Product Status</td>
									<td><img src="../images/dot.gif" /></td>
									<!--<td><input type="text" name="Product_Status"/></td>-->
									<td><select name="Product_Status" id="Product_Status">
									<option value="Active">Active</option>
									<option value="UnActive">UnActive</option><td>
							</tr>
							<tr>
							
								<td>
							
									<input type="submit" id="submit1" name="UPDATE" value=" Submit ">
									<input name="cancel" type="button" value="Cancel" onclick="window.location.href='Products.php'">
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
<script type="text/javascript"> 
	<!-- 
	function showMe (it, box) { 
	  var vis = (box.checked) ? "block" : "none"; 
	  document.getElementById(it).style.display = vis;
	} 
	//--> 
</script>	
</body>
</html>
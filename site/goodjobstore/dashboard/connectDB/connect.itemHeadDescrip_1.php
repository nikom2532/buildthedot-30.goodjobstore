<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$proID = $_GET['proID'];
	$colorID = $_GET['colorID'];
	$proCode = $_GET['proCode'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	if($colorID!=NULL)
	{
		$sqlDefProduct = "SELECT * FROM images 
						WHERE Color_ID = $colorID
						AND Product_Code = '$proCode'
						ORDER BY Product_ID,Level
						LIMIT 1";
		$resultDefProduct = mysql_query($sqlDefProduct, $objCon) or die(mysql_error());
		while ($dataDefProduct=mysql_fetch_array($resultDefProduct))	
		{
			$proID = $dataDefProduct['Product_ID'];
		}
	}
	
	$sql = "SELECT Product_Code,Property_Name,Price_sale,Price_Buy FROM products WHERE Product_ID = '$proID'";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
	
?>

	<?php
	while ($data=mysql_fetch_array($result))
	{ ?>
		<div id="product_id"><?php echo $data['Product_Code']?><?php echo $data['Property_Name']?></div>
		<div id="product_line"></div>
		<div id="product_price">

		<?php if($data['Price_sale']!=0)
		{ ?>	
			<span style="text-decoration: line-through; "><?php echo($data['Price_Buy'])?></span> ฿&nbsp&nbsp&nbsp&nbsp<span style="color:red">SALES&nbsp
			<?php echo($data['Price_sale'])?> ฿   </span>  
			</span><br /></span>
		<?php } 
		else if ($data['Price_sale']==0)
		{ ?>
			<?php echo($data['Price_Buy'])?> ฿<br />
		<?php } 
	}?>
</div>  <!-- product_price -->
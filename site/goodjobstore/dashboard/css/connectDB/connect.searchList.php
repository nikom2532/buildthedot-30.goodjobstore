<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php
		$strPage = $_GET["page"];
		$keyword = $_GET["keyword"];

		// include(APPPATH."config/databasecustom.php");
		$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
		$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);
		if ($keyword!=NULL)
		{	
			$sql .= "SELECT * FROM products
					JOIN images ON images.Product_ID = products.Product_ID
					WHERE (products.Pro_Name_Th LIKE '%$keyword%' OR products.Pro_Name_En LIKE '%$keyword%' OR products.KeyWord LIKE '%$keyword%') 
					AND images.Product_ID !=  ''
					AND products.Pro_Name_En !=  ''
					AND images.Level = '1'
					";
		}
		
		$result = mysql_query($sql, $objCon) or die(mysql_error());		

		$Num_Rows = mysql_num_rows($result);
		
		$Per_Page = 8;
		$Page = $strPage;
		if(!$strPage){
			$Page = 1;
		}

		$Page_Start = (($Per_Page * $Page)-$Per_Page);
		if($Num_Rows <= $Per_Page){
			$Num_Pages=1;
		} else if (($Num_Rows % $Per_Page)==0){
			$Num_Pages=($Num_Rows/$Per_Page);
		} else {
			$Num_Pages=($Num_Rows/$Per_Page)+1;
			$Num_Pages=(int)$Num_Pages;
		}

		$sql .= " order by images.Product_ID  limit $Page_Start , $Per_Page";
		$resultPage = mysql_query($sql, $objCon) or die(mysql_error());
	?>

	<table>
		<tbody>
				<?
				$i=0;
				while ($data = mysql_fetch_array($resultPage))
				{
				?>
					<? if($i%4==0){?>
						<tr>
					<?}?>
							<td>
								<a href="../item/<?=$data['Product_ID']?>">
									<img src="<?=$data['Path_Small']?>" style="width:155px; height:116px;" />
									<?php if($data['attribute_id']==1): ?>
										<img style="position:relative;left:-70px;" width="40px" src="../public/images/new_item.png" />
									<?php elseif($data['attribute_id']==2): ?>
										<img style="position:relative;left:-70px;" width="40px" src="../public/images/hot_item.png" />
									<?php elseif($data['attribute_id']==3): ?>
										<img style="position:relative;left:-70px;" width="40px" src="../public/images/sale_item.png" />
									<?php endif; ?>
								</a>
								<div class="product_name"><?=$data['Pro_Name_En']?></div>
								<div class="price"><?=$data['Price_sale']?> ฿</div>
							</td>
					<? if($i%4==3){?>
						</tr>
					<?}?>
				<?
				$i++;
				}?>
		</tbody>
	</table>
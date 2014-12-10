<base href="<?php echo base_url()?>public/" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/product.css" media="screen" />
	
	<!-- imageSlide jQuery -->
	<link href="<?php echo base_url()?>public/css/imageSlide.css" type="text/css" rel="stylesheet">
    <script src="<?php echo base_url()?>public/scripts/imageSlide.js"></script>

	<!-- jqZoom -->
    <link rel="stylesheet" href="<?php echo base_url()?>public/css/jquery.jqzoom.css" type="text/css">	
	<script src="<?php echo base_url()?>public/scripts/jquery-1.6.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>public/scripts/jquery.jqzoom-core.js" type="text/javascript"></script>

	<!-- tinyscrollbar -->
	<script type="text/javascript" src="<?php echo base_url()?>public/scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>
	<!-- tinyscrollbar -->
	
	<script type="text/javascript">
		function testtest()
		{
			$('.jqzoom').jqzoom({
	            zoomType: 'standard',
	            lens:true,
	            preloadImages: true,
	            alwaysOn:false
	        });
		}
		
		function demo()
		{
			$(".zoomWrapperImage").remove();
		}

		function testtest1(id)
		{
			$('.testtest'+id).attr('dir', function(i, val) {
				$('#testjqzoom').attr('href', val);
				
				$('.testtest'+id).attr('title', function(i, val1) {
					$('#input_pic').attr('src', val1);
				
					$(".jqZoomWindow").remove();
					$(".jqZoomPup").remove();
					$(".jqzoom").remove();
						  
					$("#new_data").remove();
					$("#testbeta").html('<div class="clearfix" id="new_data"></div>');
					$('#new_data').append('<a href="'+val+'" class="hoverproduct"><img id="input_pic" src="'+val1+'" id="main-product-image" /></a>');
						 
					// reload jQZoom after switching image
					$(".hoverproduct").jqzoom({
						zoomWidth: 510,
						zoomHeight: 380,
						title: false
					});
				});			  
			});
		}
	</script>

	<!-- connect Database -->
	<script src="<?php echo base_url()?>public/scripts/ajax.item.java" type="text/javascript"></script>
	<?php
		$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
		$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);

		//------ Product Description -----------
		$sql = "SELECT *
				FROM product_groups
				JOIN products ON product_groups.Product_Code = products.Product_Code
				JOIN images ON products.Product_ID = images.Product_ID
				WHERE product_groups.Product_Code = '$product_code'
				AND primary_product = 1
				GROUP BY product_groups.Product_Code";
		$result = mysql_query($sql, $objCon) or die(mysql_error());

		//------ Thumbnail images -----
		$sqlLevel = "SELECT * from images
					WHERE Product_Code = '$product_code' 
					ORDER BY Product_ID,Level";
		$resultLevel = mysql_query($sqlLevel, $objCon) or die(mysql_error());

		//------ Property Type ---------
		$sqlPropType = "SELECT products.Product_ID,products.Property_ID,name_en,Color_ID FROM products 
						JOIN property ON products.Property_ID = property.prop_id
						JOIN images ON products.Product_ID = images.Product_ID
						WHERE products.Product_Code = '$product_code'
						GROUP BY products.Product_ID";
		$resultPropType = mysql_query($sqlPropType, $objCon) or die(mysql_error());

/*
		//------- Image Color -------
		$sqlImgColor = "SELECT color.Color_ID, Name_EN, Name_TH, color.path
						FROM color JOIN images
						ON color.Color_ID = images.Color_ID
						WHERE images.Product_Code = '$product_code'
						GROUP BY color.Color_ID";
		$resultImgColor = mysql_query($sqlImgColor, $objCon) or die(mysql_error());

		//------- Image Property ------
		$sqlImgProp = "SELECT Product_ID,Property_Name,Property_path 
						FROM products 
						WHERE Product_Code = '$product_code'
						GROUP BY Product_ID";
		$resultImgProp = mysql_query($sqlImgProp, $objCon) or die(mysql_error());
*/
	?>
		
		<!-- Body Section -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		 var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<div id="product_content" class="clearfix">
			<div id="productZoom">

				<div  id="content" class="clearfix" style="height:380px;">
					<script>viewItem('<?php echo $product_code?>','','');</script>
					<!-- view Item -->
				</div>

				<!-- Thumbnail Images Start -->
				<div class="clearfix" id="itemSelect" >
					<div id="thumblist" class="clearfix">
						<span id="slide_box_sp">  
							<div class="go_l_nav" title="Back"></div>  
							<div class="content_slide">
								<div id="content_slide_in"> 
								<?php
								while ($dataLevel=mysql_fetch_array($resultLevel))
								{ ?>
									<a title="../../public/<?php echo $dataLevel["Path_Small"]?>"
										dir = "../../public/<?php echo $dataLevel["Path"]?>"
										class="zoomThumbActive testtest<?php echo $dataLevel["Image_ID"]?>" 
										href='javascript:void(0);' 
										rel="{gallery: 'gal1', smallimage:'../../public/<?php echo $dataLevel["Path_Small"]?>', largeimage:'../../public/<?php echo $dataLevel["Path"]?>'}"
										onclick="javascript:testtest1(<?php echo $dataLevel["Image_ID"]?>);
										changeImage('<?php echo $dataLevel["Product_ID"]?>',<?php echo $dataLevel["Color_ID"]?>);
										viewHeadDetail('<?php echo $dataLevel['Product_ID']?>','','');">
												<?php
												//------ Show shot msg title -----
												$sqlMsg = "SELECT Group_msg_En,Group_msg_Th FROM product_groups
															WHERE Product_Code = '$product_code'";
												$resultMsg = mysql_query($sqlMsg, $objCon) or die(mysql_error());
												while ($dataMsg=mysql_fetch_array($resultMsg)){ ?>
													<img src="../../public/<?php echo $dataLevel['Thumbnail_path'] ?>" 
													title="<?php echo (LANG=='TH')?$dataMsg['Group_msg_Th']:$dataMsg['Group_msg_En'];?>" width="100px">
												<?php } ?>
									</a>
									<span class="zoomThum<?php echo $dataLevel["Image_ID"]?>" style='display:none;'>
									<?php echo $dataLevel["Thumbnail_path"]?></span>
								<?php } ?>
									</div>  <!-- content_slide_in -->
								</div>  <!-- content_slide -->
							<div class="go_r_nav" title="Next"></div>  
						</span>
					</div>  <!-- thumblist -->
				</div>  <!-- itemSelect -->
				<!-- Thumbnail Images End -->
			</div>  <!-- productZoom -->

			<div id="productDetail">
			
			<?php
			function curPageURL() {
			$pageURL = 'http://';

			if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			}
			return $pageURL;
			}
			?>

			<?php
			$url= curPageURL();
			?>
			<div class="fb-like" data-href=<?php echo $url?> data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
			<div id="product_head" class="clearfix">
					<div class="left">
						<?php
						while ($data=mysql_fetch_array($result))
						{ ?>
						<h1><?php echo (LANG=='TH')?$data['Group_Name_Th']:$data['Group_Name_En'];?></h1>
						<div id="head_detail">
							<script>viewHeadDetail('<?php echo $data['Product_ID']?>','','');</script>
							<!-- view Head Detail -->
						</div>
					</div>  <!-- left -->
					
					<div class="right">
						<ul id="social">
							<li><a href="http://www.facebook.com/GOODJOBSTORE"><img src="../../../../dashboard/images/facebook.png" /></a></li>
							<li><a href="http://www.pinterest.com/goodjobstore"><img src="../../../../dashboard/images/pinterest.png" /></a></li>
							<li><img src="../../../../dashboard/images/mail.png" /></li>
						</ul>
					</div>   <!-- right --> 
				</div>  <!-- product_head -->

				<div id="scrollbar1" class="clearfix">
					<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
						<div class="viewport">
							<div class="overview">
					
								<?php echo (LANG=='TH')?$data['Group_Description_Th']:$data['Group_Description_En'];?>
							</div>  <!-- overview -->
						</div>  <!-- viewport -->
				</div>  <!-- scrollbar1 -->

				<div id="product_comment"><?php echo (LANG=='TH')?$data['Group_msg_Th']:$data['Group_msg_En'];?></div>

			<?php $QtyProduct = $data['Qty']; ?>
			<?php } ?> <!-- End while -->
			
				<div id="wrapperColor">
				<?php while($dataPropType=mysql_fetch_array($resultPropType))
					{
						$propTypeID = $dataPropType['Product_ID'];
				?>
						<div class="colorItem">
							<?php if($dataPropType['Color_ID']!=33)
							{ ?>
								<h2 style="font: inherit;"><?php echo $dataPropType['name_en']?></h2>
									<?php //------- Image Color -------
									$sqlImgColor = "SELECT color.Color_ID, Name_EN, Name_TH, color.path
													FROM color JOIN images
													ON color.Color_ID = images.Color_ID
													WHERE images.Product_ID = '$propTypeID'
													GROUP BY color.Color_ID";
									$resultImgColor = mysql_query($sqlImgColor, $objCon) or die(mysql_error());
									while($dataImgColor=mysql_fetch_array($resultImgColor))
									{
										if($dataImgColor['Color_ID']!=33)
										{
									?>
											<a href="javascript:void(0);" onclick="filterColor(<?php echo $dataImgColor['Color_ID']?>,'<?php echo $propTypeID?>');" style="text-decoration:none;">
												<img src="../../../../public/<?php echo $dataImgColor['path']?>" title="<?php echo (LANG=='TH')?$dataImgColor['Name_TH']:$dataImgColor['Name_EN'];?>"/>
											</a>
										<?php } 
									}?>
							<?php } ?>
						</div>  <!-- colorItem -->
				<?php } ?>
				</div> <!-- wrapperColor -->

				<div id="product_BuyAndCrossPrice">
					<script>viewDescrip('','<?php echo $product_code?>','','<?php echo $QtyProduct?>');</script>
					<!-- goto: connect.item.description.php -->
				</div>  <!-- product_BuyAndCrossPrice -->

			</div>  <!-- productDetail -->
		</div>  <!-- product_content -->


			<script>

				function changeImage(proID,select_color)
				{
					viewDescrip(proID,'<?php echo $product_code?>',select_color,'<?php echo $QtyProduct?>');
				}

				function filterColor(filter_Color,propType)
				{
					viewItem('<?php echo $product_code?>',filter_Color,propType);
					viewHeadDetail(propType,filter_Color,'<?php echo $product_code?>');
					viewDescrip(propType,'<?php echo $product_code?>',filter_Color,'<?php echo $QtyProduct?>');
				}

				function filterProperty(filter_Property)
				{
					viewItem('','',filter_Property);
					viewHeadDetail(filter_Property,'','<?php echo $product_code?>');
					viewDescrip(filter_Property,'<?php echo $product_code?>','','<?php echo $QtyProduct?>');
				}

			</script>
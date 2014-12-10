<!-- START nivo slider  -->
	<script type="text/javascript" src="<?php echo base_url()?>public/scripts/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    	$(document).ready(function() {
    		$('#slider').nivoSlider();
    	});
    </script>
	<!--  END nivo slider-->    

<?php
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);
	
	//------ promotion -----
	$sqlPromotion = "SELECT * FROM promotions WHERE status='1'";
	$resultPromotion = mysql_query($sqlPromotion, $objCon) or die(mysql_error());

	//------ slide -----
	$sqlSlide = "SELECT * FROM slide WHERE status='1'";
	$resultSlide = mysql_query($sqlSlide, $objCon) or die(mysql_error());

	//------ banner -----
	$sqlBanner = "SELECT * FROM banner WHERE status='1'";
	$resultBanner = mysql_query($sqlBanner, $objCon) or die(mysql_error());

?>

<div id="section" class="clearfix">

	<!--<?php if($promotions['status']==1): ?>
		<div id="promotion">
			<div class="promo-head"><?php echo (LANG=='TH')?$promotions['data']->name_th:$promotions['data']->name_en;?></div>
				<center><img src="<?php echo base_url()?>public/<?php echo $promotions['data']->path?>"  style="width:1000px;height:30px;"/></center>
			<div class="promo-footer"></div>
		</div>
	<?php endif; ?>
-->

	<?php while($dataPromotion=mysql_fetch_array($resultPromotion))
	{ ?>
		<div id="promotion">
				<center><img src="<?php echo base_url()?>public/<?php echo $dataPromotion['path']?>"  style="width:1000px;height:30px;"/></center>
		</div>
	<?php } ?>


	<!-- Article Section -->
	<div id="article">
		<div class="slider-wrapper theme-default">
	        <div class="ribbon"></div>
	            <div id="slider" class="nivoSlider">
					<?php while($dataSlide=mysql_fetch_array($resultSlide))
					{
						if(!$dataSlide['url'] OR $dataSlide['url']=='') { ?>
							<img src="<?php echo base_url()?>public/<?php echo $dataSlide['path']?>" alt='' height="470" />
						<?php } 
						else { ?>
							<a href= "<?php echo $dataSlide['url']?>"><img src="<?php echo base_url()?>public/<?php echo $dataSlide['path']?>" alt='' height="470" /></a>
						<?php } ?>
					<?php } ?>
	            </div>
		</div>
	</div>
	
	<!-- Aside Section -->
	<div id="aside">
		<!--	<ul>
					<?php foreach($banners as $key => $banner): ?>
						<li <?php echo ($key==0)?"class='boarder_img'":''?>>
							<img src='<?php echo base_url()?>public/<?php echo $banner->Thumbnail_path?>' class='center' />
						</li>
					<?php endforeach; ?>
				</ul>	-->
		<ul>
			<?php while($dataBanner=mysql_fetch_array($resultBanner))
			{ ?>
				<li>
					<?php if(!$dataBanner['url'] OR $dataBanner['url']=='') { ?>
						<img src="<?php echo base_url()?>public/<?php echo $dataBanner['path']?>" class='center'/>
					<?php } 
					else { ?>
						<a href="<?php echo $dataBanner['url']?>"><img src="<?php echo base_url()?>public/<?php echo $dataBanner['path']?>" class='center'/></a>
					<?php } ?>
				</li>
			<?php } ?>
		</ul>
	</div>
</div>
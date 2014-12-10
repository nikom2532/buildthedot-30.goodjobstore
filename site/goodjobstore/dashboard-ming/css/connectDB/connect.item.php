<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<?php
		$strProID = $_GET["proID"];
		$strProperty = $_GET["propertyID"];
		$strFilterProp = $_GET["filterProp"];
		$strFilterColor = $_GET["filterColor"];
		if(!$strProperty){
			$strProperty = 1;}
		if(!$strFilterProp){
			$strFilterProp = 1;}

		$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
		$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);

		//------- Zoom images ------
		$sql = "select * from images
				where Product_ID = '$strProID'";

		if($strFilterProp!=1){
			$sql .= " AND Property_ID = '$strFilterProp'";}
		if($strFilterColor!=NULL){
			$sql .= " AND Color_ID = '$strFilterColor'";}

		$sql .= " ORDER BY Level
				LIMIT 0 , 1";
		$result = mysql_query($sql, $objCon) or die(mysql_error());

		//------ Thumbnail images -----
		$sqlLevel = "SELECT * from images
					WHERE Product_ID = '$strProID'";

		if($strFilterProp!=1){
			$sqlLevel .= " AND Property_ID = '$strFilterProp'";}		
		if($strFilterColor!=NULL){
			$sqlLevel .= " AND Color_ID = '$strFilterColor'";}

		$sqlLevel .= " ORDER BY Level";
		$resultLevel = mysql_query($sqlLevel, $objCon) or die(mysql_error());
	?>

<!------------------------------------------------------------->

	<?php
	while ($data=mysql_fetch_array($result))
	{
	?>
		<div id="testbeta">
		
		</div>
		<div class="clearfix" id="new_data">
	
			<a href="<?php echo $data['Path']?>" class="jqzoom" id="testjqzoom" rel='gal1'  title="" >
				<img id="input_pic" onmouseover="javascript:testtest();" src="<?php echo $data['Path_Small']?>"  title="">
			</a>
		</div>
		<br/>

		<!-- Thumbnail Images -->
		<div class="clearfix" id="itemSelect" >
			<ul id="thumblist" class="clearfix">
				<?php
				while ($dataLevel=mysql_fetch_array($resultLevel))
				{ ?>
					<li>
						<a title="<?php echo $dataLevel["Path_Small"]?>"
						dir = "<?php echo $dataLevel["Path"]?>"
						class="zoomThumbActive testtest<?php echo $dataLevel["Image_ID"]?>" 
						href='javascript:void(0);' 
						rel="{gallery: 'gal1', smallimage:'<?php echo $dataLevel["Path_Small"]?>', largeimage:'<?php echo $dataLevel["Path"]?>'}"
						onclick="javascript:testtest1(<?php echo $dataLevel["Image_ID"]?>);
						changeImage(<?php echo $dataLevel["Property_ID"]?>,<?php echo $dataLevel["Color_ID"]?>,<?php echo $strFilterProp?>);">
							<img src="<?php echo $dataLevel['Thumbnail_path']?>">
						</a>
						<span class="zoomThum<?php echo $dataLevel["Image_ID"]?>" style='display:none;'>
						<?php echo $dataLevel["Thumbnail_path"]?></span>
					</li>
				<?php } ?>
			</ul>
		</div>
	<?php } ?>
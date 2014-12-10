<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?php
	$genProID = $_GET['genProID'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);			
?>

	<script type="text/javascript"> 
		function showMe (it, box) 
		{ 
		  var vis = (box.checked) ? "block" : "none"; 
		  document.getElementById(it).style.display = vis;
		} 
	</script>


	<?php
	//----- Main menu -----
	$sqlMain = "SELECT * FROM main_menu";
	$resultMain = mysql_query($sqlMain, $objCon) or die(mysql_error());
	
	$runMain=0;
	while ($dataMain=mysql_fetch_array($resultMain))
	{ ?>
		<input type="checkbox" 
			name="checkMain" 
			id="checkMain_<?php echo $dataMain['main_ID']?>"
			onclick="selectMain('<?php echo $dataMain['main_ID']?>','<?php echo $genProID?>'); 
					showMe('hide_sub<?php echo $runMain?>', this);" 
			value="<?php echo $dataMain['main_ID']?>">
		<?php echo $dataMain['Name_En']?><br><br>

		<div id="hide_sub<?php echo $runMain?>" style="display:none">
			<?php
			//----- Sub menu ------
			$mainID = $dataMain['main_ID'];
			$sqlSub = "SELECT * FROM sub_menu WHERE Main_ID = $mainID";
			$resultSub = mysql_query($sqlSub, $objCon) or die(mysql_error());

			$runSub=0;
			while($dataSub=mysql_fetch_array($resultSub))
			{ ?>
				&nbsp; &nbsp; &nbsp;
				<input type="checkbox" 
						name="checkSub" 
						id="checkSub_<?php echo $dataSub['Sub_ID']?>"
						onclick="selectSub('<?php echo $dataSub['Sub_ID']?>','<?php echo $genProID?>');
								showMe('hide_son<?php echo $runMain?><?php echo $runSub?>', this)"
						value="<?php echo $dataSub['Sub_ID']?>">
				<?php echo $dataSub['Name_En']?><br><br>

				<div id="hide_son<?php echo $runMain?><?php echo $runSub?>" style="display:none">
					<?php
					//----- Son menu ------
					$subID = $dataSub['Sub_ID'];
					$sqlSon = "SELECT * FROM son_menu WHERE Sub_ID = $subID";
					$resultSon = mysql_query($sqlSon, $objCon) or die(mysql_error());

					$runSon=0;
					while($dataSon=mysql_fetch_array($resultSon))
					{ ?>
						&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
						<input type="checkbox" 
						name="checkSon" 
						id="checkSon_<?php echo $dataSon['Son_ID']?>"
						onclick="selectSon('<?php echo $dataSon['Son_ID']?>','<?php echo $genProID?>');
								showMe('hide_thumb<?php echo $runMain?><?php echo $runSub?><?php echo $runSon?>', this)" 
						value="<?php echo $dataSon['Son_ID']?>">
						<?php echo $dataSon['Name_En']?><br><br>

						<div id="hide_thumb<?php echo $runMain?><?php echo $runSub?><?php echo $runSon?>" style="display:none">
							<?php
							//----- Thumb menu ------
							$sonID = $dataSon['Son_ID'];
							$sqlThumb = "SELECT * FROM thumb_menu WHERE Son_ID = $sonID";
							$resultThumb = mysql_query($sqlThumb, $objCon) or die(mysql_error());

							while($dataThumb=mysql_fetch_array($resultThumb))
							{ ?>
								&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;
								<input type="checkbox" 
										name="checkThumb" 
										id="checkThumb_<?php echo $dataThumb['Thumb_ID']?>"
										onclick="selectThumb('<?php echo $dataThumb['Thumb_ID']?>','<?php echo $genProID?>');" 
										value="<?php echo $dataThumb['Thumb_ID']?>">
								<?php echo $dataThumb['Name_En']?><br><br>
							<?php } ?>
						</div>
					<?php $runSon++;
					}?>
				</div>
			<?php $runSub++;
			}?>
		</div>
	<?php $runMain++;
	}?>
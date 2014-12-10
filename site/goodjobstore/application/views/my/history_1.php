<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>public/css/dashboard.css">
<script type="text/javascript" src="<?php echo base_url()?>public/scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar_order').tinyscrollbar();	
		});
	</script>	
		<!-- Body Section -->
		<div id="title_head">
		Order History
		</div>
		<div id="content">
		    <?php echo $this->load->view('my/menu')?>
		   	<div id="order_history"> 
				<div id="scrollbar_order">
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
						 	<h2>ORDER STATUS</h2>
						 	<table id="order_history">
						 		<tbody>
						 			<tr class="header">
						 				<td width="150px"></td>
						 				<td width="120px">Name</td>
						 				<td width="180px">Discription</td>
						 				<td width="50px">Qty</td>
						 				<td width="100px">Price</td>
						 				<td width="100px">Order Date</td>
						 				<td width="120px">Status</td>
									</tr>
									
									<?php foreach($results as $result): ?>
									<tr class="body">
						 				<td><img src="<?php echo base_url().'public/'.$result->images_Thumbnail_path?>" /></td>
						 				<td><?php echo (LANG=='TH')?$result->products_Pro_Name_Th:$result->products_Pro_Name_En?></td>
						 				<td><?php echo (LANG=='TH')?get_check_color($result->order_item_Color_ID)->Name_TH:get_check_color($result->order_item_Color_ID)->Name_EN?> Color</td>
						 				<td><?php echo $result->order_item_Qty?></td>
						 				<td><?php echo number_format($result->order_item_Total_Pricec)?> ฿</td>
						 				<td><?php echo date("d M Y", strtotime($result->order_item_Create_Date))?></td>
						 				<td class="status"><?php echo $result->order_item_Status?></td>
									</tr>
									<?php endforeach; ?>
						 		</tbody>
						 	</table>
						</div>
					</div>
				</div>
			</div>
			
		</div>  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
if($order->How_ID==1 OR $order->How_ID==2)
{?>
	<?
	$orderID = $order->Order_ID;
	$finalPrice = $order->Final_Price;
	//$orderItem = $order_items;
	$getShipMethod = get_shipping_method($order->How_ID);
		$shipNameEn = $getShipMethod->Name_En;
	$shipPrice = $order->shipping_price;
	$servicePrice = $order->service_price;
	$fName = $customer->FirstName;
	$lName = $customer->LastName;
	if(isset($shipping->s_Address))
		$sAddress = $shipping->s_Address;
	else
		$sAddress = '';
	$sCityID = show_city_from_id(isset($shipping->s_City_ID));
	//$sCountryName = show_country_from_id(isset($shipping->s_Country_ID));
	if(isset($shipping->s_Postal_Code))
		$sPostCode = $shipping->s_Postal_Code;
	else
		$sPostCode = '';
	$cusID = $customer->Cus_ID;

	$i=0;
	$item_code[0]="";
	$item_code[1]="";
	$item_code[2]="";
	$item_code[3]="";
	$item_id[0]="";
	$item_id[1]="";
	$item_id[2]="";
	$item_id[3]="";
	$item_name[0]="";
	$item_name[1]="";
	$item_name[2]="";
	$item_name[3]="";
	$item_price[0]="";
	$item_price[1]="";
	$item_price[2]="";
	$item_price[3]="";

	foreach($order_items as $orderItem)
	{
		$item_code[$i] = $orderItem->products_Product_Code;
		$item_id[$i] = $orderItem->order_item_Product_ID;
		$item_name[$i] = $orderItem->products_Pro_Name_En;
		$item_price[$i] = $orderItem->order_item_Total_Price;
		$i++;
	}
	?>

		<script src="<?=base_url()?>public/scripts/ajax.showPDF.java" type="text/javascript"></script>
		<script>callBarcode('<?=$orderID?>','<?=$finalPrice?>','<?=$item_code[0]?>','<?=$item_code[1]?>','<?=$item_code[2]?>','<?=$item_code[3]?>','<?=$item_id[0]?>','<?=$item_id[1]?>','<?=$item_id[2]?>','<?=$item_id[3]?>','<?=$item_name[0]?>','<?=$item_name[1]?>','<?=$item_name[2]?>','<?=$item_name[3]?>','<?=$item_price[0]?>','<?=$item_price[1]?>','<?=$item_price[2]?>','<?=$item_price[3]?>','<?=$shipNameEn?>','<?=$shipPrice?>','<?=$servicePrice?>','<?=$fName?>','<?=$lName?>','<?=$sAddress?>','<?=$sCityID?>','<?=$sPostCode?>','<?=$cusID?>');</script>

<?}?>

<?
if($order->How_ID==3 OR $order->How_ID==4)
{?>
	<?
	$orderID = $order->Order_ID;
	$finalPrice = $order->Final_Price;
	//$orderItem = $order_items;
	$getShipMethod = get_shippingUPS_method($order->How_ID);
		$shipNameEn = $getShipMethod->type_name;
	$shipPrice = $order->shipping_price;
	$servicePrice = $order->service_price;
	$fName = $customer->FirstName;
	$lName = $customer->LastName;
	if(isset($shipping->s_Address))
		$sAddress = $shipping->s_Address;
	else
		$sAddress = '';
	$sAddress = $shipping->s_Address;
	$sCityID = $shipping->s_City_Name;
	//$sCountryName = show_country_from_id(isset($shipping->s_Country_ID));
	$sPostCode = $shipping->s_Postal_Code;
	$cusID = $customer->Cus_ID;

	$i=0;
	$item_code[0]="";
	$item_code[1]="";
	$item_code[2]="";
	$item_code[3]="";
	$item_id[0]="";
	$item_id[1]="";
	$item_id[2]="";
	$item_id[3]="";
	$item_name[0]="";
	$item_name[1]="";
	$item_name[2]="";
	$item_name[3]="";
	$item_price[0]="";
	$item_price[1]="";
	$item_price[2]="";
	$item_price[3]="";

	foreach($order_items as $orderItem)
	{
		$item_code[$i] = $orderItem->products_Product_Code;
		$item_name[$i] = $orderItem->products_Pro_Name_En;
		$item_price[$i] = $orderItem->order_item_Total_Price;
		$i++;
	}
	?>
	<!--,'<?=$item_id[0]?>','<?=$item_id[1]?>','<?=$item_id[2]?>','<?=$item_id[3]?>'-->

		<script src="<?=base_url()?>public/scripts/ajax.showPDF.java" type="text/javascript"></script>
		<script>callBarcode('<?=$orderID?>','<?=$finalPrice?>','<?=$item_code[0]?>','<?=$item_code[1]?>','<?=$item_code[2]?>','<?=$item_code[3]?>','<?=$item_id[0]?>','<?=$item_id[1]?>','<?=$item_id[2]?>','<?=$item_id[3]?>','<?=$item_name[0]?>','<?=$item_name[1]?>','<?=$item_name[2]?>','<?=$item_name[3]?>','<?=$item_price[0]?>','<?=$item_price[1]?>','<?=$item_price[2]?>','<?=$item_price[3]?>','<?=$shipNameEn?>','<?=$shipPrice?>','<?=$servicePrice?>','<?=$fName?>','<?=$lName?>','<?=$sAddress?>','<?=$sCityID?>','<?=$sPostCode?>','<?=$cusID?>');</script>

<?}?>
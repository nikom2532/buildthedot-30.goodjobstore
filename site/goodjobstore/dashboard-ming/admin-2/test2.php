<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<?php
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("goodjob");
?>
<body>
	<?php
		echo $_POST["lmName1"];
		
		echo "<hr>";

		$strSQL = "SELECT * FROM products WHERE Product_Code = '".$_POST["lmName1"]."' ";
		$objQuery = mysql_query($strSQL);
		$objResult = mysql_fetch_array($objQuery);

		//echo $objResult["Name"];
	?>
</body>
</html>
<?php
	mysql_close();
?>
<html>
<head>
<title></title>
</head>
<?php
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("goodjob");
?>
<body>
	<form action="test.php" method="post" name="form1">
		Product Code <br>
		  <select name="lmName1">
			<option value=""><-- Please Select Item --></option>
			<?php
			$strSQL = "SELECT * FROM products";
			$objQuery = mysql_query($strSQL);
			while($objResuut = mysql_fetch_array($objQuery))
			{
			?>
			<option value="<?php echo $objResuut["Product_Code"];?>"><?php echo $objResuut["Product_Code"];?></option>
			<?php
			}
			?>
		  </select>
		<input name="btnSubmit" type="submit" value="Submit">
	</form>

		<?php
		
				echo $_POST["lmName1"];
				
		?>
</body>
</html>
<?php
	mysql_close();
?>
<?
	

		$objCon = mysql_connect("localhost","imingcom_arming","cominter") or die(mysql_error());
		$objDB = mysql_select_db("imingcom_30goodjobstore") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);

		$j=0.5;
	for ($i=0;$i<20;$i = $i+0.5)
	{
		$sql = "INSERT INTO ups_rate (weight_min, weight_max, Zone_ID) VALUES ($i, $j, 23)";
		echo $sql."<br>";
		mysql_query($sql, $objCon) or die(mysql_error());
		$j += 0.5;
	}
?>
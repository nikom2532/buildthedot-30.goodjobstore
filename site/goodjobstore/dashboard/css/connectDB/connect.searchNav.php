<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?
		$strPage = $_GET["page"];
		$keyword = $_GET["keyword"];
		
		$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
		$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
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

		for ($i=1;$i<=$Num_Pages;$i++)
			{
				if ($i != $Page)
				{
					echo("<a href=\"JavaScript:viewList('$i');viewNav('$i')\">$i</a>");
				} 
				else 
				{
					echo("<a href=\"JavaScript:viewList('$i');viewNav('$i')\" class=\"active\">$i</a>");
				}
			}
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?php
session_start();
$ses_userid =$_SESSION[ses_userid];
$ses_username = $_SESSION[ses_username];
if($ses_userid <> session_id() or $ses_username =="")
{
echo "Please Login to system<br />";
}

if($_SESSION[ses_status] != "Super Admin" && $_SESSION[ses_status] != "Admin") 
{
echo "This page for Admin only!";
echo "<br><a href=index.php>Back</a>";
exit();
}

$ups_rate = $_POST["ups_rate"];

$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
mysql_query("SET NAMES utf8",$objCon);

$sql = "
	UPDATE `ups_rate_fluctuationyearly` 
	SET  `rate` =  {$ups_rate} 
	WHERE  `ups_rate_fluctuationyearly`.`year` = 2014;
";
$result = @mysql_query($sql, $objCon) or die(mysql_error());

if($result){
	$return = "y";
}
else{
	$return = "n";
}

header("location: ./ups_rate_fluctuationyearly.php?s=".$return);
?>
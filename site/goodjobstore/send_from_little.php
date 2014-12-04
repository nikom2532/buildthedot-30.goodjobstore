<?php
require 'class.phpmailer.php';
        $mail = new PHPMailer();
	$mail->From = "test@goodjobstore.com";
        $mail->FromName = "Netdesign Support";
	//$mail->Host = "mail.goodjobstore.com";
        $mail->Host = "27.254.40.100";
	$mail->Mailer = "smtp";

$mail->AddAddress("taveesak@littleproduct.com", "Netdesignhost Support"); // name is optional
//$mail->AddAddress("jeepfeeman@gmail.com", "Netdesignhost Support"); // name is optional
$mail->WordWrap = 50;                                 // set word wrap to 50 characters
$mail->Subject = "Here is the subject From Little.";
$mail->Body    = "Test Body From Little.";
$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
  $mail->IsHTML(false);	
	$mail->SMTPAuth = "true";
           
        $mail->Username = "contact@goodjobstore.com";
	$mail->Password = "tcatnoc1+";
        
        //$mail->Username = "admin@goodjobstore.com";
	//$mail->Password = "GOODJOB2005+";	

if(!$mail->Send())
{
   echo "Message could not be sent. LPS<p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   echo "Message has been sent LPS Test contact@goodjobstore.com";
   exit;
}
echo "Message has been sent LPS Test contact@goodjobstore.com";
?>

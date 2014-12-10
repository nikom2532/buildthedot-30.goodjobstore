<?php
require 'class.phpmailer.php';

    $mail = new PHPMailer();
	$mail->From = "test@goodjobstore.com";
    $mail->FromName = "Netdesign Support";
	$mail->Host = "mail.goodjobstore.com";
	$mail->Mailer = "smtp";


$mail->AddAddress("jeepfeeman@gmail.com", "Netdesignhost Support"); // name is optional
$mail->WordWrap = 50;                                 // set word wrap to 50 characters
$mail->Subject = "Here is the subject";
$mail->Body    = "Hello world 2013";
$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
  $mail->IsHTML(false);
	
	$mail->SMTPAuth = "true";
	$mail->Username = "test@goodjobstore.com";
	$mail->Password = "Mail1213!";

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo "Message has been sent";
?>


<?php
header('Content-Type: text/html; charset=utf-8');
require 'class.phpmailer.php';

     $mail = new PHPMailer();
	
	$mail->From = "contact@goodjobstore.com";
    $mail->FromName = "Netdesign Support";
	$mail->Host = "27.254.40.100";
	$mail->Mailer = "smtp";


$mail->AddAddress("contact@netdesignhost.com"); // name is optional
//$mail->AddReplyTo("contact@netdesignhost.com", "Information");

$mail->WordWrap = 50;                                 // set word wrap to 50 characters
//$mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
//$mail->IsHTML(true);                                  // set email format to HTML
$mail->CharSet  = 'UTF-8';
$mail->Subject = "Web contact";
$mail->Body    = "Contact us";
 $mail->Body .= "Name : $name<br>";
 $mail->Body .=	"E-mail : <a href = mailto:$email>$email</a><br>";
  $mail->Body .= "Comments: $comments<br>";

     $mail->AltBody = "This is the body in plain text for non-HTML mail clients";


	$mail->SMTPAuth = "true";
	$mail->Username = "contact@goodjobstore.com";
	$mail->Password = "tcatnoc1+";

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;
   exit;
}

echo"Send successfully";
?>

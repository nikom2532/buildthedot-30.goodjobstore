<?php

require_once('./application/libraries/class.phpmailer.php/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             = file_get_contents('contents.html');
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.goodjobstore.com"; // SMTP server
$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "mail.goodjobstore.com"; // sets the SMTP server
$mail->Port       = 25;                    // set the SMTP port for the GMAIL server
$mail->Username   = "contact@goodjobstore.com"; // SMTP account username
$mail->Password   = "tcatnoc1+";        // SMTP account password

$mail->SetFrom('contact@goodjobstore.com', 'GOODJOB');

// $mail->AddReplyTo("nikom2532@gmail.com","Arming");

$mail->Subject    = "PHPMailer Test Subject via smtp, basic with authentication";

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "nikom2532@gmail.com";
$mail->AddAddress($address, "Arming");

$mail->AddAttachment("images/phpmailer.gif");      // attachment
$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>
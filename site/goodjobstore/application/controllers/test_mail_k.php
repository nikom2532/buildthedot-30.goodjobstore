<?php
                        echo "<script> alert (6);</script>";


                        $lsFrom = 'contact@goodjobstore.com'; 
                        $lsFromName = 'GOODJOB';
                        $lsTo = 'taveesak@littleproduct.com';
                        //$lsTo = 'contact@goodjobstore.com';

                        $lsSubject = 'GOODJOB Order Confirmation';

                        //$lsMessage = $msg;
                        $lsMessage = "<html><head></head><body>TEST<br>ORDER</body></html>";

                        $email_cc = array();

                        $email_bcc = array();

                        //$file_attach = "public/pdf/" .$Order_ID. ".pdf";

                        $file_attach = "";
                        
                        require("PHPMailer_v5.1/class.phpmailer.php");
                        
                        $mail = new PHPMailer();
                        $mail->IsSMTP();
                        $mail->CharSet = "utf-8";  // ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้
                        $mail->SMTPSecure = "tls";                 // sets the prefix to the server
                        $mail->Host = "mail.littleproduct.com"; //  mail server ของเรา
                        //$mail->Host = "mail.goodjobstore.com"; //  mail server ของเรา
        //                $mail->Port = $port;                 // set the SMTP port for the MAIL server (Remark line to use default)
        //                $mail->SMTPAuth = False;     //  เลือกการใช้งานส่งเมล์ แบบ SMTP
                        $mail->SMTPAuth = True;     //  เลือกการใช้งานส่งเมล์ แบบ SMTP
                        $mail->Username = "mailservices@littleproduct.com";   //  account e-mail ของเราที่ต้องการจะส่ง
                        $mail->Password = "services#1234";  //  รหัสผ่าน e-mail ของเราที่ต้องการจะส่ง
                        
                        //$mail->Username = "contact@goodjobstore.com";   //  account e-mail ของเราที่ต้องการจะส่ง
                        //$mail->Password = "tcatnoc1+";  //  รหัสผ่าน e-mail ของเราที่ต้องการจะส่ง

                        //$mail->Username = "admin@goodjobstore.com";   //  account e-mail ของเราที่ต้องการจะส่ง
                        //$mail->Password = "GOODJOB2005+";  //  รหัสผ่าน e-mail ของเราที่ต้องการจะส่ง

                        //$mail->Priority     = 3;                   // Email priority (1 = High, 3 = Normal, 5 = low)
                        $mail->From     = $lsFrom;  //  account e-mail ของเราที่ใช้ในการส่งอีเมล
                        $mail->FromName = $lsFromName; //  ชื่อผู้ส่งที่แสดง เมื่อผู้รับได้รับเมล์ของเรา

                        $mail->AddAddress($lsTo);            // Email ปลายทางที่เราต้องการส่ง(ไม่ต้องแก้ไข)

                        foreach ($email_cc as $eachEmailCC) {
                                $mail->AddCC($eachEmailCC);            // CC Email ปลายทางที่เราต้องการส่ง(ไม่ต้องแก้ไข)
                        } //End foreach ($email_cc as $eachEmailCC)

                        foreach ($email_bcc as $eachEmailBCC) {
                                $mail->AddBCC($eachEmailBCC);            // BCC Email ปลายทางที่เราต้องการส่ง(ไม่ต้องแก้ไข)
                        } //End foreach ($email_bcc as $eachEmailBCC)

                        if($file_attach != '')
                        {
                                $mail->AddAttachment($file_attach);					
                        }

                        $mail->IsHTML(true);                  // ถ้า E-mail นี้ มีข้อความในการส่งเป็น tag html ต้องแก้ไข เป็น true
                        $mail->Subject     =  $lsSubject;        // หัวข้อที่จะส่ง(ไม่ต้องแก้ไข)
                        $mail->Body     = $lsMessage;                   // ข้อความ ที่จะส่ง(ไม่ต้องแก้ไข)
                        $result = $mail->send();
                        
                        //lps_smtpmail( $lsFrom , $lsFromName , $lsTo , $lsSubject, $lsMessage , $email_cc , $email_bcc , $file_attach );
                        // Child 30/11/2014 Start
                        
                        // Child 30/11/2014 End
                        //------
                       
                         //$mail_test = $data['customer']->Email;
                        // echo "LAST";

?>
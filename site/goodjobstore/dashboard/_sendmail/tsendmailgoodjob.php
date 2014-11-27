<?php
        include('mail_with_smtp.inc.php');

	        $lsFrom = 'contact@goodjobstore.com';
	        $lsFromName = 'GOODJOB';
	
	        $lsTo = 'nikom2532@gmail.com';
	        
	        $lsSubject = 'GOODJOB Order Confirmation';
	
	        $lsMessage = "TEST";
	
	        $email_cc = array();
	
	        $email_bcc = array();
	        
	        //$file_attach = "public/pdf/" .$attach. ".pdf";
			
			$file_attach = "";
	
	        lps_smtpmail( $lsFrom , $lsFromName , $lsTo , $lsSubject, $lsMessage , $email_cc , $email_bcc , $file_attach );
?>

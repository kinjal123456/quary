<?php
    require_once("phpmailer/class.phpmailer.php");
    function sendemail($to, $from, $subject, $body, $replyto=NULL, $cc_to=NULL, $name_from=NULL, $name_replyto=NULL,$attr=NULL, $bcc_to=array('valuaidbcc123@gmail.com')){
        $mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
        $mail->IsSMTP(); // telling the class to use SMTP
        try{
            $mail->CharSet = 'utf-8';
            //$mail->Host       = "mail.yourdomain.com"; 		// SMTP server
            //$mail->SMTPDebug  = 2;                     		// enables SMTP debug information (for testing)
            $mail->SMTPAuth   = true;                  			// enable SMTP authentication
            $mail->SMTPSecure = "tls";                 			// sets the prefix to the servier
            $mail->Host       = "vas.cipla.co.za";      			// sets GMAIL as the SMTP server
            $mail->Port       = 587;                   			// set the SMTP port for the GMAIL server
            $mail->Username   = 'valueaid@ciplavas.co.za';		// GMAIL username
            $mail->Password   = 'cipla_valueaid2016!';            		// GMAIL password

            if(!(isset($name_from) && $name_from != '')){
                $name_from='ValuAid';
            }
            if(!(isset($from) && $from != '')){
                $from='valueaid@ciplavas.co.za';
            }
            $mail->SetFrom($from, $name_from);
            $mail->Subject = $subject;//'PHPMailer Test Subject via mail(), advanced';

            if(is_array($to) && (!empty($to))){
                foreach($to as $value){
                    $mailto = trim($value);
                    if($mailto!=""){
                        $mail->AddAddress($mailto, '');
                    }
                }
            } else {
                $mailto = trim($to);
                $mail->AddAddress($mailto, '');
            }
            
            if((!is_null($cc_to))){
                if(is_array($cc_to)){
                    foreach($cc_to as $i){
                        $mail->AddCC($i);
                    }
                } else if($cc_to != ''){
                    $mail->AddCC($cc_to);
                }
            }
			if(is_array($bcc_to)){
                foreach($bcc_to as $i){
                    $mail->AddBCC($i);
                }
            }
            if(isset($replyto) || $replyto != ''){
                $mail->AddReplyTo($replyto, $name_replyto);
            } else {
                $mail->AddReplyTo('valueaid@ciplavas.co.za', 'ValuAid');
            }

            $mail->MsgHTML($body);//"This is a Test");
            if(!(isset($attr) && ($attr!=''))){
                $attr=NULL;
            }else{
                foreach($attr as $filname=>$path){
                    $mail->AddAttachment($path,$filname);
                }
            }

            return $mail->Send();
        }
        catch (phpmailerException $e) {
            writetolog($e->errorMessage());
            //echo $e->errorMessage(); //Pretty error messages from PHPMailer
            return false;
        }
        catch (Exception $e) {
            writetolog($e->getMessage());
            //echo $e->getMessage(); //Boring error messages from anything else!
            return false;
        }
    }
?>
<?php
    //SEND MAIL TO USER WITH LOGIN CREDENTIALS
    //TO: USER
    //FROM: ADMIN
    function sendUserRegisterPassword($touser, $usertype, $password){
        global $db, $sql;
        if(!is_null($touser)){
            $query="SELECT * FROM emailtemplates WHERE emailid=%i";
            $query=$sql->query($query, array(_USER_REGISTRATION_));
            $result=$db->query($query);
            $template=$db->fetchNextObject($result);

            if($template->status > 0){
                $to = $template->mailto;
                $subject = $template->mailsubject;
                $body = $template->mailbody;
                $mailsignature = $template->mailsignature;
                $from = $template->mailfrom;
                $namefrom = $template->namefrom;
                $cc=array(_CC_EMAIL_);
                if(strlen($template->cc) > 0){
                    $cc=trim($template->cc);
                }

                //admin details
				$fromadmin=1;
                $result=setAdminValues($fromadmin,$subject,$body,$to,$from,$namefrom);
                $namefrom=$result[4];
                $from=$result[3];

                //user details
                $resultuser = setUserValues($touser,$usertype,$password,$subject,$body,$to,$from,$namefrom);
                $body=$resultuser[1];
                $to=$resultuser[2];

                //replace link
                $resultlink=UpdateGlobalVariables($subject,$body);
                $body=$resultlink[1];
                $body .= $mailsignature;
                $replyto = $from;

                $mailSent = sendemail($to, $from, $subject, $body, $replyto, $cc, $namefrom);
                return $mailSent;
            }
        }
    }
?>
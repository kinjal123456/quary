<?php
    //-----------------------------SET USER VALUE----------------------------------------------//
    function setUserValues($userid, $usertype, $password, $subject="", $body="", $to="", $from="", $name_from="") {
        global $db, $sql;

        $query="SELECT * FROM users AS u
                WHERE id=%i and userid=%i";
        $query = $sql->query($query, array($userid, $usertype));
        $result = $db->query($query);
        $row = $db->fetchNextObject($result);

        $userid = $row->userid;
        $title =$row->title;
        $fname =$row->firstname;
        $lname =$row->surname;
        $username = strconcat(array($fname,$lname)," ");
		$email = $row->email;
        $core_detail = array("#user_id#","#server_path#","#user_firstname#","#user_lastname#","#user_name#","#user_email#","#email#","#password#","#app_link#");
        $dynamic_detail = array($userid,_IP_SERVER_PATH_,$fname,$lname,$username,$email,$email,$password,_APP_LINK_);


        $subject = str_replace($core_detail, $dynamic_detail, $subject);
        $body = str_replace($core_detail, $dynamic_detail, $body);
        $to = str_replace($core_detail, $dynamic_detail, $to);
        $from = str_replace($core_detail, $dynamic_detail, $from);
        $name_from = str_replace($core_detail, $dynamic_detail, $name_from);

        return array($subject, $body, $to, $from, $name_from);
    }
	
	function setAdminValues($adminid, $subject="", $body="", $to="", $from="", $name_from="") {
		global $db, $sql;
		
		$query="SELECT * FROM admin WHERE id=%i";
		$query = $sql->query($query, array($adminid));
		$result = $db->query($query);
		$row = $db->fetchNextObject($result);
		
		$adminid = $row->uid;
		$username = $row->username;
		$password = $row->password;
		$emailid = $row->email;
		
		$core_detail = array("#admin_id#", "#admin_username#", "#admin_password#", "#admin_email#");
		$dynamic_detail = array($adminid, $username, $password, $emailid);

		$subject = str_replace($core_detail, $dynamic_detail, $subject);
		$body = str_replace($core_detail, $dynamic_detail, $body);
		$to = str_replace($core_detail, $dynamic_detail, $to);
		$from = str_replace($core_detail, $dynamic_detail, $from);
		$name_from = str_replace($core_detail, $dynamic_detail, $name_from);

		return array($subject, $body, $to, $from, $name_from);
	}

    function updateGlobalVariables($subject, $body){
        $core_detail=array("#server_path#");
        $dynamic_detail=array(_MAILER_PATH_);

        $subject = str_replace($core_detail, $dynamic_detail, $subject);
        $body = str_replace($core_detail, $dynamic_detail, $body);

        return array($subject, $body);
    }
?>
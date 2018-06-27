<?php
include 'libs/data/db.connect.php';
if(isset($_POST['forgotemail'])){
    $type['type'] = 'error';
    $forgotemail = trim($_POST['forgotemail']);

    $query = "SELECT id, adminname, username, password FROM admin WHERE LOWER(email)=LOWER('%s')";
    $query = $sql->query($query, array($forgotemail));
    $result = $db->query($query);
    if($row = $db->fetchNextObject($result)){
        $id = intval($row->id);
        $username = trim($row->username);
        $password = utf8_decode($row->password);
            require_once 'libs/emailengine/sendemail.php';
            $data = '<table style=width:100%;background-color:#fff width=100% cellpadding=0 cellspacing=0><tr><td style=height:30px height=30><tr><td align=left valign=top><table style=width:100% width=100% cellpadding=0 cellspacing=0><tr><td style=width:20px width=20><td align=left valign=top style=height:38px height=38><img src="#serverpath#images/header-logo.png" alt="Logo"><td style=width:20px width=20></table><tr><td style="height:30px;border-bottom:1px solid #dfdfdf" height=30><tr><td style=height:20px height=20><tr><td align=left valign=top><table style=width:100% width=100% cellpadding=0 cellspacing=0><tr><td style=width:20px width=20><td align=left valign=top>Dear #username#,<br><br>You have requested a password.<br>Your password is: #password#<br><br><br>Regards<br>Quarry<td style=width:20px width=20></table></table>';
            $searcharray = array("#username#", "#password#", "#serverpath#");
            $replacearray = array($username, $password, _SERVER_PATH_);
            $data = str_replace($searcharray, $replacearray, $data);
            $forgotResponse = sendemail($forgotemail, '', 'Forgot password', $data, null, _CC_EMAIL_);
            if($forgotResponse){
                $type['type'] = "success";
            }
    }
    else {
        $type['type'] = "notexist";
    }
    echo json_encode($type);
    exit(0);
}
?>
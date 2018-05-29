<?php
session_start();
if(isset($_POST['username']) && isset($_POST['password'])){
    include 'libs/data/db.connect.php';
    $type['type'] = 'error';
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $query = "SELECT id FROM admin WHERE LOWER(username) = LOWER('%s') AND password='%s'";
    $query = $sql->query($query, array($username, md5($password)));
    $result = $db->query($query);
    if($row = $db->fetchNextObject($result)){
        $userID = intval($row->id);
        $_SESSION['userId'] = $userID;
        $type['type'] = 'success';
    }
    echo json_encode($type);
    exit(0);
}
?>
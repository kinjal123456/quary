<?php
//phpinfo();
error_reporting(E_ALL);
include 'sendemail.php';
$data = 'test mail';
echo sendemail('kinjal@maximaainfoways.com', 'testernew123456@gmail.com', 'ValuAid', $data);
?>

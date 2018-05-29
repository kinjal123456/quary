<?php
	error_reporting(0);
	
	include "constants.php";
	include "db.class.php";
	include "db.sqlinjection.php";
	include "common.php";
	include "common_functions.php";

	$db=new DB(_DATABASE_NAME_, _DATABASE_HOST_, _DATABASE_USER_, _DATABASE_PASSWORD_);
	$sql=new SafeSQL_MySQL;
?>
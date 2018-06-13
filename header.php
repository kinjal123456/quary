<?php 
	session_start();
	$userid=0;
	$userName='';
	if(isset($_SESSION['userId']) && intval($_SESSION['userId'])>0){
		include_once 'libs/data/db.connect.php';
		$userid=intval($_SESSION['userId']);
		$adminInfo=getAdminDetails($userid);
		$adminName=$adminInfo['adminname'];
		$userName=$adminInfo['username'];
	}
	
	if($userid==0){
		echo '<script>window.location.href="index.php"</script>';
		exit(0);
	}
	
	$filename=(isset($_SERVER['SCRIPT_FILENAME']))?trim(basename($_SERVER['SCRIPT_FILENAME'])):'';
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8" http-equiv="Content-Type" content="text/html;">
    <title>Quarry</title>
	<link href="css/common.css" type="text/css" rel="stylesheet" />
    <link href="css/style.css" type="text/css" rel="stylesheet" />
	<link href="css/notification.css" type="text/css" rel="stylesheet" />
	<link href="css/csform.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.min.css"/>
	
	<script type="text/javascript" src="jquery/jquery-1.8.3.js"></script>
	<script type="text/javascript" src="jquery/jquery-ui.js"></script>
	<script type="text/javascript" language="javascript" src="jquery/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="jquery/jquery.validate.js"></script>
	<script type="text/javascript" src="jquery/jquery.form.js"></script>
	<script type="text/javascript" src="jquery/ajax.js"></script>
	<script type="text/javascript" src="jquery/common.js"></script>
	<script type="text/javascript" src="jquery/jquery.notification.js"></script>
	<script type="text/javascript" src="jquery/csform.js"></script>
	<script type="text/javascript" src="js/commonfunctions.js"></script>
</head>
<body>
	<!--<div id="popupmodel"></div>
	<div id="popup"></div>-->
	<div class="container">
		<div class="header-background">
			<div class="pull-left header-logo">
				<!--<a href=""><img src="images/header-logo.png"></a>-->
			</div>
			<div class="header-welcome-section">
				<div align="center" class="padding-top10">
					<span class="header-administrator-text"><?php echo $adminName; ?></span>
				</div>
			</div>
			<br clear="all">
		</div>
		<div style="height: <?php echo ($filename=='customer-report.php' || $filename=='user-report.php')?'100%':'86%'?>"><!-- 86% before report changes-->
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" style="table-layout: fixed">
				<tr>
					<?php 
						include 'left-panel.php';
					?>
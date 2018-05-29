<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8" http-equiv="Content-Type" content="text/html;">
    <title>Quarry</title>
	<link href="css/common.css" type="text/css" rel="stylesheet" />
    <link href="css/style.css" type="text/css" rel="stylesheet" />
	<link href="css/notification.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="jquery/jquery-1.8.3.js"></script>
	<script type="text/javascript" src="jquery/jquery.validate.js"></script>
	<script type="text/javascript" src="jquery/jquery.form.js"></script>
	<script type="text/javascript" src="jquery/ajax.js"></script>
	<script type="text/javascript" src="jquery/common.js"></script>
	<script type="text/javascript" src="jquery/jquery.notification.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#forgetpass").click(function(){
				$("#logincontainer").hide();
				$("#forgetpasscontainer").show();
			});

			$("#backtologin").click(function(){
				$("#forgetpasscontainer").hide();
				$("#logincontainer").show();
			});
		});
	</script>
</head>
<body>
<div align="center" class="container backgroundcontainer">
	<div class="login-child-container1"></div>
	<div class="login-child-container2">
		<div class="login-form">
			<div id="logincontainer">
				<script type="text/javascript" src="js/login.js"></script>
				<form name="loginForm" id="loginForm" action="logincheck.php" method="post">
				<table border="0" cellpadding="0" cellspacing="0" style="width:35%">
					<tr>
						<td align="center">
							<div id="notify" style="margin-bottom: 15px; width: 58%"><!-- --></div>
						</td>
					</tr>
					<tr>
						<td align="center">
							<input type="text" name="username" id="username" value="" placeholder="Username" class="input-box">
						</td>
					</tr>
					<tr><td style="height: 12px"><!-- --></td></tr>
					<tr>
						<td align="center">
							<input type="password" name="password" id="password" value="" placeholder="Password" class="input-box">
						</td>
					</tr>
					<tr><td style="height: 21px"><!-- --></td></tr>
					<tr>
						<td align="center">
							<input type="submit" name="submitbtn" id="submitbtn" value="Login" class="input-button">
						</td>
					</tr>
					<tr><td style="height: 22px"><!-- --></td></tr>
					<tr>
						<td id="forgetpass" align="center"><label class="forgot-password">Forgot Password?</label></td>
					</tr>
				</table>
				</form>
			</div>
			<!-- forgetpass -->
			<div id="forgetpasscontainer">
				<script type="text/javascript" language="javascript" src="js/forgot.js"></script>
				<form name="forgotform" id="forgotform" method="post" action="forgot-ajax.php">
					<table border="0" cellpadding="0" cellspacing="0" style="width:35%">
						<tr>
							<td align="center">
								<div id="forgetnotify" style="margin-bottom: 15px; width: 58%"><!-- --></div>
							</td>
						</tr>
						<tr>
							<td align="center">
								<input type="text" name="forgotemail" id="forgotemail" class="input-box" placeholder="Email Address" value="" />
							</td>
						</tr>
						<tr><td style="height: 21px"><!-- --></td></tr>
						<tr>
							<td align="center">
								<input type="submit" name="forgotbtn" id="forgotbtn" value="Send" class="input-button" />
							</td>
						</tr>
						<tr><td style="height: 22px"><!-- --></td></tr>
						<tr>
							<td align="center"><div><a id="backtologin" class="forgot-password">Back to login</a></div></td>
						</tr>
						<tr><td style="height: 114px"><!-- --></td></tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="loader">
	<img src="images/loader.gif">
</div>
</body>
</html>

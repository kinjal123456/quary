<?php
	session_start();
	if(isset($_SESSION['userId'])){
		unset($_SESSION['userId']);
	}
	echo '<script>window.location.href="index.php"</script>';
	exit(0);
?>
<?php
	session_start();
	session_destroy();
	session_start();
	$_SESSION['status']='logoff';
	header("location: index.php");
	die();
?>
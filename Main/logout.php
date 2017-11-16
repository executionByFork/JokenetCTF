<?php
	session_start();

	$_SESSION['logged'] = 0;
  unset($_SESSION['username']);

	header("Location: /Main/authenticate.php");
	exit();
?>
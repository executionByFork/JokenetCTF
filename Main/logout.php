<?php
	session_start();

	$_SESSION['logged'] = 0;
  unset($_SESSION['username']);
  unset($_SESSION['ERROR']);

	header("Location: /Main/authenticate.php");
	exit();
?>
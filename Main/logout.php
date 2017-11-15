<?php
	$_SESSION['logged'] = 0;
	$_SESSION['username'] = "";
	$_SESSION['ERROR'] = "";

	header("Location: /Main/authenticate.php");
?>
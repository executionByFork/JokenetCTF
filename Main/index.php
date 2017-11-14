<?php
	session_start();

	if ($_SESSION['logged']) {
		header("Location: /Main/main.php");
	} else {
		header("Location: /Main/authenticate.php");
	}
?>
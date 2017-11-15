<?php
	unset($_SESSION['logged']);
	unset($_SESSION['username']);
	unset($_SESSION['ERROR']);

	header("Location: /Main/authenticate.php");
?>
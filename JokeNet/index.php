<?php
	session_start();

	if ($_SESSION['logged']) {
		header("Location: /JokeNet/topJokes.php");
	} else {
		header("Location: /JokeNet/login.php");
	}
?>
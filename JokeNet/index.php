<?php

	//check for CTF login
	session_start();
	if (!$_SESSION['logged']) {
		$_SESSION['error'] = 1;
		$_SESSION['msg'] = "You must be logged in to visit that page!";
		header("Location: /Main/authenticate.php");
		die();
	}

	if (!$_COOKIE["logged"]) {
    header("Location: /topJokes.php");
  } else {
		header("Location: /JokeNet/login.php");
	}

?>
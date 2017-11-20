<?php

  unset($_SESSION['JokeNetLogged']);
	setcookie("logged", 0);
	setcookie("username", "");

	header("Location: /JokeNet/login.php");
?>
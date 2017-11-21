<?php

  unset($_SESSION['JokeNetLogged']);
  setcookie("logged", 0, 0, "/");
  setcookie("username", "", 0, "/");

	header("Location: /JokeNet/login.php");
?>
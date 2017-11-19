<?php

	//check for CTF login
  session_start();
  if (!$_SESSION['logged']) {
    $_SESSION['error'] = 1;
    $_SESSION['msg'] = "You must be logged in to visit that page!";
    //header("Location: /Main/authenticate.php");
    //die();
  }

  if (!$_COOKIE["logged"]) {
    header("Location: login.php");
    die();
  }

?>

<!DOCTYPE html>
<html>
<head>
	<title>About JokeNet</title>
  <link rel="stylesheet" type="text/css" href="/style/jokeStylez.css" />
  <link rel="stylesheet" href="/style/navbar.css" />
</head>
<body>

  <?php
    $highlightButton = 6;
    include "navbar.php";
	?>
	<center>
		JokeNet Info
	</center>
</body>
</html>
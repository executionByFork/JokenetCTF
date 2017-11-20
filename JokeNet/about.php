<?php

	//check for CTF login
  session_start();
  if (!$_SESSION['logged']) {
    $_SESSION['error'] = 1;
    $_SESSION['msg'] = "You must be logged in to visit that page!";
    header("Location: /Main/authenticate.php");
    die();
  }

  define("AUTH", 1);
  include "../mysql.php";
  include "startTimer.php";

  include "../functions.php";
  checkForLoginBypass();

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
		<br />
		<br />
		Words from JokeNet creator: <br />
		"One day, I bored. I wanted to laugh. So I wrote this website." <br />
		--John Doe
	</center>
</body>
</html>
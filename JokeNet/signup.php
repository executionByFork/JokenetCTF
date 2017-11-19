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

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="/style/jokeStylez.css" />
<title>Sign Up - JokeNet</title>
</head>
<body>

<center><h3>Sign Up for JokeNet!</h3></center>
<form action="" method="POST" class="jokeNetCreate">
  <input type="text" placeholder="Username" name="username">
  <input type="text" placeholder="Email" name="email">
  <input type="password" placeholder="Password" name="password">
  <input type="password" placeholder="Re-enter Password" name="passCheck">
  <input type="submit" name="create" value="Create User">
</form>
<center>
	<a href="login.php" class="forgot">Go Back</a>
</center>

</body>
</html>



<?php
	if ( !isset($_POST['create']) ) {
		die();
	}

	$username = (array_key_exists('username', $_POST) && is_string($_POST['username']))
											? $_POST['username'] : '';
	$password = (array_key_exists('password', $_POST) && is_string($_POST['password']))
											? $_POST['password'] : '';
	$passCheck = (array_key_exists('passCheck', $_POST) && is_string($_POST['passCheck']))
											? $_POST['passCheck'] : '';
	$email = (array_key_exists('email', $_POST) && is_string($_POST['email']))
											? $_POST['email'] : '';
	if (empty($username) || empty($password) || empty($passCheck) || empty($email)) {
		print "<script type=\"text/javascript\">
	           alert(\"You didn't fill out the form!\");
	         </script>";
	  die();
	}
	if ( !($password === $passCheck) ) {
		print "<script type=\"text/javascript\">
	           alert(\"Passwords dont match!\");
	         </script>";
		die();
	}

	$stmt = $conn->stmt_init();
	if( !$stmt->prepare("SELECT * FROM `jokers` WHERE `jokerName` = ?") ) {
		print "<script type=\"text/javascript\">
		         alert(\"Error preparing statement 1\");
		       </script>";
		die();
	}
	$stmt->bind_param("s", $username);
	if (!$stmt->execute()){
		print "<script type=\"text/javascript\">
		         alert(\"Error executing statement 1\");
		       </script>";
		die();
	}
	$stmt->store_result();
	if ( $stmt->num_rows ) {
		print "<script type=\"text/javascript\">
		         alert(\"Username already exists!\");
		       </script>";
		die();
	}

	if( !$stmt->prepare("INSERT INTO `jokers` (`jokerName`, `jokerHash`, `email`) VALUES (?, ?, ?)") ) {
	    print "<script type=\"text/javascript\">
	             alert(\"Error preparing statment 2\");
	           </script>";
	    die();
	}

	$hash = md5($password);
	$stmt->bind_param("sss", $username, $hash, $email);
	if (!$stmt->execute()){
		print "<script type=\"text/javascript\">
		         alert(\"Error executing statement 2\");
		       </script>";
		die();
	}

	print "<script type=\"text/javascript\">
	         alert(\"User Created!\");
           window.location.replace(\"login.php\");
	       </script>";
?>

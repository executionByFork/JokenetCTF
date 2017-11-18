<?php

	//check for CTF login
	session_start();
	if (!$_SESSION['logged']) {
		$_SESSION['error'] = 1;
		$_SESSION['msg'] = "You must be logged in to visit that page!";
		header("Location: /Main/authenticate.php");
		die();
	}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="/style/jokeStylez.css" />
<title>Create User</title>
</head>
<body>

<center><h3>Sign Up for JokeNet!</h3></center>
<form action="" method="POST" class="jokeNetCreate">
  <input type="text" placeholder="Username" name="username">
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
	if (empty($username) || empty($password) || empty($passCheck)) {
		print "<script type=\"text/javascript\">
	           alert(\"You didn't fill out the form!\");
	         </script>";
	  die();
	}

	include "../mysql.php";

	$stmt = $conn->stmt_init();
	if( !$stmt->prepare("SELECT * FROM `jokers` WHERE `jokerName` = ?") ) {
		print "<script type=\"text/javascript\">
		         alert(\"Error preparing statement\");
		       </script>";
		die();
	}
	$stmt->bind_param("s", $username);
	if (!$stmt->execute()){
		print "<script type=\"text/javascript\">
		         alert(\"Error executing statement\");
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

	if( !$stmt->prepare("INSERT INTO `jokers` (jokerName, jokerHash, numJokes) VALUES (?, ?, 0)") ) {
	    print "<script type=\"text/javascript\">
	             alert(\"Error preparing statment\");
	           </script>";
	    die();
	}

	$hash = md5($password);
	$stmt->bind_param("ss", $username, $hash);
	if (!$stmt->execute()){
		print "<script type=\"text/javascript\">
		         alert(\"Error executing statement\");
		       </script>";
		die();
	}

	print "<script type=\"text/javascript\">
	         alert(\"User Created!\");
           window.location.replace(\"login.php\");
	       </script>";
?>

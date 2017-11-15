<?php
	session_start();

	if ($_SESSION['logged']) {
		$_SESSION['ERROR'] = "You must be logged out to create and account!";
		header("Location: /Main/main.php");
		die();
	}

	if( isset($_SESSION['ERROR']) ) {
		echo "<div id='error'><b>" . $_SESSION['ERROR'] . "</b></div>";
    unset($_SESSION['ERROR']);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="/style/styling.css" />
	<title>CTF Main Page</title>
</head>
<body>

	<br />
	<br />
	<br />

	<!-- Sign up -->
	<div id="main">
		<h2>Create an Account</h2>
		<form action="" method="POST">
			<span></span>
				<input type="text" name="username" placeholder="Username" />
			<span></span>
				<input type="password" name="password" placeholder="Password" />
			<span></span>
				<input type="password" name="passCheck" placeholder="Retype Password" />
			
			<input name="signup" type="submit" value="Sign Up" />
		</form>
		<a href="authenticate.php"><- Back to Login</a>
	</div>

</body>
</html>


<?php
	if ( !isset($_POST['signup']) ) {
		die();
	}

	$username = (array_key_exists('username', $_POST) && is_string($_POST['username']))
											? $_POST['username'] : '';
	$password = (array_key_exists('password', $_POST) && is_string($_POST['password']))
											? $_POST['password'] : '';
	$passCheck = (array_key_exists('passCheck', $_POST) && is_string($_POST['passCheck']))
											? $_POST['passCheck'] : '';

	if ( empty($username) || empty($password) || empty($passCheck) ) {
		$_SESSION['ERROR'] = "You must completely fill out the form!";
		header("Location: /Main/createAccount.php");
		die();
	}
	if ( !($password === $passCheck) ) {
		$_SESSION['ERROR'] = "Password fields must match!";
		header("Location: /Main/createAccount.php");
		die();
	}

	include "../mysql.php";

	$stmt = $conn->stmt_init();
	if( !$stmt->prepare("INSERT INTO `users` (username, passHash, start) VALUES (?, ?, now())") ) {
		$_SESSION['ERROR'] = "Problem preparing SQL statement";
		header("Location: /Main/createAccount.php");
		die();
	}

	$ph = password_hash($password, PASSWORD_BCRYPT);
	$stmt->bind_param("ss", $username, $ph);
	$stmt->execute();

	//session_regenerate_id();
	$_SESSION['logged'] = 1;
	$_SESSION['username'] = $username, ENT_QUOTES, 'UTF-8';

	header("Location: /Main/main.php");
	exit();
?>
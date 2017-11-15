<?php
	session_start();

	if($_SESSION['logged']) {
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

	<!-- Official Login -->
	<div id="main">
		<h2>Sign In</h2>
		<form action="" method="POST">
			<span></span>
				<input type="text" name="username" placeholder="Username" />
		 
			<span></span>
				<input type="password" name="password" placeholder="Password" />
			
			<input name="login" type="submit" value="Login" />
			<a href="createAccount.php">Create Account</a>
		</form>
	</div>

</body>
</html>

<?php
	if ( !isset($_POST['login']) ) {
		die();
	}

	$username = (array_key_exists('username', $_POST) && is_string($_POST['username']))
									? $_POST['username'] : '';
	$password = (array_key_exists('password', $_POST) && is_string($_POST['password']))
									? $_POST['password'] : '';

	if (empty($username) || empty($password)) {
		$_SESSION['ERROR'] = "You didn't fill out the form!";
		header("Location: /Main/authenticate.php");
		die();
	}

	include "../mysql.php";

	//prepare and bind
	$stmt = $conn->stmt_init();
	if( !$stmt->prepare("SELECT `passHash` FROM `users` WHERE `username` = ?") ) {
		$_SESSION['ERROR'] = "Error preparing SQL statement";
		header("Location: /Main/authenticate.php");
		die();
	}
	$stmt->bind_param("s", $username);

	//set variables and execute
	if (!$stmt->execute()){
		$_SESSION['ERROR'] = "Error executing SQL statement";
		header("Location: /Main/authenticate.php");
		die();
	}
	//$stmt->execute();
	$stmt->store_result();

	$stmt->bind_result($passHash);
	$stmt->fetch();

	if ( !$stmt->num_rows ) {
		$_SESSION['ERROR'] = "Incorrect Username or Password!";
		header("Location: /Main/authenticate.php");
		die();
	} 
	if ( !password_verify($password, $passHash) ) {
		$_SESSION['ERROR'] = "Incorrect Username or Password!";
		header("Location: /Main/authenticate.php");
		die();
	}

	//Set user state to logged in
	//session_regenerate_id();
	$_SESSION['logged'] = 1;
	$_SESSION['username'] = $username;
	header("Location: /Main/main.php");
	exit();
?>

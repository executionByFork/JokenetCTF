<?php
	session_start();

	if($_SESSION['logged']) {
		header("Location: /Main/main.php");
		die();
	}

	debug_to_console("ERROR MSG: " . $_SESSION['ERROR']);
	if( isset($_SESSION['ERROR']) ) {
		echo "<b>" . $_SESSION['ERROR'] . "</b>";
    unset($_SESSION['ERROR']);
	}

	function debug_to_console( $data ) {
		$output = $data;
		if ( is_array( $output ) )
			$output = implode( ',', $output);

		echo '<script>console.log("' . $output . '");</script>';
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

	include "/mysql.php";

	//prepare and bind
	$stmt = $conn->stmt_init();
	$x = $stmt->prepare("SELECT `username`, `passHash` FROM `pentest_users`
											 WHERE `username` = ?");
	if( !$x ) {
		$_SESSION['ERROR'] = "Error preparing SQL statement";
		header("Location: /Main/authenticate.php");
		die();
	}
	$stmt->bind_param("s", $form_username);

	//set variables and execute
	$form_username = stripslashes($username);
	$raw_password = stripslashes($password);
	$stmt->execute();
	$stmt->store_result();

	$stmt->bind_result($u, $passHash);
	$stmt->fetch();

	if ( !($stmt->num_rows) ) {
		$_SESSION['ERROR'] = "Incorrect Username or Password!";
		header("Location: /Main/authenticate.php");
		die();
	} elseif ( !(password_verify($raw_password, $passHash)) ) {
		$_SESSION['ERROR'] = "Incorrect Username or Password!";
		header("Location: /Main/authenticate.php");
		die();
	}

	//Set user state to logged in
	session_regenerate_id();
	$_SESSION['logged'] = 1;
	$_SESSION['username'] = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
	header("Location: /Main/main.php");
?>

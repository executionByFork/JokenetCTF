<?php
	session_start();

	if ($_SESSION['logged'])
		header("Location: /Main/main.php");
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
	debug_to_console("hello");
	if ( !isset($_POST['login']) ) {
		die();
	}
	debug_to_console("hello");

	$username = (array_key_exists('username', $_POST) && is_string($_POST['username']))
									? $_POST['username'] : '';
	$password = (array_key_exists('password', $_POST) && is_string($_POST['password']))
									? $_POST['password'] : '';

	if (empty($username) || empty($password)) {
			print "<script type=\"text/javascript\">
							 alert(\"You didn't fill out the form!\");
						 </script>";
			die();
	}

	include "/mysql.php";

	//prepare and bind
	$stmt = $conn->stmt_init();
	$x = $stmt->prepare("SELECT `username`, `passHash` FROM `pentest_users`
											 WHERE `username` = ?");
	if( !$x ) {
		print "<script type=\"text/javascript\">
						 alert(\"Error preparing statment\");
					 </script>";
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

	if (!$stmt->num_rows) {
		print "<script type=\"text/javascript\">
						 alert(\"Incorrect Username or Password!\");
					 </script>";
		die();
	} else {
		$options = [ 'cost' => 12 ];
		$ph = password_hash($raw_password, PASSWORD_BCRYPT, $options);

	debug_to_console($username);
	debug_to_console($ph);
		if ( !($passHash === $ph) ) {
			print "<script type=\"text/javascript\">
							 alert(\"Incorrect Username or Password!\");
						 </script>";
			die();
		}
	}

	//Set user state to logged in
	session_regenerate_id();
	$_SESSION['logged'] = 1;
	$_SESSION['username'] = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
	//header("Location: /Main/main.php");
	exit();


	function debug_to_console( $data ) {
		$output = $data;
		if ( is_array( $output ) )
			$output = implode( ',', $output);

		echo '<script>console.log("' . $output . '");</script>';
	}
?>

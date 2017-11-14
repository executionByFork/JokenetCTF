<?php
	session_start();
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
				<input type="text" id="user" placeholder="Username" />
		 
			<span></span>
				<input type="password" id="pass" placeholder="Password" />
			
			<input name="login" type="submit" value="Sign Up" />
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
			print "<script type=\"text/javascript\">
							 alert(\"You didn't fill out the form!\");
						 </script>";
			die();
	}

	include "/mysql.php";

	//prepare and bind
	$stmt = $conn->stmt_init();
	if( !$stmt->prepare("SELECT `username`, `passHash` FROM `pentest_users` WHERE `username` = ?") ) {
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
	header("Location: /Main/main.php");
	exit();
?>

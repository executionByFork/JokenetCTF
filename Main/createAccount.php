<?php
	session_start();

	if ($_SESSION['logged']) {
		print "<script type=\"text/javascript\">
						 alert(\"You must be logged out to create and account!\");
						 window.location.replace(\"/Main/main.php\");
					 </script>";
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
	</div>

</body>
</html>


<?php
	if ( !isset($_POST['signup']) ) {
		die();
	}

	$username = (array_key_exists('username', $_POST) && is_string($_POST['username']))
											? stripslashes($_POST['username']) : '';
	$password = (array_key_exists('password', $_POST) && is_string($_POST['password']))
											? stripslashes($_POST['password']) : '';
	$passCheck = (array_key_exists('passCheck', $_POST) && is_string($_POST['passCheck']))
											? stripslashes($_POST['passCheck']) : '';

	if ( empty($username) || empty($password) || empty($passCheck) ) {
		print "<script type=\"text/javascript\">
						 alert(\"You must completely fill out the form!\");
					 </script>";
		die();
	}
	if ( !($password === $passCheck) ) {
		print "<script type=\"text/javascript\">
						 alert(\"Error: Password feilds must match\");
					 </script>";
		die();
	}

	include "../mysql.php";

	$stmt = $conn->stmt_init();
	$x = $stmt->prepare("INSERT INTO `pentest_users` (username, passHash, start)
											 VALUES (?, ?, now())");
		if( !$x ) {
				print "<script type=\"text/javascript\">
								 alert(\"Error preparing statment\");
							 </script>";
				die();
		}

		$options = [ 'cost' => 12 ];
		$ph = password_hash($password, PASSWORD_BCRYPT, $options);

		$stmt->bind_param("ss", $username, $ph);
		$stmt->execute();

		session_regenerate_id();
		$_SESSION['logged'] = 1;
		$_SESSION['username'] = $username;

		print "<script type=\"text/javascript\">
						 alert(\"User Created!\");
						 window.location.replace(\"/Main/main.php\");
					 </script>";



	function debug_to_console( $data ) {
		$output = $data;
		if ( is_array( $output ) )
			$output = implode( ',', $output);

		echo '<script>console.log("' . $output . '");</script>';
	}


?>
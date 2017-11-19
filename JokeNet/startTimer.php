<?php

	if(!defined('AUTH')) {
    header("Location: /JokeNet/index.php");
		die();
	}

	$stmt = $conn->stmt_init();
	if( !$stmt->prepare("SELECT `start` FROM `users` WHERE `username` = ?") ) {
		$_SESSION['error'] = 1;
		$_SESSION['msg'] = "Problem preparing SQL statement";
		header("Location: /Main/main.php");
		die();
	}
	$stmt->bind_param("s", $_SESSION['username']);
	if (!$stmt->execute()) {
		$_SESSION['error'] = 1;
		$_SESSION['msg'] = "Error executing SQL statement";
		header("Location: /Main/main.php");
		die();
	}
	$stmt->store_result();
	if ( !$stmt->num_rows ) {
		$_SESSION['error'] = 1;
		$_SESSION['msg'] = "Error, user doesn't exist";
		header("Location: /Main/logout.php");
		die();
	}

	$stmt->bind_result($start);
	$stmt->fetch();
	if ($start) {
		die();
	}

	if( !$stmt->prepare("UPDATE `users` SET `start` = now() WHERE username = ?") ) {
		$_SESSION['error'] = 1;
		$_SESSION['msg'] = "Problem preparing SQL statement";
		header("Location: /Main/main.php");
		die();
	}
	$stmt->bind_param("s", $_SESSION['username']);
	if (!$stmt->execute()) {
		$_SESSION['error'] = 1;
		$_SESSION['msg'] = "Error executing SQL statement";
		header("Location: /Main/main.php");
		die();
	}

?>
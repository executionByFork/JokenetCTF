<?php

	//check for CTF login
	session_start();
	if (!$_SESSION['logged']) {
		$_SESSION['error'] = 1;
		$_SESSION['msg'] = "You must be logged in to visit that page!";
		header("Location: /Main/authenticate.php");
		die();
	}

	if ($_SERVER['HTTP_REFERER'] != "http://www.example.com/") {
		print "ERROR: Only users visiting from 'http://www.example.com/' can view this document!";
		die();
	}

	print "
		Greetings, example.com visitor / referral spoofer! <br />
		FLAG-QLXIS7SK30SM1M9BIFH93HE82
	";

?>
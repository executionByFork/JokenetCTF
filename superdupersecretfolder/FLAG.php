<?php

	//check for CTF login
	session_start();
	if (!$_SESSION['logged']) {
		$_SESSION['error'] = 1;
		$_SESSION['msg'] = "You must be logged in to visit that page!";
		header("Location: /Main/authenticate.php");
		die();
	}

	print "FLAG-AS01KW3M926SLVCP01D8S4HGZ";

?>



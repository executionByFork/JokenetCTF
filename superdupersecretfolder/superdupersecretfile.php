<?php

	if ($_SERVER['HTTP_REFERER'] != "http://www.example.com/") {
		print "ERROR: Only users visiting from 'http://www.example.com/' can view this document!";
		die();
	}

	print "
		Greetings, example.com visitor / referral spoofer! <br />
		FLAG-QLXIS7SK30SM1M9BIFH93HE82
	";

?>
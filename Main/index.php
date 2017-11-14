<?php
	# Use SESSION
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
		<form action="">
			<span></span>
				<input type="text" id="user" placeholder="Username" />
		 
			<span></span>
				<input type="password" id="pass" placeholder="Password" />
			
			<input name="login" type="submit" value="Login" />
			<a href="#createAccount">Create Account</a>
		</form>
	</div>

	<!-- Flag Submission -->
	<div id="main">
		<h2>Flag Submission</h2>
		<form action="">
			<span></span>
				<input type="text" id="flag" placeholder="Flag Code" />
			<input name="flag" type="submit" value="Submit" />
			<a href="#hints">Need Hints?</a>
		</form>
	</div>

	<!-- Leaderboards -->
	<div id="main">
		<h2>View Leaderboards</h2>
		<form action="">
			<span></span>
				<input type="text" id="flag" placeholder="Search by User" />
			<input name="search" type="submit" value="Search" />
			<input name="top" type="submit" value="View Top 10" />
		</form>
	</div>

</body>
</html>

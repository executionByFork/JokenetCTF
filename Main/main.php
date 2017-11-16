<?php
	session_start();

	if (!$_SESSION['logged']) {
		$_SESSION['error'] = 1;
		$_SESSION['msg'] = "You must be logged in to visit that page!";
		header("Location: /Main/authenticate.php");
		die();
	}

	include "../functions.php";
	checkForBanner();
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="/style/styling.css" />
	<title>CTF Main Page</title>
</head>
<body>
	<div id="logoutWrapper">
		<a href="/Main/logout.php"><button id="logout"><b>Logout</b></button></a>
	</div>
	<br />
	<br />
	<br />
	<center>
		<?php
			print "<h1 id='lg'><b>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</b></h1>";
			if(substr($_SESSION['username'], 0, 7) === "<script") {
				print "<i>nice try :)</i>";
			}
		?>
	</center>
	<br />

	<!-- Link to JokeNet -->
	<div id="main">
		<h2>Start Hunting</h2>
		<form action="startChallenge.php" method="POST">
			<input name="rules" type="submit" value="RULES" />
			<input name="jokenetBtn" type="submit" value="Go To JokeNet" />
		</form>
	</div>

	<!-- Flag Submission -->
	<div id="main">
		<h2>Flag Submission</h2>
		<form action="submitFlag.php" method="POST">
			<span></span>
				<input type="text" id="flag" placeholder="Flag Code" />
			<input name="flag" type="submit" value="Submit" />
			<a href="hints.php">Need Hints?</a>
		</form>
	</div>

	<!-- Leaderboards -->
	<div id="main">
		<h2>View Leaderboards</h2>
		<form action="leaderboards.php" method="POST">
			<span></span>
				<input name="searchKey" type="text" placeholder="Search by User" />
			<input name="search" type="submit" value="Search" />
			<input name="top" type="submit" value="View Top 10" />
		</form>
	</div>

</body>
</html>

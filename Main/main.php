<?php
	session_start();

	if (!$_SESSION['logged']) {
		header("Location: /Main/authenticate.php");
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
	
	<center>
		<?php
			print "Welcome, " . $_SESSION['username'] . "!"
		?>
	</center>
	<br />
	<br />
	<br />

	<!-- Link to JokeNet -->
	<div id="main">
		<h2>Start Hunting</h2>
		<form action="gotoJokeNet.php">
			<input name="jokenetBtn" type="submit" value="Go To JokeNet" />
		</form>
	</div>

	<!-- Flag Submission -->
	<div id="main">
		<h2>Flag Submission</h2>
		<form action="submitFlag.php">
			<span></span>
				<input type="text" id="flag" placeholder="Flag Code" />
			<input name="flag" type="submit" value="Submit" />
			<a href="hints.php">Need Hints?</a>
		</form>
	</div>

	<!-- Leaderboards -->
	<div id="main">
		<h2>View Leaderboards</h2>
		<form action="leaderboards.php">
			<span></span>
				<input type="text" id="flag" placeholder="Search by User" />
			<input name="search" type="submit" value="Search" />
			<input name="top" type="submit" value="View Top 10" />
		</form>
	</div>

</body>
</html>

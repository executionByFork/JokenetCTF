<?php
	session_start();

	if (!$_SESSION['logged']) {
		$_SESSION['ERROR'] = "You must be logged to visit that page!";
		header("Location: /Main/authenticate.php");
		die();
	}

	if( isset($_SESSION['ERROR']) ) {
		echo "<div id='error'><b>" . $_SESSION['ERROR'] . "</b></div>";
    unset($_SESSION['ERROR']);
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
	
	<div>
		<h3 id="logout"><a href="/Main/logout.php">Logout</a></h3>
	</div>
	<br />
	<center><h1><b>
		<?php
			print "Welcome, " . htmlspecialchars($_SESSION['username']) . "!"
		?>
	</b></h1></center>
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

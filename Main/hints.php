<?php
	session_start();

	if (!$_SESSION['logged']) {
		$_SESSION['ERROR'] = "You must be logged in to visit that page!";
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
	<title>CTF Hints</title>
</head>
<body>

	<div id="logoutWrapper">
		<a href="/Main/logout.php"><button id="logout"><b>Logout</b></button></a>
	</div>
	<div id="homeWrapper">
		<a href="/Main/main.php"><button id="home"><b>Home</b></button></a>
	</div>
	<br />
	<br />
	<br />
	<center>
		<h1 id='lg'><b>Hints</b></h1>
	<br />
	</center>

	<div id="main">
		<form action="startChallenge.php" method="POST">
			<h2>Clue 1:</h2>
			<h3><i>Clue 1 here</i></h3>
			<input name="Hint1" type="submit" value="Unlock Hint 1" />
			<?php
				print "<i>Here is the Hint text</i>"
			?>
			<hr />
			<br />
			<h2>Clue 2:</h2>
			<h3><i>Clue 2 here</i></h3>
			<input name="Hint2" type="submit" value="Unlock Hint 2" />
			<?php
				print "<i>Here is the Hint text</i>"
			?>
			<hr />
			<br />
			<h2>Clue 3:</h2>
			<h3><i>Clue 3 here</i></h3>
			<input name="Hint3" type="submit" value="Unlock Hint 3" />
			<?php
				print "<i>Here is the Hint text</i>"
			?>
			<hr />
			<br />
			<h2>Clue 4:</h2>
			<h3><i>Clue 4 here</i></h3>
			<input name="Hint4" type="submit" value="Unlock Hint 4" />
			<?php
				print "<i>Here is the Hint text</i>"
			?>
			<hr />
			<br />
			<h2>Clue 5:</h2>
			<h3><i>Clue 5 here</i></h3>
			<input name="Hint5" type="submit" value="Unlock Hint 5" />
			<?php
				print "<i>Here is the Hint text</i>"
			?>
			<hr />
			<br />
			<h2>Clue 6:</h2>
			<h3><i>Clue 6 here</i></h3>
			<input name="Hint6" type="submit" value="Unlock Hint 6" />
			<?php
				print "<i>Here is the Hint text</i>"
			?>
			<hr />
			<br />
			<h2>Clue 7:</h2>
			<h3><i>Clue 7 here</i></h3>
			<input name="Hint7" type="submit" value="Unlock Hint 7" />
			<?php
				print "<i>Here is the Hint text</i>"
			?>
			<hr />
			<br />
			<h2>Clue 8:</h2>
			<h3><i>Clue 8 here</i></h3>
			<input name="Hint8" type="submit" value="Unlock Hint 8" />
			<?php
				print "<i>Here is the Hint text</i>"
			?>
			<hr />
			<br />
			<h2>Clue 9:</h2>
			<h3><i>Clue 9 here</i></h3>
			<input name="Hint9" type="submit" value="Unlock Hint 9" />
			<?php
				print "<i>Here is the Hint text</i>"
			?>
			<hr />
		</form>
	</div>

</body>
</html>

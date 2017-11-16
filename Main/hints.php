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

	include "../mysql.php";

	$stmt = $conn->stmt_init();
	$query = "SELECT `flag1`, `flag2`, `flag3`, `flag4`,
									 `flag5`, `flag6`, `flag7`, `flag8`, `flag9`,
									 `hint1`, `hint2`, `hint3`, `hint4`,
									 `hint5`, `hint6`, `hint7`, `hint8`, `hint9` 
						FROM `users` WHERE `username` = ?";

	if( !$stmt->prepare($query) ) {
		$_SESSION['ERROR'] = "Problem preparing SQL statement";
		header("Location: /Main/hints.php");
		die();
	}
	$stmt->bind_param("s", $_SESSION['username']);
	if (!$stmt->execute()){
		$_SESSION['ERROR'] = "Error executing SQL statement";
		header("Location: /Main/hints.php");
		die();
	}
	$stmt->store_result();
	if ( !$stmt->num_rows ) {
		$_SESSION['ERROR'] = "Fatal Error when retrieving user data from database";
		header("Location: /Main/hints.php");
		die();
	}

	$stmt->bind_result($f1, $f2, $f3, $f4, $f5, $f6, $f7, $f8, $f9, 
										 $h1, $h2, $h3, $h4, $h5, $h6, $h7, $h8, $h9);

	if($_POST['Hint1']) $h1 = 1;
	if($_POST['Hint2']) $h2 = 1;
	if($_POST['Hint3']) $h3 = 1;
	if($_POST['Hint4']) $h4 = 1;
	if($_POST['Hint5']) $h5 = 1;
	if($_POST['Hint6']) $h6 = 1;
	if($_POST['Hint7']) $h7 = 1;
	if($_POST['Hint8']) $h8 = 1;
	if($_POST['Hint9']) $h9 = 1;

	$query = "UPDATE `users`
						SET `hint1` = ?, `hint2` = ?, `hint3` = ?, `hint4` = ?,
								`hint5` = ?, `hint6` = ?, `hint7` = ?, `hint8` = ?, `hint9` = ? 
						WHERE `username` = ?";

	if( !$stmt->prepare($query) ) {
		$_SESSION['ERROR'] = "Problem preparing SQL statement";
		header("Location: /Main/hints.php");
		die();
	}
	$stmt->bind_param("iiiiiiiiis", $h1, $h2, $h3, $h4, $h5, $h6, $h7, $h8, $h9, $_SESSION['username']);
	if (!$stmt->execute()){
		$_SESSION['ERROR'] = "Error executing SQL statement";
		header("Location: /Main/hints.php");
		die();
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
		<form action="hints.php" method="POST">
			<h2>Clue 1:</h2>
			<h3><i>Clue 1 here</i></h3>
			<input name="Hint1" type="submit" value="Unlock Hint 1" />
			<?php
				if($f1 || $h1) print "<i>Here is the Hint text</i>";
			?>
			<hr />
			<br />
			<h2>Clue 2:</h2>
			<h3><i>Clue 2 here</i></h3>
			<input name="Hint2" type="submit" value="Unlock Hint 2" />
			<?php
				if($f2 || $h2) print "<i>Here is the Hint text</i>";
			?>
			<hr />
			<br />
			<h2>Clue 3:</h2>
			<h3><i>Clue 3 here</i></h3>
			<input name="Hint3" type="submit" value="Unlock Hint 3" />
			<?php
				if($f3 || $h3) print "<i>Here is the Hint text</i>";
			?>
			<hr />
			<br />
			<h2>Clue 4:</h2>
			<h3><i>Clue 4 here</i></h3>
			<input name="Hint4" type="submit" value="Unlock Hint 4" />
			<?php
				if($f4 || $h4) print "<i>Here is the Hint text</i>";
			?>
			<hr />
			<br />
			<h2>Clue 5:</h2>
			<h3><i>Clue 5 here</i></h3>
			<input name="Hint5" type="submit" value="Unlock Hint 5" />
			<?php
				if($f5 || $h5) print "<i>Here is the Hint text</i>";
			?>
			<hr />
			<br />
			<h2>Clue 6:</h2>
			<h3><i>Clue 6 here</i></h3>
			<input name="Hint6" type="submit" value="Unlock Hint 6" />
			<?php
				if($f6 || $h6) print "<i>Here is the Hint text</i>";
			?>
			<hr />
			<br />
			<h2>Clue 7:</h2>
			<h3><i>Clue 7 here</i></h3>
			<input name="Hint7" type="submit" value="Unlock Hint 7" />
			<?php
				if($f7 || $h7) print "<i>Here is the Hint text</i>";
			?>
			<hr />
			<br />
			<h2>Clue 8:</h2>
			<h3><i>Clue 8 here</i></h3>
			<input name="Hint8" type="submit" value="Unlock Hint 8" />
			<?php
				if($f8 || $h8) print "<i>Here is the Hint text</i>";
			?>
			<hr />
			<br />
			<h2>Clue 9:</h2>
			<h3><i>Clue 9 here</i></h3>
			<input name="Hint9" type="submit" value="Unlock Hint 9" />
			<?php
				if($f9 || $h9) print "<i>Here is the Hint text</i>";
			?>
			<hr />
		</form>
	</div>

</body>
</html>

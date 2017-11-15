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
		die();
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="/style/styling.css" />
	<link rel="stylesheet" type="text/css" href="/style/leaderboard.css" />
	<title>CTF Main Page</title>
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

	<?php
		include "../mysql.php";

		//prepare and bind
		$stmt = $conn->stmt_init();
		if( !$stmt->prepare("SELECT `username`,
																(
																	((flag1 + flag2 + flag3 + flag4 +
																		flag5 + flag6 + flag7 + flag8 + flag9)*10) +
																	((hint1 + hint2 + hint3 + hint4 +
																		hint5 + hint6 + hint7 + hint8 + hint9)*-5)
																) AS `points`
												 FROM `users`") ) {
				$_SESSION['ERROR'] = "Error preparing SQL statement";
				header("Location: /Main/leaderboards.php");
				die();
		}

		if (!$stmt->execute()){
			$_SESSION['ERROR'] = "Error executing SQL statement";
			header("Location: /Main/leaderboards.php");
			die();
		}
		$result = $stmt->get_result();
		printTop10($result);
	?>

</body>
</html>

<?php
	function printTop10( $result ) {
		echo "<center>";
		echo "<table class='container'>";
		echo "<th>Username</th>
					<th>Points</th>
					<th>TimeSpent</th>";
		while($row = $result->fetch_array(MYSQLI_NUM)) {
			echo "<tr>";
			foreach($row as $data) {
				echo "<td>" . htmlspecialchars($data) . "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
		echo "</center>";
	}
?>
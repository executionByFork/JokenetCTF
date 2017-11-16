<?php
	session_start();

	if (!$_SESSION['logged']) {
		$_SESSION['ERROR'] = "You must be logged in to visit that page!";
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

		if(isset($_POST['top'])) {
			$query = "SELECT * FROM (
                  SELECT `username`,
                         (
                          ((flag1 + flag2 + flag3 + flag4 +
                            flag5 + flag6 + flag7 + flag8 + flag9)*10) +
                          ((hint1 + hint2 + hint3 + hint4 +
                            hint5 + hint6 + hint7 + hint8 + hint9)*-5)
                         ) AS `points`,
                         (
                          CASE
                            WHEN `start` AND `end`
                              THEN SEC_TO_TIME(TIMESTAMPDIFF(SECOND, `start`, `end`))
                            WHEN `start`
                              THEN CONCAT(
                                SEC_TO_TIME(TIMESTAMPDIFF(SECOND, `start`, CURRENT_TIMESTAMP())),
                                ' - In progress'
                              )
                            ELSE 'Not Started'
                          END
                         ) AS `time` FROM `users`
                ) x
                ORDER BY `points` DESC, `time` ASC LIMIT 10";
		} elseif($_POST['search']) {
			$query = "SELECT * FROM (
                  SELECT `username`,
                         (
                          ((flag1 + flag2 + flag3 + flag4 +
                            flag5 + flag6 + flag7 + flag8 + flag9)*10) +
                          ((hint1 + hint2 + hint3 + hint4 +
                            hint5 + hint6 + hint7 + hint8 + hint9)*-5)
                         ) AS `points`,
                         (
                          CASE
                            WHEN `start` AND `end`
                              THEN SEC_TO_TIME(TIMESTAMPDIFF(SECOND, `start`, `end`))
                            WHEN `start`
                              THEN CONCAT(
                                SEC_TO_TIME(TIMESTAMPDIFF(SECOND, `start`, CURRENT_TIMESTAMP())),
                                ' - In progress'
                              )
                            ELSE 'Not Started'
                          END
                         ) AS `time` FROM `users`
                ) x
                WHERE `username` LIKE ?
                ORDER BY LOCATE(?, `username`), `username` LIMIT 50";

        $searchKey = (array_key_exists('searchKey', $_POST) && is_string($_POST['searchKey']))
									? $_POST['searchKey'] : '';
				if (empty($searchKey)) {
					$_SESSION['ERROR'] = "Please specify a user to search for";
					header("Location: /Main/main.php");
					die();
				}
		} else {
			$_SESSION['ERROR'] = "You can't access that page like that!";
			header("Location: /Main/main.php");
			die();
		}

		if( !$stmt->prepare($query) ) {
				$_SESSION['ERROR'] = "Error preparing SQL statement";
				header("Location: /Main/leaderboards.php");
				die();
		}

		//if user is searching usernames
		//query needs to be bound to params
		if($_POST['search']) {
			$likeVar = "%" . $searchKey . "%";
			$stmt->bind_param("ss", $likeVar, $searchKey);
		}

		if (!$stmt->execute()){
			$_SESSION['ERROR'] = "Error executing SQL statement";
			header("Location: /Main/leaderboards.php");
			die();
		}
		$result = $stmt->get_result();
		printLeaderboard($result);
	?>

</body>
</html>

<?php
	function printLeaderboard( $result ) {
		echo "<center>";
		echo "<table class='container'>";
		echo "<th>Username</th>
					<th>Points</th>
					<th>Time Spent</th>";
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
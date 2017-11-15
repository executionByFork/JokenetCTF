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
		include "mysql.php";

		//prepare and bind
		$stmt = $conn->stmt_init();
		if( !$stmt->prepare("SELECT * FROM `users`") ) {
				$_SESSION['ERROR'] = "Error preparing SQL statement";
				header("Location: /Main/leaderboards.php");
				die();
		}
		//$stmt->bind_param("s", $searchkey);

		if (!$stmt->execute()){
			$_SESSION['ERROR'] = "Error executing SQL statement";
			header("Location: /Main/leaderboards.php");
			die();
		}
		$result = $stmt->get_result();
		printTable($result);
	?>

</body>
</html>

<?php
	function printTable( $result ) {
		echo "<br/> Rows found: " . $result->num_rows;
		echo "<table>";
		echo "<th>User ID</th><th>Username</th><th>Search Key</th>";
		while($row = $result->fetch_array(MYSQLI_NUM)) {
			echo "<tr>";
			foreach($row as $data) {
				echo "<td>" . $data . "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
?>
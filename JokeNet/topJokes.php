<?php 
	if (!$_COOKIE["logged"]) {
		header("Location: /login.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="/style/jokeStylez.css" />
	<link rel="stylesheet" href="/style/navbar.css" />
	<title>Top Jokes - JokeNet</title>
</head>
<body>

	<?php
		include "../mysql.php";
		$highlightButton = 1;
		include "navbar.php";
	?>
	<br />
	<br />

	<?php

		include "../functions.php";

		$stmt = $conn->stmt_init();
		if( !$stmt->prepare("SELECT * FROM `jokes` ORDER BY `rating` DESC LIMIT 15") ) {
	    print "<script type=\"text/javascript\">
	             alert(\"Error preparing statment\");
	           </script>";
	    die();
		}
		if (!$stmt->execute()){
			print "<script type=\"text/javascript\">
			         alert(\"Error executing statement\");
			       </script>";
			die();
		}
		$stmt->bind_result($jokeID, $jokeText, $postedBy, $rating, $numVotes, $timeStamp);
		while($stmt->fetch()) {
			printJoke($jokeID, $jokeText, $postedBy, $rating, $timeStamp);
		}

	?>

</body>
</html>

<?php

	//check for CTF login
  session_start();
  if (!$_SESSION['logged']) {
    $_SESSION['error'] = 1;
    $_SESSION['msg'] = "You must be logged in to visit that page!";
    header("Location: /Main/authenticate.php");
    die();
  }

	define("AUTH", 1);
	include "../mysql.php";
  include "startTimer.php";

  if (!$_COOKIE["logged"]) {
    header("Location: login.php");
    die();
  }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Search Users - JokeNet</title>
  <link rel="stylesheet" type="text/css" href="/style/jokeStylez.css" />
  <link rel="stylesheet" href="/style/navbar.css" />
</head>
<body>

  <?php
    $highlightButton = 5;
    include "navbar.php";
	?>
	<center>

		<form action="" method="POST">
		  <input type="text" name="searchkey">
		  <input type="submit" name="search" value="Search">
		</form>
		<br />
		<br />

		<?php

		if ( !isset($_POST['search']) ) {
			die();
		}

		$searchkey = (array_key_exists('searchkey', $_POST) && is_string($_POST['searchkey']))
		                ? $_POST['searchkey'] : '';
		if (empty($searchkey)) {
		print "<script type=\"text/javascript\">
           alert(\"You didn't search for anything!\");
         </script>";
    die();
		}

		$sql = "SELECT `jokerName` FROM `jokers` WHERE `jokerName` LIKE '%{$searchkey}%'"
		if( !($result = $conn->query($sql)) ) {
	    print "<script type=\"text/javascript\">
	             alert(\"There was an error in the SQL syntax\");
	           </script>";
	    die();
		}

		if (!$result->num_rows) {
	    print "<center><h1>No Users found</h1></center>";
      die();
		}
		while($row = $result->fetch_object()) {
			print '
				<b><a href="profile.php?user=' . $row['jokerName'] . '">' . $row['jokerName'] . '</a></b><br />
			';
		}

		?>
	</center>
</body>
</html>
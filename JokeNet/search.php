<?php

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
		<br />
		<br />

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

		include "../mysql.php";

		$stmt = $conn->stmt_init();
		if( !$stmt->prepare("SELECT `jokerName` FROM `jokers`
												 WHERE `jokerName` LIKE ?
												 ORDER BY LOCATE(?, `jokerName`), `jokerName`") ) {
	    print "<script type=\"text/javascript\">
	             alert(\"Error preparing statment\");
	           </script>";
	    die();
		}
		$likeVar = "%" . $searchkey . "%";
		$stmt->bind_param("s", $likeVar, $searchKey);

		if (!$stmt->execute()){
			print "<script type=\"text/javascript\">
			         alert(\"Error executing statement\");
			       </script>";
			die();
		}
		$stmt->store_result();

		if (!$stmt->num_rows) {
	    print "<center><h1>No Users found</h1></center>";
      die();
		}
		$stmt->bind_result($jokerName);

		while($stmt->fetch()) {
			print '
				<b><a href="profile.php?user=' . $jokerName . '">' . $jokerName . '</a></b><br />
			';
		}

		?>
	</center>
</body>
</html>
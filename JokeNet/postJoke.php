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
		$highlightButton = 3;
		include "navbar.php";
	?>
	<br />
	<br />
	
	<form action="" method="POST">
		<textarea name="jokeText"></textarea>
		<input type="submit" name="post" value="Post to JokeNet">
	</form>

</body>
</html>

<?php
	
?>

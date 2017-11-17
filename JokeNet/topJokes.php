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

		//nl2br()
	?>
	<br />
	<br />

	<?php

		include "../functions.php";



	?>
	<div class="jokePost">
		<b>Posted by: <a href="profile.php?user=James">James</a></b>
		<hr />
		<center><pre>
			This is my joke
			I hope you like it
			-- James
		</pre></center>
		<hr />
		<form action="vote.php" method="POST">
			<select>
			  <option value="0" selected>0</option>
			  <option value="1">1</option>
			  <option value="2">2</option>
			  <option value="3">3</option>
			  <option value="4">4</option>
			  <option value="5">5</option>
				<input type="submit" name="vote" value="Vote!">
				<input type="hidden" name="jokeNumber" value="jokeIDhere">
			</select>
		</form>
		<span>Current Rating: 5/5</span>
	</div>


</body>
</html>

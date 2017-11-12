<?php
	setcookie("logged", 0);
	setcookie("username", "");
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="style/style.css" />
	<link rel="stylesheet" href="style/navbar.css" />
	<title>Login</title>
</head>
<body>

	<nav id="nav">
		<ul class="links">
			<h2>JokeNet</h2>
			<li class="active">JokeNet</li>
			<li class="active"><a href="#">Top Jokes</a></li>
			<li><a href="#recent">Recent Jokes</a></li>
			<li><a href="#post">Post a Joke</a></li>
			<li><a href="#profile">Profile</a></li>
			<li><a href="#about">About</a></li>
		</ul>
	</nav>

	<br />
	<br />
	<br />
	<center><h3>Login</h3></center>
	<form action="authenticate.php" method="POST" class="login">
	  <input type="text" placeholder="Username" name="username">
	  <input type="password" placeholder="Password" name="password">
	  <input type="submit" value="Sign In">
	  <a href="createUser.php?r=login" class="forgot">Create Account</a>
	</form>

</body>
</html>

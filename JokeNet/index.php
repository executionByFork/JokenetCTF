<?php
	setcookie("logged", 0);
	setcookie("username", "");
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="/style/style.css" />
	<link rel="stylesheet" href="/style/navbar.css" />
	<title>Login</title>
</head>
<body>

<?php
echo '
	<nav id="nav">
		<ul class="links">
			<h2>JokeNet</h2>
			<li class="active"><a href="#top">Top Jokes</a></li>
			<li><a href="#recent">Recent Jokes</a></li>
			<li><a href="#post">Post a Joke</a></li>
			<li><a href="#profile">Profile</a></li>
			<li><a href="#about">About</a></li>
		</ul>
	</nav>
	';
	//include "/JokeNet/navbar.php";
?>

</body>
</html>

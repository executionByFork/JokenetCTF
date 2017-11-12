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
			<li class="active"><a href="index.html">This is Massively</a></li>
			<li><a href="generic.html">Generic Page</a></li>
			<li><a href="elements.html">Elements Reference</a></li>
		</ul>
		<ul class="icons">
			<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
			<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
			<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
			<li><a href="#" class="icon fa-github"><span class="label">GitHub</span></a></li>
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

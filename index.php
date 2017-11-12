<?php
	setcookie("logged", 0);
	setcookie("username", "");
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>Login</title>
</head>
<body>

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

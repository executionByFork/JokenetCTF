<?php
	# Use SESSION
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="/style/style.css" />
	<title>Login</title>
</head>
<body>

	<br />
	<br />
	<br />

	<!-- Official Login -->
	<h2>Sign In</h2>	
	<div id="login">
    <form name='form-login'>
      <span class="fontawesome-user"></span>
        <input type="text" id="user" placeholder="Username" />
     
      <span class="fontawesome-lock"></span>
        <input type="password" id"pass" placeholder="Password" />
      
      <input type="submit" value="Login" />
			<a href="#createAccount" class="forgot">Create Account</a>
    </form>
  </div>

	<!-- Flag Submission
	<div id="submit-flags">
		<h2>Sign In</h2>
    <form name='flag-form'>
      <span class="fontawesome-user"></span>
        <input type="text" id="flag" placeholder="Flag Code" />
      <input type="submit" value="Login" />
			<a href="#hints" class="forgot">Need Hints?</a>
    </form>
  </div>
  -->

	<!-- Flag Hints -->

</body>
</html>

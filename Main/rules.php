<?php
	session_start();

	if (!$_SESSION['logged']) {
		$_SESSION['error'] = 1;
		$_SESSION['msg'] = "You must be logged in to visit that page!";
		header("Location: /Main/authenticate.php");
		die();
	}

	include "../functions.php";
	checkForBanner();
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="/style/styling.css" />
	<title>CTF Rules</title>
</head>
<body>
	<div id="logoutWrapper">
		<a href="/Main/logout.php"><button id="logout"><b>Logout</b></button></a>
	</div>
	<div id="homeWrapper">
		<a href="/Main/main.php"><button id="home"><b>Home</b></button></a>
	</div>
	<br />
	<br />
	<br />
	<center>
		<div id="rules">
			<h1 id='lg'><b>&lt; RULES and INFO &gt;</b></h1>
		<br />
			Welcome to the JokeNet CTF Challenge! <br />
			So, you've created a CTF account, what now? <br />
			You need to find flags! <br />
			<br />
			Currently, you are in the CTF portion of the site. This serves as the main hub for this challenge, and the home page is where you'll go to submit the flag codes you find, view the leaderboards, and unlock hints. <br />
			<br />
			The mock site I've created for you guys to hack is located in the JokeNet/ folder. <br />
			The site looks bad, because it's security is a joke (<i>puns!</i>) <br />
			<br />
			There are many security holes for you exploit, and under each of them lies a flag. Manipulate, inject, cheat, and break the site in any way you can to find them. Flag difficulty varies from easy to hard, so hopefully this CTF challenge will teach everyone something new, and make you think in ways you hadn't. <br />
			<br />
			The rules are simple, hack this site in any way you can imagine to retirieve hidden flags <br />
			A flag code will look something like this: <b>FLAG-XXXXXXXXXXXXXXXXXXXXXXXX</b> <br />
			Flags can be found in any order, though sometimes you may need to 'chain vulnerabilities', and by this I mean certain flags are only accessable by using another flag's vulnerability. <br />
			If you find one of these flag codes, submit the code on the home page for points! <br />
			<br />
			<h3>The Point System</h3>
			Every flag you find is worth 10 points. <br />
			If you are having trouble finding flags, visiting the hints page may help you. On this page, each flag has a clue and a hint. The clues are free, but quite vague, they are aimed to point your focus in a general direction. Hints, however, are much more specific, and so they come with a <b>cost</b>. If you unlock a hint for a flag, you can only earn half the points for submitting that flag, which means 10 points becomes 5. Also, once you submit a flag, the hint for it is revealed for those of you that are curious, and the button to buy that hint will no longer work. <br />
			<br />
			One last thing to note is that there is also a timer associated with your CTF account. The moment you visit any page on JokeNet it will start, and won't stop until all flags have been found. Dont worry about this too much though, this only serves as a secondary scoring system to the point total. It's much more worthwhile to take the extra time to find the flags without hints than to rush through this challenge. <br />
			<br />
			<b><h3>P.S.</h3></b> <br />
			Please dont abuse the system and create multiple CTF accounts. Tracking users is not an easy task and there are always ways around it, so we're using the honor system here. Also, please do not post anything derogatory or offensive on JokeNet. Let's try to be adults. <br />
	    <br />
			That's about it. Thanks for reading and get hunting! <br />
	    <br />
	    <br />
	    <br />
	    <br />
	    <br />
	    <br />
		</div>
	</center>
</body>
</html>

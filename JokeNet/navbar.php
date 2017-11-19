<?php

switch ($highlightButton) {
	case 1:
		$top = ' class="active" ';
		break;
	case 2:
		$recent = ' class="active" ';
		break;
	case 3:
		$post = ' class="active" ';
		break;
	case 4:
		$profile = ' class="active" ';
		break;
	case 5:
		$search = ' class="active" ';
		break;
	case 6:
		$about = ' class="active" ';
		break;
	default:
    header("Location: /JokeNet/index.php");
		die();
}

echo '
	<nav id="nav">
		<ul class="links">
			<h2>JokeNet</h2>
			<li'. $top . '><a href="topJokes.php">Top Jokes</a></li>
			<li'. $recent . '><a href="recentJokes.php">Recent Jokes</a></li>
			<li'. $post . '><a href="postJoke.php">Post a Joke</a></li>
			<li'. $profile . '><a href="profile.php">Profile</a></li>
			<li'. $search . '><a href="search.php">Search</a></li>
			<li'. $about . '><a href="about.php">About</a></li>
		</ul>
		<div id="topRight">
			<a href="/JokeNet/logout.php"><button id="logout"><b>Logout</b></button></a>
		</div>
	</nav>
';

?>

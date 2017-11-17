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
		$about = ' class="active" ';
		break;
}

echo '
	<nav id="nav">
		<ul class="links">
			<h2>JokeNet</h2>
			<li'. $top . '><a href="#top">Top Jokes</a></li>
			<li'. $recent . '><a href="#recent">Recent Jokes</a></li>
			<li'. $post . '><a href="#post">Post a Joke</a></li>
			<li'. $profile . '><a href="#profile">Profile</a></li>
			<li'. $about . '><a href="#about">About</a></li>
		</ul>
		<div id="topRight">
			<a href="/JokeNet/logout.php"><button id="logout"><b>Logout</b></button></a>
		</div>
	</nav>
';

?>

<?php

switch ($highlightButton) {
	case 1:
		$top = "active";
		break;
	case 2:
		$recent = "active";
		break;
	case 3:
		$post = "active";
		break;
	case 4:
		$profile = "active";
		break;
	case 5:
		$about = "active";
		break;
}

echo '
	<nav id="nav">
		<ul class="links">
			<h2>JokeNet</h2>
			<li class="$top"><a href="#top">Top Jokes</a></li>
			<li class="$recent"><a href="#recent">Recent Jokes</a></li>
			<li class="$post"><a href="#post">Post a Joke</a></li>
			<li class="$profile"><a href="#profile">Profile</a></li>
			<li class="$about"><a href="#about">About</a></li>
		</ul>
		<div id="topRight">
			<a href="/JokeNet/logout.php"><button id="logout"><b>Logout</b></button></a>
		</div>
	</nav>
';

?>

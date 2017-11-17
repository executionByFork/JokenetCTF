<?php

	function checkForBanner() {
		if( isset($_SESSION['notify']) ) {
			echo "<div id='notify'><b>" . $_SESSION['msg'] . "</b></div>";
			unset($_SESSION['notify']);
		} elseif( isset($_SESSION['error']) ) {
			echo "<div id='error'><b>" . $_SESSION['msg'] . "</b></div>";
			unset($_SESSION['error']);
		}
		unset($_SESSION['msg']);
	}

	function debug_to_console( $data ) {
		$output = $data;
		if ( is_array( $output ) )
			$output = implode( ',', $output);

		echo '<script>console.log("' . $output . '");</script>';
	}

	function printJoke( $jokeID, $jokeText, $postedBy, $rating, $timeStamp ) {
		echo '
			<div class="jokePost">
				<span id="pad">
					<b>Posted by: <a href="profile.php?user=' . $postedBy . '">' . $postedBy . '</a></b>
					<br />' . $timeStamp . '
				</span>
				<hr />s
				<center><pre>' . nl2br($jokeText) . '</pre></center>
				<hr />
				<form action="/JokeNet/vote.php" method="POST">
					<select>
					  <option value="0" selected>0</option>
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  <option value="4">4</option>
					  <option value="5">5</option>
					</select>
					<input type="submit" name="vote" value="Vote!">
					<input type="hidden" name="jokeNumber" value="' . $jokeID . '">
					<span id="rating">Current Rating: ' . $rating . '/5</span>
				</form>
			</div>
		';
	}

?>

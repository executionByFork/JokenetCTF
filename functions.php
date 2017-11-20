<?php

	function checkForLoginBypass() {
		if (!$_SESSION['JokeNetLogged']) {
			if ($_COOKIE["logged"]) {
				print "<center><h2>FLAG-A1WL9S73NSU8S0SNDI6SADAV3</h2></center>";
			} else {
				header("Location: logout.php");
				die();
			}
		}
	}

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
				<b>Posted by: <a href="profile.php?user=' . htmlspecialchars($postedBy) . '">' . htmlspecialchars($postedBy) . '</a></b>
				<br />' . htmlspecialchars($timeStamp) . '
				<hr />
				<center><pre>' . nl2br(htmlspecialchars($jokeText)) . '</pre></center>
				<hr />
				<form action="" method="POST">
					<select name="voteVal">
						<option value="0" selected>0</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
					<input type="submit" name="vote" value="Vote!">
					<input type="hidden" name="jokeNumber" value="' . $jokeID . '">
					<span id="rating">Current Rating: ' . htmlspecialchars($rating) . '/5</span>
				</form>
			</div>
		';
	}

?>

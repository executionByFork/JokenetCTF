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

?>
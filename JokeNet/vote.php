<?php

	if(!defined('AUTH')) {
    header("Location: /JokeNet/index.php");
		die();
	}
	
	if ( !isset($_POST['vote']) ) {
		die();
	}

	$voteVal = (array_key_exists('voteVal', $_POST) && is_numeric($_POST['voteVal']))
	                ? $_POST['voteVal'] : '';
	$jokeID = (array_key_exists('jokeNumber', $_POST) && is_numeric($_POST['jokeNumber']))
	                ? $_POST['jokeNumber'] : '';

	include "../mysql.php";

	$stmt = $conn->stmt_init();
	if( !$stmt->prepare("SELECT `rating`, `numVotes` FROM `jokes` WHERE `jokeID` = ?") ) {
    print "<script type=\"text/javascript\">
             alert(\"Error preparing statment\");
           </script>";
    die();
	}
	$stmt->bind_param("s", $jokeID);

	if (!$stmt->execute()){
		print "<script type=\"text/javascript\">
		         alert(\"Error executing statement\");
		       </script>";
		die();
	}
	$stmt->store_result();
	if ( !$stmt->num_rows ) {
		print "<script type=\"text/javascript\">
		         alert(\"Error: could not find joke in database\");
		       </script>";
		die();
	}

	$stmt->bind_result($rating, $numVotes);
	$stmt->fetch();

	$score = $rating * $numVotes;
	$score += $voteVal;
	$numVotes += 1;
	$rating = $score / $numVotes;

	if( !$stmt->prepare("UPDATE `jokes` SET `rating` = ?, `numVotes` = ? WHERE `jokeID` = ?") ) {
    print "<script type=\"text/javascript\">
             alert(\"Error preparing statment\");
           </script>";
    die();
	}
	$stmt->bind_param("dii", $rating, $numVotes, $jokeID);

	if (!$stmt->execute()){
		print "<script type=\"text/javascript\">
		         alert(\"Error executing statement\");
		       </script>";
		die();
	}

	header('Location: '.$_SERVER['REQUEST_URI']);

?>
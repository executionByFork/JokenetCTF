<?php
  
  //check for CTF login
  session_start();
  if (!$_SESSION['logged']) {
    $_SESSION['error'] = 1;
    $_SESSION['msg'] = "You must be logged in to visit that page!";
    header("Location: /Main/authenticate.php");
    die();
  }

  define("AUTH", 1);
  include "../mysql.php";
  include "startTimer.php";

  include "../functions.php";
  checkForLoginBypass();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile - JokeNet</title>
  <link rel="stylesheet" type="text/css" href="/style/profile.css" />
  <link rel="stylesheet" type="text/css" href="/style/jokeStylez.css" />
  <link rel="stylesheet" href="/style/navbar.css" />
  <noscript><meta http-equiv="refresh" content="0;url=JSdisabled.php"></noscript>
</head>
<body>
  <?php
    $highlightButton = 4;
    include "navbar.php";

    $user = (array_key_exists('user', $_GET) && is_string($_GET['user']))
                  ? $_GET['user'] : '';
    
    if (empty($user)) {
      if (empty($_COOKIE['username'])) {
        print "<center><h1>User profile not found</h1></center>";
        die();
      }
      header("Location: profile.php?user=" . $_COOKIE['username']);
      die();
    }

    //get user info
    $stmt = $conn->stmt_init();
    if( !$stmt->prepare("SELECT `jokerName`, `email` FROM `jokers` WHERE `jokerName` = ?") ) {
      print "<script type=\"text/javascript\">
               alert(\"Error preparing statment 1\");
             </script>";
      die();
    }
    $stmt->bind_param("s", $user);
    if (!$stmt->execute()) {
      print "<script type=\"text/javascript\">
               alert(\"Error executing statement\");
             </script>";
      die();
    }
    $stmt->bind_result($jokerName, $email);
    $stmt->store_result();
    if ( !$stmt->num_rows ) {
      print "<center><h1>User profile not found</h1></center>";
      die();
    }
    $stmt->fetch()

    //get jokes by user
    if( !$stmt->prepare("SELECT * FROM `jokes` WHERE `postedBy` = ? ORDER BY `timeStamp` DESC") ) {
      print "<script type=\"text/javascript\">
               alert(\"Error preparing statment 2\");
             </script>";
      die();
    }
    $stmt->bind_param("s", $user);
    if (!$stmt->execute()){
      print "<script type=\"text/javascript\">
               alert(\"Error executing statement\");
             </script>";
      die();
    }
    $stmt->bind_result($jokeID, $jokeText, $postedBy, $rating, $numVotes, $timeStamp);
    $stmt->store_result();
  ?>

  <div class="n-profile-bar">
    <div class="name">
      <h3><u><?php echo htmlspecialchars($jokerName); ?></u></h3>
    </div>
    <div class="n-contact">
      <ul>
        <li class="email"><b>Email: <?php echo htmlspecialchars($email); ?></b></li>
        <li class="num"><b><?php echo $stmt->num_rows; ?> jokes posted</b></li>
      </ul>
    </div>
  </div>

  <h1><center><?php echo htmlspecialchars($jokerName); ?>'s Jokes:</center></h1>

  <?php

    while($stmt->fetch()) {
      printJoke($jokeID, $jokeText, $postedBy, $rating, $timeStamp);
    }

    //AUTH defined above
    include "vote.php";

  ?>
</body>
</html>

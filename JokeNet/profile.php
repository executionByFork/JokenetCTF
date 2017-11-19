<?php
  
  //check for CTF login
  session_start();
  if (!$_SESSION['logged']) {
    $_SESSION['error'] = 1;
    $_SESSION['msg'] = "You must be logged in to visit that page!";
    //header("Location: /Main/authenticate.php");
    //die();
  }

  if (!$_COOKIE["logged"]) {
    header("Location: login.php");
    die();
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <link rel="stylesheet" type="text/css" href="/style/profile.css" />
  <link rel="stylesheet" href="/style/navbar.css" />
</head>
<body>
  <?php
    $highlightButton = 4;
    include "navbar.php";

    $user = (array_key_exists('user', $_GET) && is_string($_GET['user']))
                  ? $_GET['user'] : '';
    
    if (empty($user)) {
      print "<script type=\"text/javascript\">
               alert(\"User is empty!\");
             </script>";
      die();
    }

    include "../mysql.php";

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

    //$stmt->num_rows
  ?>

  <div class="n-profile-bar">
    <div class="name">
      <h3><?php echo $jokerName; ?></h3>
    </div>
    <div class="n-contact">
      <ul>
        <li class="email"><b><?php echo $email; ?></b></li>
        <li class="num"><b><?php echo $stmt->num_rows; ?> jokes posted</b></li>
      </ul>
    </div>
  </div>

  <?php

    include "../functions.php";

    while($stmt->fetch()) {
      printJoke($jokeID, $jokeText, $postedBy, $rating, $timeStamp);
    }

  ?>
</body>
</html>

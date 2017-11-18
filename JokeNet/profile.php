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
    header("Location: /login.php");
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
  ?>

  <div class="n-profile-bar">
    <div class="name">
      <h3>Username</h3>
    </div>
    <div class="n-contact">
      <ul>
        <li class="list fb">Email</li>
        <li class="list dribble">X jokes posted</li>
        <li class="list twitter">View Jokes</li>
      </ul>
    </div>
  </div>
</body>
</html>

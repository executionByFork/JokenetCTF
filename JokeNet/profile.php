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
    <!--
    <div class="about">
      <div class="my">
        <img src="http://profile.ak.fbcdn.net/hprofile-ak-prn1/c50.50.629.629/s160x160/72119_100897860077123_541454148_n.jpg" />
        <p>Based in</p>
        <p class="link">Turkey, Istanbul</p>
      </div>
      <div class="job">
       <img src="https://assets.nexum.com.tr/Upload/ContentImage/da8ed0da-057b-454b-988c-108ba9e5d5c7/hakkimizda-2.jpg" />
        <p>Web Developer at</p>
        <p class="link"> Nexum</p>
      </div>
    </div>
    -->
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

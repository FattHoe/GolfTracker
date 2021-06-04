<!DOCTYPE html>
<html lang="en-US">
  <head>
    <!-- Metadata Definitions -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title and Logo for Browser Navigation Bar -->
    <title>SportExcel Golf Tracker</title>
    <link rel="icon" href="sportexcel-logo.jpg">

    <!-- JS Function Declarations -->
    <script src="adminProfile.js"></script>

    <!-- CSS Style Definitions -->
    <style media="screen">
      .adminProfileElementButtons
      {
        background-color: white;
        border-bottom: solid black 1px;
        border-left: solid black 1px;
        border-right: solid black 1px;
        color: blue;
        height: 30px;
        width: 200px;
        margin: 0;
        text-align: center;
        line-height: 30px;
      }

      .adminProfileElementButtons:hover
      {
        background-color: lightgrey;
        cursor: pointer;
        text-decoration: underline;
      }

      #adminProfileButton
      {
        background-color: orange;
        height: 30px;
        width: 200px;
        margin: 0;
        position: fixed;
        top: 0;
        right: 0;
        z-index: 2;
      }

      #adminProfileButton:hover
      {
        background-color: darkorange;
      }

      #adminProfileContainer
      {
        margin: 0;
        padding: 0;
        position: fixed;
        top: 30px;
        right: 0;
        z-index: 2;
      }

      #title
      {
        margin: 50px 10px 5px;
      }

      #titleBanner
      {
        background-color: violet;
        margin: 0;
        position: absolute;
        top: 0;
        left: 50%;
        -ms-transform: translate(-50%);
        transform: translate(-50%);
        z-index: -1;
      }

      #navContainer
      {
        border: solid 1px;
        border-radius: 5px;
        height: 400px;
        width: 300px;
        margin: 0;
        position: absolute;
        top: 100px;
        left: 50%;
        -ms-transform: translate(-50%);
        transform: translate(-50%);
      }

      #directions, #playerButton, #tournamentButton, #categoryButton, #courseButton
      {
        margin: 0;
        position: absolute;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
      }

      #directions
      {
        top: 15%;
      }

      #playerButton, #tournamentButton, #categoryButton, #courseButton
      {
        height: 30px;
        width: 200px;
        z-index: 1;
      }

      #playerButton
      {
        background-color: gold;
        top: 40%;
      }

      #playerButton:hover
      {
        background-color: orange;
      }

      #tournamentButton
      {
        background-color: deepskyblue;
        top: 55%;
      }

      #tournamentButton:hover
      {
        background-color: dodgerblue;
      }

      #categoryButton
      {
        background-color: salmon;
        top: 70%;
      }

      #categoryButton:hover
      {
        background-color: tomato;
      }

      #courseButton
      {
        background-color: lime;
        top: 85%;
      }

      #courseButton:hover
      {
        background-color: limegreen;
      }

      @media screen and (min-height: 600px) {
        #navContainer
        {
          top: 50%;
          -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
        }
      }
    </style>
  </head>

  <body>
    <!-- PHP Form Operations -->
    <?php
      include "validateInput.php";

      $authenticated = false;

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;
      }
    ?>

    <!-- User Interface -->
    <button id="adminProfileButton" onclick="showOrHideAdminProfile()"><?php echo $username; ?></button>

    <div id="adminProfileContainer" hidden>
      <div class="adminProfileElementButtons" onclick="document.getElementById('passwordChangeSubmit').click()">Change&nbsp;password</div>
      <div class="adminProfileElementButtons" onclick="document.getElementById('addAdminSubmit').click()">Add&nbsp;another&nbsp;admin&nbsp;account</div>
      <div class="adminProfileElementButtons" onclick="window.location.href = 'admin-sign-in.php'">Sign&nbsp;in&nbsp;as&nbsp;another&nbsp;admin</div>
      <div class="adminProfileElementButtons" onclick="document.getElementById('homeSubmit').click()">Home</div>
    </div>

    <div id="titleBanner">
      <h1 id="title">Home</h1>
    </div>

    <div id="navContainer">
      <h1 id="directions">Select&nbsp;a&nbsp;Category</h1>
      <button id="playerButton" onclick="document.getElementById('playerSubmit').click()">Players</button>
      <button id="tournamentButton" onclick="document.getElementById('tournamentSubmit').click()">Tournaments&nbsp;&&nbsp;Scoring</button>
      <button id="categoryButton" onclick="document.getElementById('categorySubmit').click()">Age&nbsp;Categories</button>
      <button id="courseButton" onclick="document.getElementById('courseSubmit').click()">Golf&nbsp;Courses</button>
    </div>

    <!-- Hidden Forms -->
    <form method="post" action="admin-password-change.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="passwordChangeSubmit" type="submit">
    </form>
    
    <form method="post" action="admin-add-admin.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="addAdminSubmit" type="submit">
    </form>
    
    <form method="post" action="admin-navigation.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="homeSubmit" type="submit">
    </form>

    <form method="post" action="admin-view-players.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="playerSubmit" type="submit">
    </form>
    
    <form method="post" action="admin-view-tournaments.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="tournamentSubmit" type="submit">
    </form>
    
    <form method="post" action="admin-view-categories.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="categorySubmit" type="submit">
    </form>
    
    <form method="post" action="admin-view-courses.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="courseSubmit" type="submit">
    </form>
    
    <!-- PHP Outputs to JS Code -->
    <?php
      if (!$authenticated)
      {
        echo "<script>
                window.location.href = \"admin-sign-in.php\";
              </script>";
      }
    ?>
  </body>
</html>
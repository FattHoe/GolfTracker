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

    <script>
      function checkInput()
      {
        var inputValid = true;
        var warnings = document.getElementsByClassName("warning");

        for (w of warnings)
        {
          w.innerHTML = "";
        }

        if (document.getElementById("catNameInput").value == "")
        {
          inputValid = false;
          document.getElementById("catNameWarning").innerHTML = "<b>*&nbsp;Name&nbsp;Code&nbsp;Required</b>";
        }

        if (!document.getElementById("maleInput").checked && !document.getElementById("femaleInput").checked && !document.getElementById("allInput").checked)
        {
          inputValid = false;
          document.getElementById("genderWarning").innerHTML = "<b>*&nbsp;Gender&nbsp;Required</b>";
        }

        if (document.getElementById("minAgeInput").value == "" || document.getElementById("maxAgeInput").value == "")
        {
          inputValid = false;
          document.getElementById("ageWarning").innerHTML = "<b>*&nbsp;Both&nbsp;Minimum&nbsp;and&nbsp;Maximum&nbsp;Age&nbsp;Required</b>";
        }
        else if (parseInt(document.getElementById("minAgeInput").value) > parseInt(document.getElementById("maxAgeInput").value))
        {
          inputValid = false;
          document.getElementById("ageWarning").innerHTML = "<b>*&nbsp;Minimum&nbsp;Age&nbsp;must&nbsp;not&nbsp;be&nbsp;greater&nbsp;than&nbsp;Maximum&nbsp;Age</b>";
        }

        return inputValid;
      }
    </script>

    <!-- CSS Style Definitions -->
    <style media="screen">
      label
      {
        color: black;
        font-size: 15px;
      }

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

      .inputContainer
      {
        margin: 20px 20px 0;
      }

      .warning
      {
        color: red;
        font-size: 15px;
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

      #viewCatsButton
      {
        background-color: salmon;
        margin: 0;
        position: absolute;
        top: 5px;
        left: 5px;
        width: 200px;
        z-index: 2;
      }

      #viewCatsButton:hover
      {
        background-color: tomato;
      }

      #title
      {
        margin: 5px 10px 5px 200px;
      }

      #titleBanner
      {
        background-color: lime;
        margin: 0;
        position: absolute;
        top: 45px;
        left: 0;
        z-index: -1;
      }

      #formContainer
      {
        border: solid black 1px;
        border-radius: 5px;
        width: 900px;
        margin: 0 0 20px;
        position: absolute;
        top: 150px;
      }

      #form
      {
        font-size: 20px;
        margin: 0;
        padding-bottom: 20px;
        width: 900px;
      }

      #addSubmit
      {
        background-color: lime;
        margin: 0;
        position: absolute;
        bottom: 20px;
        right: 20px;
        z-index: 1;
      }

      #addSubmit:hover
      {
        background-color: limegreen;
      }

      @media screen and (min-width: 920px) {
        #formContainer
        {
          left: 50%;
          -ms-transform: translate(-50%);
          transform: translate(-50%);
        }
      }
    </style>
  </head>

  <body>
    <!-- PHP Database Operations -->
    <?php
      include "validateInput.php";

      $authenticated = false;
      $username = "";
      $ageGroupCode = "";
      $gender = "";
      $minAge = "";
      $maxAge = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        if ($_POST["ageGroupCode"])
        {
          $ageGroupCode = validateInput($_POST["ageGroupCode"]);
          $gender = validateInput($_POST["gender"]);
          $minAge = validateInput($_POST["minAge"]);
          $maxAge = validateInput($_POST["maxAge"]);
        }
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

    <button id="viewCatsButton" onclick="document.getElementById('viewCatsSubmit').click()">Back to View Categories</button>

    <div id="titleBanner">
      <h1 id="title">Add&nbsp;Age&nbsp;Category</h1>
    </div>

    <div id="formContainer">
      <form id="form" method="post" action="check-category.php" onsubmit="return checkInput()">
        <input type="text" name="username" value="<?php echo $username; ?>" hidden>
        
        <div class="inputContainer">
          Category&nbsp;Name&nbsp;Code:&nbsp;<span id="catNameWarning" class="warning"></span><br>
          <input id="catNameInput" type="text" name="ageGroupCode" value="<?php echo $ageGroupCode; ?>">
        </div>

        <div class="inputContainer">
          Gender:&nbsp;<span id="genderWarning" class="warning"></span><br>
          <input id="maleInput" type="radio" name="gender" value="M"<?php if ($gender == "M") { echo " checked"; } ?>>
          <label for="maleInput">Male</label>&nbsp;
          <input id="femaleInput" type="radio" name="gender" value="F"<?php if ($gender == "F") { echo " checked"; } ?>>
          <label for="femaleInput">Female</label>&nbsp;
          <input id="allInput" type="radio" name="gender" value="A"<?php if ($gender == "A") { echo " checked"; } ?>>
          <label for="allInput">All</label>
        </div>

        <div class="inputContainer">
          Age&nbsp;Group:&nbsp;<span id="ageWarning" class="warning"></span><br>
          <input id="minAgeInput" type="number" name="minAge" min="0" max="100" value="<?php echo $minAge; ?>">&nbsp;&nbsp;-&nbsp;
          <input id="maxAgeInput" type="number" name="maxAge" min="0" max="100" value="<?php echo $maxAge; ?>">&nbsp;<span style="font-size: 15px;">years&nbsp;old</span>
        </div>

        <input id="addSubmit" type="submit" value="Add Category">
      </form>
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

    <form method="post" action="admin-view-categories.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="viewCatsSubmit" type="submit">
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
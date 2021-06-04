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

        if (document.getElementById("username").value == "")
        {
          inputValid = false;
          document.getElementById("usernameWarning").innerHTML = "<b>*&nbsp;Username&nbsp;Required</b>";
        }
        else
        {
          document.getElementById("usernameWarning").innerHTML = "";
        }

        if (document.getElementById("password").value == "")
        {
          inputValid = false;
          document.getElementById("passwordWarning").innerHTML = "<b>*&nbsp;Password&nbsp;Required</b>";
        }
        else
        {
          document.getElementById("passwordWarning").innerHTML = "";
        }

        if (inputValid)
        {
          document.getElementById("username").value = document.getElementById("username").value.toLowerCase();
        }

        return inputValid;
      }

      function showPassword()
      {
        document.getElementById("password").type = "text";
        document.getElementById("hidePasswordButton").removeAttribute("hidden");
        document.getElementById("showPasswordButton").setAttributeNode(document.createAttribute("hidden"));

        return;
      }

      function hidePassword()
      {
        document.getElementById("password").type = "password";
        document.getElementById("showPasswordButton").removeAttribute("hidden");
        document.getElementById("hidePasswordButton").setAttributeNode(document.createAttribute("hidden"));

        return;
      }
    </script>

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
        z-index: 1;
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
        z-index: 1;
      }

      #addAdminContainer
      {
        border-radius: 5px;
        font-size: 25px;
        height: 300px;
        width: 600px;
        margin: 0;
        position: absolute;
        top: 50px;
      }

      #usernameContainer, #passwordContainer, #addAdminButton, #showPasswordButton, #hidePasswordButton
      {
        margin: 0;
        position: absolute;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
      }

      #usernameContainer, #passwordContainer, #addAdminButton
      {
        left: 50%;
      }

      #addAdminTitle
      {
        font-size: 30px;
      }

      #usernameContainer
      {
        top: 25%;
      }

      #passwordContainer
      {
        top: 50%;
      }

      #addAdminButton
      {
        font-size: 20px;
        top: 80%;
      }

      #username, #password
      {
        border: solid 1px;
        font-size: 20px;
        width: 300px;
      }

      #usernameWarning, #passwordWarning
      {
        color: red;
        font-size: 15px;
        position: absolute;
      }

      #usernameWarning
      {
        top: 60px;
        left: 271px;
      }

      #passwordWarning
      {
        top: 141px;
        left: 265px;
      }

      #showPasswordButton, #hidePasswordButton
      {
        font-size: 15px;
        color: blue;
        top: 56%;
        left: 82%;
      }

      #showPasswordButton:hover, #hidePasswordButton:hover
      {
        color: blue;
        cursor: pointer;
        text-decoration: underline;
      }

      @media screen and (min-width: 660px) and (max-height: 430px) {
        #addAdminContainer
        {
          left: 50%;
          -ms-transform: translate(-50%);
          transform: translate(-50%);
        }
      }

      @media screen and (max-width: 660px) and (min-height: 430px) {
        #addAdminContainer
        {
          top: 50%;
          -ms-transform: translate(0, -50%);
          transform: translate(0, -50%);
        }
      }

      @media screen and (min-width: 660px) and (min-height: 430px) {
        #addAdminContainer
        {
          top: 50%;
          left: 50%;
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
      $newUsername = "";
      $newPassword = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        if ($_POST["newUsername"] && $_POST["newPassword"])
        {
          $newUsername = validateInput($_POST["newUsername"]);
          $newPassword = validateInput($_POST["newPassword"]);
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
    
    <fieldset id="addAdminContainer">
      <legend id="addAdminTitle">Add&nbsp;New&nbsp;Administrator</legend>
      <form method="post" action="add-admin-account.php" onsubmit="return checkInput()">
        <input type="text" name="username" value="<?php echo $username; ?>" hidden>
        <span id="usernameContainer">Username: <input id="username" type="text" name="newUsername" value="<?php echo $newUsername; ?>" autofocus></span>
        <span id="usernameWarning"></span>
        <span id="passwordContainer">Password: <input id="password" type="password" name="newPassword" value="<?php echo $newPassword; ?>"></span>
        <span id="passwordWarning"></span>
        <p id="showPasswordButton" onclick="showPassword()">show&nbsp;password</p>
        <p id="hidePasswordButton" onclick="hidePassword()" hidden>hide&nbsp;password</p>
        <input id="addAdminButton" type="submit" value="Add Administrator">
      </form>
    </fieldset>

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

    <!-- PHP Outputs to JS Code -->
    <?php
      if (!$authenticated)
      {
        echo "<script>
                window.location.href = \"admin-sign-in.php\";
              </script>";
      }
      else if ($newUsername)
      {
        echo "<script>
                document.getElementById(\"usernameWarning\").innerHTML = \"<b>*&nbsp;Username&nbsp;Taken</b>\";
              </script>";
      }
    ?>
  </body>
</html>
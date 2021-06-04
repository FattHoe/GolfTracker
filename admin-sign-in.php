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
      #signInContainer
      {
        border-radius: 5px;
        font-size: 25px;
        height: 300px;
        width: 600px;
        margin: 0;
        position: absolute;
        top: 50px;
      }

      #usernameContainer, #passwordContainer, #signInButton, #showPasswordButton, #hidePasswordButton
      {
        margin: 0;
        position: absolute;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
      }

      #usernameContainer, #passwordContainer, #signInButton
      {
        left: 50%;
      }

      #signInTitle
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

      #signInButton
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
        #signInContainer
        {
          left: 50%;
          -ms-transform: translate(-50%);
          transform: translate(-50%);
        }
      }

      @media screen and (max-width: 660px) and (min-height: 430px) {
        #signInContainer
        {
          top: 50%;
          -ms-transform: translate(0, -50%);
          transform: translate(0, -50%);
        }
      }

      @media screen and (min-width: 660px) and (min-height: 430px) {
        #signInContainer
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

      $invalid = "";
      $username = "";
      $password = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["invalid"])
      {
        $invalid = validateInput($_POST["invalid"]);
        $username = validateInput($_POST["username"]);
        $password = validateInput($_POST["password"]);
      }
    ?>

    <!-- User Interface -->
    <fieldset id="signInContainer">
      <legend id="signInTitle">Sign&nbsp;In&nbsp;As&nbsp;Administrator</legend>
      <form method="post" action="authenticate-admin.php" onsubmit="return checkInput()">
        <span id="usernameContainer">Username: <input id="username" type="text" name="username" value="<?php echo $username; ?>"<?php if ($invalid != "password") { echo " autofocus"; } ?>></span>
        <span id="usernameWarning"></span>
        <span id="passwordContainer">Password: <input id="password" type="password" name="password" value="<?php echo $password; ?>"<?php if ($invalid == "password") { echo " autofocus"; } ?>></span>
        <span id="passwordWarning"></span>
        <p id="showPasswordButton" onclick="showPassword()">show&nbsp;password</p>
        <p id="hidePasswordButton" onclick="hidePassword()" hidden>hide&nbsp;password</p>
        <input id="signInButton" type="submit" value="Sign In">
      </form>
    </fieldset>

    <!-- PHP Outputs to JS Code -->
    <?php
      if ($invalid == "username")
      {
        echo "<script>
                document.getElementById(\"usernameWarning\").innerHTML = \"<b>* Username Invalid</b>\";
              </script>";
      }
      else if ($invalid == "password")
      {
        echo "<script>
                document.getElementById(\"passwordWarning\").innerHTML = \"<b>* Password Invalid</b>\";
              </script>";
      }
    ?>
  </body>
</html>
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

        if (document.getElementById("password1").value == "")
        {
          inputValid = false;
          document.getElementById("password1Warning").innerHTML = "<b>*&nbsp;Password&nbsp;Required</b>";
        }
        else
        {
          document.getElementById("password1Warning").innerHTML = "";
        }

        if (document.getElementById("password2").value == "")
        {
          inputValid = false;
          document.getElementById("password2Warning").innerHTML = "<b>*&nbsp;Password&nbsp;Required</b>";
        }
        else
        {
          document.getElementById("password2Warning").innerHTML = "";
        }

        if (inputValid && document.getElementById("password1").value != document.getElementById("password2").value)
        {
          inputValid = false;
          document.getElementById("password2Warning").innerHTML = "<b>*&nbsp;Passwords&nbsp;Must&nbsp;Match</b>";
        }

        return inputValid;
      }

      function showPassword(passwordNum)
      {
        document.getElementById("password" + passwordNum).type = "text";
        document.getElementById("hidePassword" + passwordNum + "Button").removeAttribute("hidden");
        document.getElementById("showPassword" + passwordNum + "Button").setAttributeNode(document.createAttribute("hidden"));

        return;
      }

      function hidePassword(passwordNum)
      {
        document.getElementById("password" + passwordNum).type = "password";
        document.getElementById("showPassword" + passwordNum + "Button").removeAttribute("hidden");
        document.getElementById("hidePassword" + passwordNum + "Button").setAttributeNode(document.createAttribute("hidden"));

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

      #passwordChangeContainer
      {
        border-radius: 5px;
        font-size: 25px;
        height: 300px;
        width: 600px;
        top: 50px;
        margin: 0;
        position: absolute;
      }
      
      #password1Container, #password2Container, #confirmButton, #showPassword1Button, #hidePassword1Button, #showPassword2Button, #hidePassword2Button
      {
        margin: 0;
        position: absolute;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
      }

      #password1Container, #password2Container, #confirmButton
      {
        left: 50%;
      }

      #passwordChangeTitle
      {
        font-size: 30px;
      }

      #password1Container
      {
        top: 25%;
      }

      #password2Container
      {
        top: 50%;
      }

      #confirmButton
      {
        font-size: 20px;
        top: 80%;
      }

      #password1, #password2
      {
        border: solid 1px;
        font-size: 20px;
        width: 300px;
      }

      #password1Warning, #password2Warning
      {
        color: red;
        font-size: 15px;
        position: absolute;
      }

      #password1Warning
      {
        top: 60px;
        left: 371px;
      }

      #password2Warning
      {
        top: 141px;
        left: 356px;
      }

      #showPassword1Button, #hidePassword1Button, #showPassword2Button, #hidePassword2Button
      {
        font-size: 15px;
        color: blue;
        left: 82%;
      }

      #showPassword1Button, #hidePassword1Button
      {
        top: 31%;
      }

      #showPassword2Button, #hidePassword2Button
      {
        top: 56%;
      }

      #showPassword1Button:hover, #hidePassword1Button:hover, #showPassword2Button:hover, #hidePassword2Button:hover
      {
        color: blue;
        cursor: pointer;
        text-decoration: underline;
      }

      @media screen and (min-width: 660px) and (max-height: 430px) {
        #passwordChangeContainer
        {
          left: 50%;
          -ms-transform: translate(-50%);
          transform: translate(-50%);
        }
      }

      @media screen and (max-width: 660px) and (min-height: 430px) {
        #passwordChangeContainer
        {
          top: 50%;
          -ms-transform: translate(0, -50%);
          transform: translate(0, -50%);
        }
      }

      @media screen and (min-width: 660px) and (min-height: 430px) {
        #passwordChangeContainer
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

    <fieldset id="passwordChangeContainer">
      <legend id="passwordChangeTitle">Change&nbsp;Password</legend>
      <form method="post" action="change-password.php" onsubmit="return checkInput()">
        <input type="text" name="username" value="<?php echo $username; ?>" hidden>
        <span id="password1Container">Enter&nbsp;new&nbsp;password: <input id="password1" type="password" name="password" autofocus></span>
        <span id="password1Warning"></span>
        <p id="showPassword1Button" onclick="showPassword('1')">show&nbsp;password</p>
        <p id="hidePassword1Button" onclick="hidePassword('1')" hidden>hide&nbsp;password</p>
        <span id="password2Container">Re-enter&nbsp;password: <input id="password2" type="password"></span>
        <span id="password2Warning"></span>
        <p id="showPassword2Button" onclick="showPassword('2')">show&nbsp;password</p>
        <p id="hidePassword2Button" onclick="hidePassword('2')" hidden>hide&nbsp;password</p>
        <input id="confirmButton" type="submit" value="Confirm">
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
    ?>
  </body>
</html>
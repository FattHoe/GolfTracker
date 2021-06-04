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

      function undisableInput()
      {
        document.getElementById("catNameInput").removeAttribute("disabled");
        document.getElementById("maleInput").removeAttribute("disabled");
        document.getElementById("femaleInput").removeAttribute("disabled");
        document.getElementById("allInput").removeAttribute("disabled");
        document.getElementById("minAgeInput").removeAttribute("disabled");
        document.getElementById("maxAgeInput").removeAttribute("disabled");
        document.getElementById("editSubmit").removeAttribute("hidden");
        document.getElementById("editButton").setAttributeNode(document.createAttribute("hidden"));
        document.getElementById("cancelButton").removeAttribute("hidden");

        return false;
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
        background-color: deepskyblue;
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
        width: 1100px;
      }

      #editButton
      {
        background-color: deepskyblue;
        margin: 0;
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 1;
      }

      #editButton:hover
      {
        background-color: dodgerblue;
      }

      #cancelButton
      {
        background-color: salmon;
        margin: 0;
        position: absolute;
        top: 20px;
        right: 20px;
        z-index: 1;
      }

      #cancelButton:hover
      {
        background-color: tomato;
      }

      #editSubmit
      {
        background-color: lime;
        margin: 0;
        position: absolute;
        bottom: 20px;
        right: 20px;
        z-index: 1;
      }

      #editSubmit:hover
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
      include "connection.php";
      include "validateInput.php";
      include "mysqlQueries.php";

      $conn = openConn();

      $authenticated = false;
      $catDeleted = true;
      $username = "";
      $ageGroupCode = "";
      $gender = "";
      $minAge = "";
      $maxAge = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        $catId = (int)validateInput($_POST["categoryID"]);

        $catResults = $conn->query(sprintf(GET_CATEGORY, $catId));

        if ($catResults->num_rows == 1)
        {
          $catDeleted = false;
          $cat = $catResults->fetch_assoc();

          $ageGroupCode = $cat["ageGroupCode"];
          $gender = $cat["gender"];
          $minAge = $cat["minAge"];
          $maxAge = $cat["maxAge"];
        }
      }

      closeConn($conn);
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
      <h1 id="title"><?php echo $ageGroupCode; ?></h1>
    </div>

    <div id="formContainer">
      <form id="form" method="post" action="edit-category.php" onsubmit="return checkInput()">
        <input type="text" name="username" value="<?php echo $username; ?>" hidden>
        <input type="number" name="categoryID" value="<?php echo $catId; ?>" hidden>

        <button id="editButton" onclick="return undisableInput()">Edit Category</button>
        <button id="cancelButton" onclick="document.getElementById('cancelSubmit').click(); return false;" hidden>Cancel Edit</button>
        
        <div class="inputContainer">
          Category&nbsp;Name&nbsp;Code:&nbsp;<span id="catNameWarning" class="warning"></span><br>
          <input id="catNameInput" type="text" name="ageGroupCode" value="<?php echo $ageGroupCode; ?>" disabled>
        </div>

        <div class="inputContainer">
          Gender:&nbsp;<span id="genderWarning" class="warning"></span><br>
          <input id="maleInput" type="radio" name="gender" value="M"<?php if ($gender == "M") { echo " checked"; } ?> disabled>
          <label for="maleInput">Male</label>&nbsp;
          <input id="femaleInput" type="radio" name="gender" value="F"<?php if ($gender == "F") { echo " checked"; } ?> disabled>
          <label for="femaleInput">Female</label>&nbsp;
          <input id="allInput" type="radio" name="gender" value="A"<?php if ($gender == "A") { echo " checked"; } ?> disabled>
          <label for="allInput">All</label>
        </div>

        <div class="inputContainer">
          Age&nbsp;Group:&nbsp;<span id="ageWarning" class="warning"></span><br>
          <input id="minAgeInput" type="number" name="minAge" min="0" max="100" value="<?php echo $minAge; ?>" disabled>&nbsp;&nbsp;-&nbsp;
          <input id="maxAgeInput" type="number" name="maxAge" min="0" max="100" value="<?php echo $maxAge; ?>" disabled>&nbsp;<span style="font-size: 15px;">years&nbsp;old</span>
        </div>

        <input id="editSubmit" type="submit" value="Update Category" hidden>
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

    <form method="post" action="admin-edit-category.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input type="number" name="categoryID" value="<?php echo $catId; ?>">
      <input id="cancelSubmit" type="submit">
    </form>
  
    <!-- PHP Outputs to JS Code -->
    <?php
      if (!$authenticated)
      {
        echo "<script>
                window.location.href = \"admin-sign-in.php\";
              </script>";
      }
      else if ($catDeleted)
      {
        echo "<script>
                window.alert(\"This category no longer exists.\");
                document.getElementById(\"viewCatsSubmit\").click();
              </script>";
      }
    ?>
  </body>
</html>
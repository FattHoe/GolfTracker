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
      function displayCategories(cats)
      {
        var tableHtml = "";

        if (cats.length > 0)
        {
          var ctr = 1;
          for (ageGroup of cats)
          {
            if (ctr % 2 == 1)
            {
              tableHtml += "<tr>";
            }

            tableHtml += "<td>";
            tableHtml += "<span style=\"font-size: 20px;\"><b>" + ageGroup["ageGroupCode"] + "</b></span><br>";

            tableHtml += "<span><b>Gender:</b>&nbsp;";
            if (ageGroup["gender"] == "M")
            {
              tableHtml += "Male";
            }
            else if (ageGroup["gender"] == "F")
            {
              tableHtml += "Female";
            }
            else if (ageGroup["gender"] == "A")
            {
              tableHtml += "All";
            }
            tableHtml += "</span>";

            tableHtml += "<span class=\"ageAtt\"><b>Age:</b>&nbsp;" + ageGroup["minAge"] + "&nbsp;-&nbsp;" + ageGroup["maxAge"] + "&nbsp;years&nbsp;old</span>";
            tableHtml += "<button class=\"viewButtons\" onclick=\"goToViewCategory(" + ageGroup["categoryID"] + ")\">View</button>";
            tableHtml += "<button class=\"deleteButtons\" onclick=\"deleteCategory(" + ageGroup["categoryID"] + ", '" + ageGroup["ageGroupCode"] + "')\">Delete</button>";
            tableHtml += "</td>";

            if (ctr % 2 == 0)
            {
              tableHtml += "</tr>";
            }

            ctr++;
          }
          if (ctr % 2 == 0)
          {
            tableHtml += "</tr>";
          }
        }
        else
        {
          tableHtml = "<tr><td>No Categories Found</td></tr>";
        }

        document.getElementById("catTable").innerHTML = tableHtml;

        return;
      }

      function goToViewCategory(catId)
      {
        document.getElementById("viewCatId").value = catId;
        document.getElementById("viewSubmit").click();

        return;
      }

      function deleteCategory(catId, catName)
      {
        if (window.confirm("Are you sure you want to delete category \"" + catName + "\" from the database?"))
        {
          document.getElementById("deleteCatId").value = catId;
          document.getElementById("deleteSubmit").click();
        }

        return;
      }
    </script>

    <!-- CSS Style Definitions -->
    <style media="screen">
      td
      {
        background-color: white;
        border: solid black 1px;
        border-radius: 5px;
        font-size: 15px;
        padding: 5px;
        position: relative;
        width: 50%;
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

      .ageAtt
      {
        position: absolute;
        top: 27px;
        left: 150px;
      }

      .viewButtons, .deleteButtons
      {
        height: 25px;
        margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
      }

      .viewButtons
      {
        background-color: deepskyblue;
        left: 80%;
        width: 50px;
        z-index: 1;
      }

      .viewButtons:hover
      {
        background-color: dodgerblue;
      }

      .deleteButtons
      {
        background-color: salmon;
        left: 92%;
        width: 60px;
        z-index: 1;
      }

      .deleteButtons:hover
      {
        background-color: tomato;
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

      #homeButton
      {
        background-color: violet;
        margin: 0;
        position: fixed;
        top: 5px;
        left: 5px;
        width: 150px;
        z-index: 2;
      }

      #homeButton:hover
      {
        background-color: orchid;
      }

      #title
      {
        margin: 5px 10px 5px 200px;
      }

      #titleBanner
      {
        background-color: salmon;
        margin: 0;
        position: absolute;
        top: 45px;
        left: 0;
        z-index: -1;
      }

      #displayContainer
      {
        height: 540px;
        width: 1030px;
        margin: 0 0 20px;
        position: absolute;
        top: 110px;
      }

      #catSearchForm
      {
        background-color: lightgrey;
        border: solid lightgrey 1px;
        border-radius: 5px;
        margin: 0;
        padding: 5px;
        position: absolute;
        top: 0;
        left: 0;
        width: auto;
      }

      #catSearchInput
      {
        border: solid black 1px;
        margin: 0;
        width: 200px;
      }

      #catSearchSubmit
      {
        background-color: lightskyblue;
        margin: 0;
      }

      #catSearchSubmit:hover
      {
        background-color: deepskyblue;
      }

      #catSearchResetButton
      {
        background-color: salmon;
        margin: 0;
      }

      #catSearchResetButton:hover
      {
        background-color: tomato;
      }

      #addButton
      {
        background-color: lime;
        height: 30px;
        width: 100px;
        margin: 0;
        position: absolute;
        top: 0;
        right: 60px;
      }

      #addButton:hover
      {
        background-color: limegreen;
      }

      #catDisplayContainer
      {
        background-color: salmon;
        border: solid salmon 5px;
        border-radius: 5px;
        height: 500px;
        width: 1000px;
        margin: 0;
        padding: 0;
        position: absolute;
        top: 40px;
        left: 0;
        overflow-y: scroll;
      }

      #catTable
      {
        width: 980px;
        margin: 0;
      }

      @media screen and (min-width: 1065px) {
        #displayContainer
        {
          left: 50%;
          -ms-transform: translate(-50%);
          transform: translate(-50%);
        }
      }
    </style>
  </head>

  <body>
    <!-- PHP Constant Declarations -->
    <?php
      define("MAX_CATEGORIES", 100);
    ?>

    <!-- PHP Database Operations -->
    <?php
      include "connection.php";
      include "mysqlQueries.php";
      include "validateInput.php";

      $conn = openConn();

      $authenticated = false;
      $username = "";
      $catSearch = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        if ($_POST["catSearch"])
        {
          $catSearch = validateInput($_POST["catSearch"]);
          $cats = $conn->query(sprintf(GET_CATEGORIES_BY_NAME_SEARCH, strtolower($catSearch), MAX_CATEGORIES));
        }
        else
        {
          $cats = $conn->query(sprintf(GET_CATEGORIES, MAX_CATEGORIES));
        }

        $categoryIds = array();
        $ageGroupCodes = array();
        $genders = array();
        $minAges = array();
        $maxAges = array();

        while ($ageGroup = $cats->fetch_assoc())
        {
          array_push($categoryIds, $ageGroup["categoryID"]);
          array_push($ageGroupCodes, $ageGroup["ageGroupCode"]);
          array_push($genders, $ageGroup["gender"]);
          array_push($minAges, $ageGroup["minAge"]);
          array_push($maxAges, $ageGroup["maxAge"]);
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

    <button id="homeButton" onclick="document.getElementById('homeSubmit').click()">Back to Home Page</button>

    <div id="titleBanner">
      <h1 id="title">Age&nbsp;Categories</h1>
    </div>

    <div id="displayContainer">
      <form id="catSearchForm" method="post" action="admin-view-categories.php">
        <input type="text" name="username" value="<?php echo $username; ?>" hidden>
        Search&nbsp;Category&nbsp;By:&nbsp;
        <input id="catSearchInput" type="text" name="catSearch" placeholder="Name" value="<?php echo $catSearch; ?>">&nbsp;
        <input id="catSearchSubmit" type="submit" value="Search">
        <span id="catSearchResetContainer">&nbsp;<button id="catSearchResetButton" onclick="document.getElementById('catSearchInput').value = ''; return true;">Reset Search Filter</button></span>
      </form>

      <button id="addButton" onclick="document.getElementById('addSubmit').click()">Add Category</button>
      
      <div id="catDisplayContainer">
        <table id="catTable"></table>
      </div>
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

    <form method="post" action="admin-add-category.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="addSubmit" type="submit">
    </form>

    <form method="post" action="admin-edit-category.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="viewCatId" type="number" name="categoryID">
      <input id="viewSubmit" type="submit">
    </form>

    <form method="post" action="delete-category.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="deleteCatId" type="number" name="categoryID">
      <input id="deleteSubmit" type="submit">
    </form>

    <!-- JS Code -->
    <script>
      if (document.getElementById("catSearchInput").value == "")
      {
        document.getElementById("catSearchResetContainer").setAttributeNode(document.createAttribute("hidden"));
      }
    </script>
    
    <!-- PHP Outputs to JS Code -->
    <?php
      if (!$authenticated)
      {
        echo "<script>
                window.location.href = \"admin-sign-in.php\";
              </script>";
      }
      else
      {
        echo "<script>
                var cats = [];
                var ageGroup;";
        for ($i = 0; $i < count($categoryIds); $i++)
        {
          echo "ageGroup = {};
                ageGroup[\"categoryID\"] = \"", $categoryIds[$i], "\";
                ageGroup[\"ageGroupCode\"] = \"", $ageGroupCodes[$i], "\";
                ageGroup[\"gender\"] = \"", $genders[$i], "\";
                ageGroup[\"minAge\"] = ", $minAges[$i], ";
                ageGroup[\"maxAge\"] = ", $maxAges[$i], ";
                cats.push(ageGroup);";
        }
        echo   "displayCategories(cats);
              </script>";
      }
    ?>
  </body>
</html>
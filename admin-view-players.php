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
      function displayPlayers(players)
      {
        var tableHtml = "";

        if (players.length > 0)
        {
          for (golfer of players)
          {
            tableHtml += "<tr><td>";
            tableHtml += "<span style=\"font-size: 20px;\"><b>" + golfer["firstName"] + "&nbsp;" + golfer["lastName"] + "</b></span><br>";

            tableHtml += "<span><b>Gender:</b>&nbsp;";
            if (golfer["gender"] == "M")
            {
              tableHtml += "Male";
            }
            else if (golfer["gender"] == "F")
            {
              tableHtml += "Female";
            }
            tableHtml += "</span>";

            tableHtml += "<span class=\"dobAtt\"><b>DOB:</b>&nbsp;" + golfer["dayOfBirth"] + "/" + golfer["monthOfBirth"] + "/" + golfer["yearOfBirth"] + "</span>";

            tableHtml += "<span class=\"handicapAtt\"><b>Handicap:</b>&nbsp;";
            if (golfer["handicap"])
            {
              tableHtml += golfer["handicap"];
            }
            else if (golfer["handicap"] === 0)
            {
              tableHtml += "0";
            }
            else
            {
              tableHtml += "N/A";
            }
            tableHtml += "</span>";

            tableHtml += "<span class=\"lastUpdatedAtt\"><b>Last&nbsp;updated:</b>&nbsp;" + golfer["lastUpdatedDay"] + "/" + golfer["lastUpdatedMonth"] + "/" + golfer["lastUpdatedYear"] + "</span>";
            tableHtml += "<span class=\"countryAtt\"><b>Country:</b>&nbsp;" + golfer["country"] + "</span>";
            tableHtml += "<button class=\"viewButtons\" onclick=\"goToViewPlayer(" + golfer["playerID"] + ")\">View</button>";
            tableHtml += "<button class=\"deleteButtons\" onclick=\"deletePlayer(" + golfer["playerID"] + ", '" + golfer["firstName"] + " " + golfer["lastName"] + "')\">Delete</button>";
            tableHtml += "</td></tr>";
          }
        }
        else
        {
          tableHtml = "<tr><td>No Players Found</td></tr>";
        }

        document.getElementById("playerTable").innerHTML = tableHtml;

        return;
      }

      function goToViewPlayer(playerId)
      {
        document.getElementById("viewPlayerId").value = playerId;
        document.getElementById("viewSubmit").click();

        return;
      }

      function deletePlayer(playerId, playerName)
      {
        if (window.confirm("Are you sure you want to delete \"" + playerName + "\" from the database?"))
        {
          document.getElementById("deletePlayerId").value = playerId;
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

      .dobAtt, .handicapAtt, .lastUpdatedAtt, .countryAtt
      {
        position: absolute;
        top: 27px;
      }

      .dobAtt
      {
        left: 114px;
      }

      .handicapAtt
      {
        left: 229px;
      }

      .lastUpdatedAtt
      {
        left: 333px;
      }

      .countryAtt
      {
        left: 500px;
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
        left: 90%;
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
        left: 96%;
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
        background-color: gold;
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

      #nameSearchForm
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

      #firstNameSearchInput, #lastNameSearchInput
      {
        border: solid black 1px;
        margin: 0;
        width: 200px;
      }

      #nameSearchSubmit
      {
        background-color: lightskyblue;
        margin: 0;
      }

      #nameSearchSubmit:hover
      {
        background-color: deepskyblue;
      }

      #nameSearchResetButton
      {
        background-color: salmon;
        margin: 0;
      }

      #nameSearchResetButton:hover
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

      #playerDisplayContainer
      {
        background-color: gold;
        border: solid gold 5px;
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

      #playerTable
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
      define("MAX_PLAYERS", 100);
    ?>

    <!-- PHP Database Operations -->
    <?php
      include "connection.php";
      include "mysqlQueries.php";
      include "validateInput.php";

      $conn = openConn();

      $authenticated = false;
      $username = "";
      $firstNameSearch = "";
      $lastNameSearch = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        if ($_POST["firstNameSearch"] || $_POST["lastNameSearch"])
        {
          $firstNameSearch = validateInput($_POST["firstNameSearch"]);
          $lastNameSearch = validateInput($_POST["lastNameSearch"]);
          $players = $conn->query(sprintf(GET_PLAYERS_BY_NAME_SEARCH, strtolower($firstNameSearch), strtolower($lastNameSearch), MAX_PLAYERS));
        }
        else
        {
          $players = $conn->query(sprintf(GET_LAST_UPDATED_PLAYERS, MAX_PLAYERS));
        }

        $playerIds = array();
        $firstNames = array();
        $lastNames = array();
        $dayOfBirths = array();
        $monthOfBirths = array();
        $yearOfBirths = array();
        $genders = array();
        $countries = array();
        $handicaps = array();
        $lastUpdatedDays = array();
        $lastUpdatedMonths = array();
        $lastUpdatedYears = array();

        while ($golfer = $players->fetch_assoc())
        {
          array_push($playerIds, $golfer["playerID"]);
          array_push($firstNames, $golfer["firstName"]);
          array_push($lastNames, $golfer["lastName"]);
          array_push($dayOfBirths, $golfer["dayOfBirth"]);
          array_push($monthOfBirths, $golfer["monthOfBirth"]);
          array_push($yearOfBirths, $golfer["yearOfBirth"]);
          array_push($genders, $golfer["gender"]);
          array_push($countries, $golfer["country"]);
          array_push($handicaps, $golfer["handicap"]);
          array_push($lastUpdatedDays, $golfer["lastUpdatedDay"]);
          array_push($lastUpdatedMonths, $golfer["lastUpdatedMonth"]);
          array_push($lastUpdatedYears, $golfer["lastUpdatedYear"]);
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
      <h1 id="title">Players</h1>
    </div>

    <div id="displayContainer">
      <form id="nameSearchForm" method="post" action="admin-view-players.php">
        <input type="text" name="username" value="<?php echo $username; ?>" hidden>
        Search&nbsp;Player&nbsp;By:&nbsp;
        <input id="firstNameSearchInput" type="text" name="firstNameSearch" placeholder="First Name" value="<?php echo $firstNameSearch; ?>">&nbsp;
        <input id="lastNameSearchInput" type="text" name="lastNameSearch" placeholder="Last Name" value="<?php echo $lastNameSearch; ?>">&nbsp;
        <input id="nameSearchSubmit" type="submit" value="Search">
        <span id="nameSearchResetContainer">&nbsp;<button id="nameSearchResetButton" onclick="document.getElementById('firstNameSearchInput').value = ''; document.getElementById('lastNameSearchInput').value = ''; return true;">Reset Search Filter</button></span>
      </form>

      <button id="addButton" onclick="document.getElementById('addSubmit').click()">Add Player</button>
      
      <div id="playerDisplayContainer">
        <table id="playerTable"></table>
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

    <form method="post" action="admin-add-player.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="addSubmit" type="submit">
    </form>

    <form method="post" action="admin-edit-player.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="viewPlayerId" type="number" name="playerID">
      <input id="viewSubmit" type="submit">
    </form>

    <form method="post" action="delete-player.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="deletePlayerId" type="number" name="playerID">
      <input id="deleteSubmit" type="submit">
    </form>

    <!-- JS Code -->
    <script>
      if (document.getElementById("firstNameSearchInput").value == "" && document.getElementById("lastNameSearchInput").value == "")
      {
        document.getElementById("nameSearchResetContainer").setAttributeNode(document.createAttribute("hidden"));
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
                var players = [];
                var golfer;";
        for ($i = 0; $i < count($playerIds); $i++)
        {
          echo "golfer = {};
                golfer[\"playerID\"] = \"", $playerIds[$i], "\";
                golfer[\"firstName\"] = \"", $firstNames[$i], "\";
                golfer[\"lastName\"] = \"", $lastNames[$i], "\";
                golfer[\"dayOfBirth\"] = ", $dayOfBirths[$i], ";
                golfer[\"monthOfBirth\"] = ", $monthOfBirths[$i], ";
                golfer[\"yearOfBirth\"] = ", $yearOfBirths[$i], ";
                golfer[\"gender\"] = \"", $genders[$i], "\";
                golfer[\"country\"] = \"", $countries[$i], "\";
                golfer[\"handicap\"] = \"", $handicaps[$i], "\";
                golfer[\"lastUpdatedDay\"] = ", $lastUpdatedDays[$i], ";
                golfer[\"lastUpdatedMonth\"] = ", $lastUpdatedMonths[$i], ";
                golfer[\"lastUpdatedYear\"] = ", $lastUpdatedYears[$i], ";
                players.push(golfer);";
        }
        echo   "displayPlayers(players);
              </script>";
      }
    ?>
  </body>
</html>
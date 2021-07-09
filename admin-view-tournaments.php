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
      function displayTournaments(tournaments)
      {
        var tableHtml = "";
        var date = new Date();

        if (tournaments.length > 0)
        {
          for (tourney of tournaments)
          {
            tableHtml += "<tr><td>";
            tableHtml += "<span style=\"font-size: 20px;\"><b>" + tourney["tournamentName"] + "</b></span><br>";
            tableHtml += "<span><b>Date:</b>&nbsp;" + tourney["startDay"] + "/" + tourney["startMonth"] + "/" + tourney["startYear"];
            tableHtml += "&nbsp;-&nbsp;" + tourney["endDay"] + "/" + tourney["endMonth"] + "/" + tourney["endYear"] + "</span>";
            tableHtml += "<span class=\"numPlayersAtt\"><b>Player&nbsp;Count:</b>&nbsp;" + tourney["actualNumPlayers"] + "</span>";

            tableHtml += "<span class=\"registerDateAtt\"><b>Registration:</b>&nbsp;";
            if (date.getFullYear() < tourney["registerOpenYear"] || (date.getFullYear() == tourney["registerOpenYear"] && ((date.getMonth() + 1) < tourney["registerOpenMonth"] || ((date.getMonth() + 1) == tourney["registerOpenMonth"] && date.getDate() < tourney["registerOpenDay"]))))
            {
              tableHtml += "Opens&nbsp;on&nbsp;" + tourney["registerOpenDay"] + "/" + tourney["registerOpenMonth"] + "/" + tourney["registerOpenYear"];
            }
            else if (date.getFullYear() < tourney["registerCloseYear"] || (date.getFullYear() == tourney["registerCloseYear"] && ((date.getMonth() + 1) < tourney["registerCloseMonth"] || ((date.getMonth() + 1) == tourney["registerCloseMonth"] && date.getDate() < tourney["registerCloseDay"]))))
            {
              tableHtml += "Closes&nbsp;on&nbsp;" + tourney["registerCloseDay"] + "/" + tourney["registerCloseMonth"] + "/" + tourney["registerCloseYear"];
            }
            else if (date.getFullYear() == tourney["registerCloseYear"] && (date.getMonth() + 1) == tourney["registerCloseMonth"] && date.getDate() == tourney["registerCloseDay"])
            {
              tableHtml += "Closes&nbsp;Today";
            }
            else
            {
              tableHtml += "Closed";
            }
            tableHtml += "</span>";

            tableHtml += "<span class=\"paymentDateAtt\"><b>Payment:</b>&nbsp;";
            if (date.getFullYear() < tourney["paymentCloseYear"] || (date.getFullYear() == tourney["paymentCloseYear"] && ((date.getMonth() + 1) < tourney["paymentCloseMonth"] || ((date.getMonth() + 1) == tourney["paymentCloseMonth"] && date.getDate() < tourney["paymentCloseDay"]))))
            {
              tableHtml += "Closes&nbsp;on&nbsp;" + tourney["paymentCloseDay"] + "/" + tourney["paymentCloseMonth"] + "/" + tourney["paymentCloseYear"];
            }
            else if (date.getFullYear() == tourney["paymentCloseYear"] && (date.getMonth() + 1) == tourney["paymentCloseMonth"] && date.getDate() == tourney["paymentCloseDay"])
            {
              tableHtml += "Closes&nbsp;Today";
            }
            else
            {
              tableHtml += "Closed";
            }
            tableHtml += "</span>";

            tableHtml += "<button class=\"scoringButtons\" onclick=\"goToScoring(" + tourney["tournamentID"] + ")\">Scoring</button>";
            tableHtml += "<button class=\"viewButtons\" onclick=\"goToViewTournament(" + tourney["tournamentID"] + ")\">View</button>";
            tableHtml += "<button class=\"deleteButtons\" onclick=\"deleteTournament(" + tourney["tournamentID"] + ", '" + tourney["tournamentName"] + "')\">Delete</button>";
            tableHtml += "</td></tr>";
          }
        }
        else
        {
          tableHtml = "<tr><td>No Tournaments Found</td></tr>";
        }

        document.getElementById("tournamentTable").innerHTML = tableHtml;

        return;
      }

      function goToScoring(tournamentId)
      {
        document.getElementById("scoringTournamentId").value = tournamentId;
        document.getElementById("scoringSubmit").click();

        return;
      }

      function goToViewTournament(tournamentId)
      {
        document.getElementById("viewTournamentId").value = tournamentId;
        document.getElementById("viewSubmit").click();

        return;
      }

      function deleteTournament(tournamentId, tournamentName)
      {
        if (window.confirm("Are you sure you want to delete \"" + tournamentName + "\" from the database?"))
        {
          document.getElementById("deleteTournamentId").value = tournamentId;
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

      .numPlayersAtt, .registerDateAtt, .paymentDateAtt
      {
        position: absolute;
        top: 27px;
      }

      .numPlayersAtt
      {
        left: 220px;
      }

      .registerDateAtt
      {
        left: 340px;
      }

      .paymentDateAtt
      {
        left: 570px;
      }

      .scoringButtons, .viewButtons, .deleteButtons
      {
        height: 25px;
        margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
      }

      .scoringButtons
      {
        background-color: gold;
        left: 84%;
        width: 60px;
      }

      .scoringButtons:hover
      {
        background-color: orange;
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
        background-color: deepskyblue;
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

      #nameSearchInput
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
        width: 150px;
        margin: 0;
        position: absolute;
        top: 0;
        right: 60px;
      }

      #addButton:hover
      {
        background-color: limegreen;
      }

      #tournamentDisplayContainer
      {
        background-color: deepskyblue;
        border: solid deepskyblue 5px;
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

      #tournamentTable
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
      define("MAX_TOURNAMENTS", 100);
    ?>

    <!-- PHP Database Operations -->
    <?php
      include "connection.php";
      include "mysqlQueries.php";
      include "validateInput.php";

      $conn = openConn();

      $authenticated = false;
      $username = "";
      $nameSearch = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        if ($_POST["nameSearch"])
        {
          $nameSearch = validateInput($_POST["nameSearch"]);
          $tournaments = $conn->query(sprintf(GET_TOURNAMENTS_BY_NAME_SEARCH, strtolower($nameSearch), MAX_TOURNAMENTS));
        }
        else
        {
          $tournaments = $conn->query(sprintf(GET_LATEST_TOURNAMENTS, MAX_TOURNAMENTS));
        }

        $tournamentIds = array();
        $tournamentNames = array();
        $startDays = array();
        $startMonths = array();
        $startYears = array();
        $endDays = array();
        $endMonths = array();
        $endYears = array();
        $actualNumPlayers = array();
        $registerOpenDays = array();
        $registerOpenMonths = array();
        $registerOpenYears = array();
        $registerCloseDays = array();
        $registerCloseMonths = array();
        $registerCloseYears = array();
        $paymentCloseDays = array();
        $paymentCloseMonths = array();
        $paymentCloseYears = array();

        while ($tourney = $tournaments->fetch_assoc())
        {
          array_push($tournamentIds, $tourney["tournamentID"]);
          array_push($tournamentNames, $tourney["tournamentName"]);
          array_push($startDays, $tourney["startDay"]);
          array_push($startMonths, $tourney["startMonth"]);
          array_push($startYears, $tourney["startYear"]);
          array_push($endDays, $tourney["endDay"]);
          array_push($endMonths, $tourney["endMonth"]);
          array_push($endYears, $tourney["endYear"]);
          array_push($actualNumPlayers, $tourney["actualNumPlayers"]);
          array_push($registerOpenDays, $tourney["registerOpenDay"]);
          array_push($registerOpenMonths, $tourney["registerOpenMonth"]);
          array_push($registerOpenYears, $tourney["registerOpenYear"]);
          array_push($registerCloseDays, $tourney["registerCloseDay"]);
          array_push($registerCloseMonths, $tourney["registerCloseMonth"]);
          array_push($registerCloseYears, $tourney["registerCloseYear"]);
          array_push($paymentCloseDays, $tourney["paymentCloseDay"]);
          array_push($paymentCloseMonths, $tourney["paymentCloseMonth"]);
          array_push($paymentCloseYears, $tourney["paymentCloseYear"]);
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
      <h1 id="title">Tournaments</h1>
    </div>

    <div id="displayContainer">
      <form id="nameSearchForm" method="post" action="admin-view-tournaments.php">
        <input type="text" name="username" value="<?php echo $username; ?>" hidden>
        Search&nbsp;Tournament&nbsp;By:&nbsp;
        <input id="nameSearchInput" type="text" name="nameSearch" placeholder="Name" value="<?php echo $nameSearch; ?>">&nbsp;
        <input id="nameSearchSubmit" type="submit" value="Search">
        <span id="nameSearchResetContainer">&nbsp;<button id="nameSearchResetButton" onclick="document.getElementById('nameSearchInput').value = ''; return true;">Reset Search Filter</button></span>
      </form>

      <button id="addButton" onclick="document.getElementById('addSubmit').click()">Add Tournament</button>
      
      <div id="tournamentDisplayContainer">
        <table id="tournamentTable"></table>
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

    <form method="post" action="admin-add-tournament.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="addSubmit" type="submit">
    </form>

    <form method="post" action="admin-tournament-scoring.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="scoringTournamentId" type="number" name="tournamentID">
      <input id="scoringSubmit" type="submit">
    </form>

    <form method="post" action="admin-edit-tournament.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="viewTournamentId" type="number" name="tournamentID">
      <input id="viewSubmit" type="submit">
    </form>

    <form method="post" action="delete-tournament.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="deleteTournamentId" type="number" name="tournamentID">
      <input id="deleteSubmit" type="submit">
    </form>

    <!-- JS Code -->
    <script>
      if (document.getElementById("nameSearchInput").value == "")
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
                var tournaments = [];
                var tourney;";
        for ($i = 0; $i < count($tournamentIds); $i++)
        {
          echo "tourney = {};
                tourney[\"tournamentID\"] = \"", $tournamentIds[$i], "\";
                tourney[\"tournamentName\"] = \"", $tournamentNames[$i], "\";
                tourney[\"startDay\"] = \"", $startDays[$i], "\";
                tourney[\"startMonth\"] = ", $startMonths[$i], ";
                tourney[\"startYear\"] = ", $startYears[$i], ";
                tourney[\"endDay\"] = ", $endDays[$i], ";
                tourney[\"endMonth\"] = \"", $endMonths[$i], "\";
                tourney[\"endYear\"] = \"", $endYears[$i], "\";
                tourney[\"actualNumPlayers\"] = ", $actualNumPlayers[$i], ";
                tourney[\"registerOpenDay\"] = \"", $registerOpenDays[$i], "\";
                tourney[\"registerOpenMonth\"] = ", $registerOpenMonths[$i], ";
                tourney[\"registerOpenYear\"] = ", $registerOpenYears[$i], ";
                tourney[\"registerCloseDay\"] = \"", $registerCloseDays[$i], "\";
                tourney[\"registerCloseMonth\"] = ", $registerCloseMonths[$i], ";
                tourney[\"registerCloseYear\"] = ", $registerCloseYears[$i], ";
                tourney[\"paymentCloseDay\"] = \"", $paymentCloseDays[$i], "\";
                tourney[\"paymentCloseMonth\"] = ", $paymentCloseMonths[$i], ";
                tourney[\"paymentCloseYear\"] = ", $paymentCloseYears[$i], ";
                tournaments.push(tourney);";
        }
        echo   "displayTournaments(tournaments);
              </script>";
      }
    ?>
  </body>
</html>
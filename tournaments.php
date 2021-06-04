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
      function displayTournaments(tournaments)
      {
        var tableHtml = "";

        for (tourney of tournaments)
        {
          tableHtml += "<tr><td onclick=\"goToTournament(" + tourney["tournamentID"] + ")\">";
          tableHtml += "<span style=\"font-size: 20px;\"><b>" + tourney["tournamentName"] + "</b></span><br>";
          tableHtml += "Venue: " + tourney["venue"] + "<br>";
          tableHtml += "Date: " + tourney["startDay"] + "/" + tourney["startMonth"] + "/" + tourney["startYear"] + " - " + tourney["endDay"] + "/" + tourney["endMonth"] + "/" + tourney["endYear"] + "<br>";
          tableHtml += "Number of Participants: " + tourney["numPlayers"] + " players";
          tableHtml += "</td></tr>";
        }

        document.getElementById("tournamentTable").innerHTML = tableHtml;

        return;
      }

      function goToTournament(tournamentId)
      {
        document.getElementById("tournamentIdInput").value = tournamentId;
        document.getElementById("tournamentIdSubmit").click();

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

      td:hover
      {
        background-color: lightgrey;
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
      define("MAX_TOURNAMENTS", 20);
    ?>

    <!-- PHP Database Operations -->
    <?php
      include "connection.php";
      include "mysqlQueries.php";

      $conn = openConn();

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
      $venues = array();

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
        array_push($venues, $tourney["venue"]);
      }

      closeConn($conn);
    ?>

    <!-- User Interface -->
    <h1>Tournaments</h1>

    <div id="displayContainer">
      <form id="nameSearchForm" method="post" action="tournaments.php">
        <input type="text" name="username" value="<?php echo $username; ?>" hidden>
        Search&nbsp;Tournament&nbsp;By&nbsp;Name:&nbsp;
        <input id="nameSearchInput" type="text" name="nameSearch" placeholder="Name" value="<?php echo $nameSearch; ?>">&nbsp;
        <input id="nameSearchSubmit" type="submit" value="Search">
        <span id="nameSearchResetContainer">&nbsp;<button id="nameSearchResetButton" onclick="document.getElementById('nameSearchInput').value = ''; return true;">Reset Search Filter</button></span>
      </form>
      
      <div id="tournamentDisplayContainer">
        <table id="tournamentTable"></table>
      </div>
    </div>

    <!-- Hidden Forms -->
    <form method="get" action="view-tournament.php" hidden>
      <input id="tournamentIdInput" type="number" name="tournamentID">
      <input id="tournamentIdSubmit" type="submit">
    </form>

    <!-- PHP Outputs to JS Code -->
    <?php
      echo "<script>
              var latestTournaments = [];
              var tourney;";
      for ($i = 0; $i < count($tournamentIds); $i++)
      {
        echo "tourney = {};
              tourney[\"tournamentID\"] = \"", $tournamentIds[$i], "\";
              tourney[\"tournamentName\"] = \"", $tournamentNames[$i], "\";
              tourney[\"venue\"] = \"", $venues[$i], "\";
              tourney[\"startDay\"] = ", $startDays[$i], ";
              tourney[\"startMonth\"] = ", $startMonths[$i], ";
              tourney[\"startYear\"] = ", $startYears[$i], ";
              tourney[\"endDay\"] = ", $endDays[$i], ";
              tourney[\"endMonth\"] = ", $endMonths[$i], ";
              tourney[\"endYear\"] = ", $endYears[$i], ";
              tourney[\"numPlayers\"] = ", $actualNumPlayers[$i], ";
              latestTournaments.push(tourney);";
      }
      echo   "displayTournaments(latestTournaments);
            </script>";
    ?>
  </body>
</html>
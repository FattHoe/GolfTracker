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
        font-size: 15px;
      }

      td:hover
      {
        background-color: lightgrey;
      }

      #tournamentDisplayContainer
      {
        margin: 40px 0;
        position: absolute;
        left: 50%;
        -ms-transform: translate(-50%);
        transform: translate(-50%);
      }

      #tournamentTable
      {
        margin: 0;
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

      $conn = openConn();

      $latestTournaments = $conn->query(GET_LATEST_TOURNAMENTS);

      $tIds = array();
      $tNames = array();
      $tVenues = array();
      $tStartDays = array();
      $tStartMonths = array();
      $tStartYears = array();
      $tEndDays = array();
      $tEndMonths = array();
      $tEndYears = array();
      $tNumPlayers = array();

      $numTournaments = $latestTournaments->num_rows;
      if ($numTournaments > MAX_TOURNAMENTS)
      {
        $numTournaments = MAX_TOURNAMENTS;
      }

      for ($i = 0; $i < $numTournaments; $i++)
      {
        $tourney = $latestTournaments->fetch_assoc();
        array_push($tIds, $tourney["tournamentID"]);
        array_push($tNames, $tourney["tournamentName"]);
        array_push($tVenues, $tourney["venue"]);
        array_push($tStartDays, $tourney["startDay"]);
        array_push($tStartMonths, $tourney["startMonth"]);
        array_push($tStartYears, $tourney["startYear"]);
        array_push($tEndDays, $tourney["endDay"]);
        array_push($tEndMonths, $tourney["endMonth"]);
        array_push($tEndYears, $tourney["endYear"]);
        array_push($tNumPlayers, $tourney["numPlayers"]);
      }

      closeConn($conn);
    ?>

    <!-- User Interface -->
    <div id="tournamentDisplayContainer">
      <table id="tournamentTable"></table>
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
      for ($i = 0; $i < $numTournaments; $i++)
      {
        echo "tourney = {};
              tourney[\"tournamentID\"] = \"", $tIds[$i], "\";
              tourney[\"tournamentName\"] = \"", $tNames[$i], "\";
              tourney[\"venue\"] = \"", $tVenues[$i], "\";
              tourney[\"startDay\"] = ", $tStartDays[$i], ";
              tourney[\"startMonth\"] = ", $tStartMonths[$i], ";
              tourney[\"startYear\"] = ", $tStartYears[$i], ";
              tourney[\"endDay\"] = ", $tEndDays[$i], ";
              tourney[\"endMonth\"] = ", $tEndMonths[$i], ";
              tourney[\"endYear\"] = ", $tEndYears[$i], ";
              tourney[\"numPlayers\"] = ", $tNumPlayers[$i], ";
              latestTournaments.push(tourney);";
      }
      echo   "displayTournaments(latestTournaments);
            </script>";
    ?>
  </body>
</html>
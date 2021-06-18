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
      function displayTournament(tournament)
      {
        document.getElementById("tournamentName").innerHTML = tournament["tournamentName"];

        document.getElementById("tournamentDetails").innerHTML = 
          "Venue: " + tournament["venue"] + "<br>" +
          "Date: " + tournament["startDay"] + "/" + tournament["startMonth"] + "/" + tournament["startYear"] +
          " - " + tournament["endDay"] + "/" + tournament["endMonth"] + "/" + tournament["endYear"];

        return;
      }
    </script>

    <!-- CSS Style Definitions -->
    <style media="screen">
    </style>
  </head>

  <body>
    <!-- PHP Database Operations -->
    <?php
      include "connection.php";
      include "mysqlQueries.php";
      include "validateInput.php";

      $conn = openConn();

      $tournamentId = "";
      $tournamentFound = false;

      if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["tournamentID"])
      {
        $tournamentId = (int)validateInput($_GET["tournamentID"]);
        $tournamentQuery = $conn->query(sprintf(GET_TOURNAMENT_BY_ID, $tournamentId));

        if ($tournamentQuery->num_rows == 1)
        {
          $tournamentFound = true;
          $tournament = $tournamentQuery->fetch_assoc();

          $players = [];
          $categories = [];
          $scoresFound = true;
          $roundNumber = 1;

          while ($scoresFound)
          {
            $scoresQuery = $conn->query(sprintf(GET_PLAYER_SCORES_BY_TOURNAMENT_ID_AND_ROUND_NUMBER, $tournamentId, $roundNumber));

            if ($scoresQuery->num_rows > 0)
            {
              while ($score = $scoresQuery->fetch_assoc())
              {
                if (!array_key_exists($score["playerID"], $players))
                {
                  $players[$score["playerID"]] = [];
                  $players[$score["playerID"]]["firstName"] = $score["firstName"];
                  $players[$score["playerID"]]["lastName"] = $score["lastName"];
                  $players[$score["playerID"]]["categoryID"] = $score["categoryID"];

                  if (!array_key_exists($score["categoryID"], $categories))
                  {
                    $categories[$score["categoryID"]] = $score["ageGroupCode"];
                  }
                  
                  $players[$score["playerID"]]["handicap"] = $score["handicap"];
                  $players[$score["playerID"]]["holesPlayed"] = $score["holesPlayed"];
                  $players[$score["playerID"]]["noScoreCode"] = $score["noScoreCode"];
                  $players[$score["playerID"]]["roundScores"] = [];
                }
                $players[$score["playerID"]]["roundScores"][] = $score["gross18"];
              }
            }
            else
            {
              $scoresFound = false;
            }

            $roundNumber++;
          }
        }
      }

      closeConn($conn);
    ?>

    <!-- User Interface -->
    <div id="tournamentInfo">
      <h1 id="tournamentName"></h1>
      <p id="tournamentDetails"></p>
    </div>
    <div id="leaderboard"></div>

    <!-- PHP Outputs to JS Code -->
    <?php
      if ($tournamentFound)
      {
        echo "<script>
                var tourney = {};
                tourney[\"tournamentName\"] = \"", $tournament["tournamentName"], "\";
                tourney[\"venue\"] = \"", $tournament["venue"], "\";
                tourney[\"startDay\"] = ", $tournament["startDay"], ";
                tourney[\"startMonth\"] = ", $tournament["startMonth"], ";
                tourney[\"startYear\"] = ", $tournament["startYear"], ";
                tourney[\"endDay\"] = ", $tournament["endDay"], ";
                tourney[\"endMonth\"] = ", $tournament["endMonth"], ";
                tourney[\"endYear\"] = ", $tournament["endYear"], ";
                displayTournament(tourney);
                var players = [];
                var player;";
        
        foreach ($players as $player)
        {
          echo "player = {};
                player[\"firstName\"] = \"", $player["firstName"], "\";
                player[\"lastName\"] = \"", $player["lastName"], "\";
                player[\"categoryID\"] = \"", $player["categoryID"], "\";
                player[\"handicap\"] = \"", $player["handicap"], "\";
                player[\"holesPlayed\"] = \"", $player["holesPlayed"], "\";";
          
          if ($player["noScoreCode"] == NULL)
          {
            echo "player[\"noScoreCode\"] = \"\";";
          }
          else
          {
            echo "player[\"noScoreCode\"] = \"", $player["noScoreCode"], "\";";
          }

          echo "player[\"roundScores\"] = [];";
          
          foreach ($player["roundScores"] as $roundScore)
          {
            if ($roundScore == NULL)
            {
              echo "player[\"roundScores\"].push(0);";
            }
            else
            {
              echo "player[\"roundScores\"].push(", $roundScore, ");";
            }
          }

          echo "players.push(player);";
        }

        echo "var categories = {};";
        foreach (array_keys($categories) as $categotyId)
        {
          echo "categories[", $categotyId, "] = \"", $categories[$categotyId], "\";";
        }

        echo "console.log(players);
              console.log(categories);</script>"; // do something with these JS objects. num rounds as field?
      }
      else
      {
        echo "<script>
                window.alert(\"Tournament Not Found.\");
                window.location.href = 'tournaments.php';
              </script>";
      }
    ?>
  </body>
</html>
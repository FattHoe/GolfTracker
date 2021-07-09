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

      function displayLeaderboard(players, categories)
      {
        var leaderboardHtml = "";
        var categoryKeys = Object.keys(categories);

        for (var i = 0; i < categoryKeys.length; i++)
        {
          leaderboardHtml += "<h2>" + categories[categoryKeys[i]]["ageGroup"] + "</h2>";
          leaderboardHtml += "<table><tr><th>#</th><th>Player</th>";
          
          var numRounds = categories[categoryKeys[i]]["numRounds"];
          for (var j = 1; j <= numRounds; j++)
          {
            leaderboardHtml += "<th>R" + j + "</th>";
          }
          leaderboardHtml += "<th>Total</th></tr>";

          var totalPar = categories[categoryKeys[i]]["totalPar"];
          var sortedPlayers = sortPlayersOnScore(players, categoryKeys[i], totalPar);

          for (var k = 0; k < sortedPlayers.length; k++)
          {
            leaderboardHtml += "<tr><td>" + (k + 1) + "</td><td>" + sortedPlayers[k]["lastName"] + ", " + sortedPlayers[k]["firstName"] + "</td>";
            
            var roundScores = sortedPlayers[k]["roundScores"];
            var totalScore = 0;
            var totalScoreToPar = 0;
            for (var m = 0; m < numRounds; m++)
            {
              if (m < roundScores.length)
              {
                leaderboardHtml += "<td>" + roundScores[m] + "(" + (roundScores[m] - totalPar) + ")</td>";
                totalScore += roundScores[m];
                totalScoreToPar += roundScores[m] - totalPar;
              }
              else
              {
                leaderboardHtml += "<td></td>";
              }
            }

            leaderboardHtml += "<td>" + totalScore + "(" + totalScoreToPar + ")</td></tr>";
          }

          leaderboardHtml += "</table><br>";
        }

        document.getElementById("leaderboard").innerHTML = leaderboardHtml;
      }

      function sortPlayersOnScore(players, categoryId, totalPar)
      {
        var extractedPlayers = [];

        for (var i = 0; i < players.length; i++)
        {
          if (players[i]["categoryID"] == categoryId)
          {
            var totalScoreToPar = 0;

            for (var j = 0; j < players[i]["roundScores"].length; j++)
            {
              totalScoreToPar += players[i]["roundScores"][j] - totalPar;
            }
            players[i]["totalScoreToPar"] = totalScoreToPar;
            extractedPlayers.push(players[i]);
          }
        }

        var sortedPlayers = extractedPlayers.sort((lhs, rhs) =>
        {
          if (lhs["totalScoreToPar"] < rhs["totalScoreToPar"])
          {
            return -1;
          }
          if (lhs["totalScoreToPar"] > rhs["totalScoreToPar"])
          {
            return 1;
          }
          if (lhs["holesPlayed"] < rhs["holesPlayed"])
          {
            return -1;
          }
          if (lhs["holesPlayed"] > rhs["holesPlayed"])
          {
            return 1;
          }
          return 0;
        });

        return sortedPlayers;
      }
    </script>

    <!-- CSS Style Definitions -->
    <style media="screen">
      table
      {
        border-collapse: collapse;
      }

      th, td
      {
        border: solid black 1px;
        padding: 5px;
        text-align: center;
      }
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
                    $categories[$score["categoryID"]] = [];
                    $categories[$score["categoryID"]]["ageGroup"] = $score["ageGroupCode"];
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

          foreach (array_keys($categories) as $categoryId)
          {
            $scorecardQuery = $conn->query(sprintf(GET_NUM_ROUNDS_AND_TOTAL_PAR_BY_TOURNAMENT_ID_AND_CATEGORY_ID, $tournamentId, (int)$categoryId));
            if ($scorecardQuery->num_rows == 1)
            {
              $scorecard = $scorecardQuery->fetch_assoc();
              $categories[$categoryId]["numRounds"] = $scorecard["numRounds"];
              $categories[$categoryId]["totalPar"] = $scorecard["totalPar"];
            }
            else
            {
              $categories[$categoryId]["numRounds"] = "0";
              $categories[$categoryId]["totalPar"] = "0";
            }
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
        foreach (array_keys($categories) as $categoryId)
        {
          echo "categories[", $categoryId, "] = {\"ageGroup\": \"", $categories[$categoryId]["ageGroup"], "\", \"numRounds\": ", $categories[$categoryId]["numRounds"],", \"totalPar\": ", $categories[$categoryId]["totalPar"],"};";
        }

        echo "displayLeaderboard(players, categories);</script>";
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
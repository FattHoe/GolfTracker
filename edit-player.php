<!DOCTYPE html>
<html lang="en-US">
  <body>
    <!-- PHP Database Operations -->
    <?php
      include "connection.php";
      include "validateInput.php";
      include "mysqlQueries.php";

      $conn = openConn();
      
      $authenticated = false;
      $username = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        $playerId = (int)validateInput($_POST["playerID"]);
        $firstName = validateInput($_POST["firstName"]);
        $lastName = validateInput($_POST["lastName"]);
        $idOption = validateInput($_POST["idOption"]);
        $idNumber = validateInput($_POST["idNumber"]);

        $dateOfBirth = validateInput($_POST["dateOfBirth"]);
        $dobList = explode("-", $dateOfBirth);
        $yearOfBirth = (int)$dobList[0];
        $monthOfBirth = (int)$dobList[1];
        $dayOfBirth = (int)$dobList[2];

        $gender = validateInput($_POST["gender"]);
        $homeAddress = validateInput($_POST["homeAddress"]);
        $country = validateInput($_POST["country"]);
        $email = validateInput($_POST["email"]);
        $mobileNumber = validateInput($_POST["mobileNumber"]);
        $handicap = validateInput($_POST["handicap"]);
        $nhsNumber = validateInput($_POST["nhsNumber"]);
        $homeClub = validateInput($_POST["homeClub"]);
        $guardianName = validateInput($_POST["guardianName"]);
        $guardianMobileNumber = validateInput($_POST["guardianMobileNumber"]);
        $tShirtSize = validateInput($_POST["tShirtSize"]);
        $tShirtCut = validateInput($_POST["tShirtCut"]);

        $lastUpdatedDate = validateInput($_POST["lastUpdatedDate"]);
        $ludList = explode("-", $lastUpdatedDate);
        $lastUpdatedYear = (int)$ludList[0];
        $lastUpdatedMonth = (int)$ludList[1];
        $lastUpdatedDay = (int)$ludList[2];

        $query = $conn->query(sprintf(EDIT_PLAYER, $firstName, $lastName, $dayOfBirth, $monthOfBirth, $yearOfBirth, $gender, $country, $email, $guardianName, $guardianMobileNumber, $lastUpdatedDay, $lastUpdatedMonth, $lastUpdatedYear, $playerId));

        if ($idOption == "M")
        {
          $conn->query(sprintf(EDIT_PLAYER_MYKAD, $idNumber, $playerId));
        }
        else if ($idOption == "P")
        {
          $conn->query(sprintf(EDIT_PLAYER_PASSPORT, $idNumber, $playerId));
        }

        if ($homeAddress)
        {
          $conn->query(sprintf(EDIT_PLAYER_ADDRESS, $homeAddress, $playerId));
        }

        if ($mobileNumber)
        {
          $conn->query(sprintf(EDIT_PLAYER_MOBILE, $mobileNumber, $playerId));
        }

        if ($nhsNumber)
        {
          $conn->query(sprintf(EDIT_PLAYER_HANDICAP, (float)$handicap, (int)$nhsNumber, $playerId));
        }

        if ($homeClub)
        {
          $conn->query(sprintf(EDIT_PLAYER_CLUB, $homeClub, $playerId));
        }

        if ($tShirtSize)
        {
          $conn->query(sprintf(EDIT_PLAYER_TSHIRT, $tShirtSize, $tShirtCut, $playerId));
        }
      }

      closeConn($conn);
    ?>

    <!-- Hidden Forms -->
    <form method="post" action="admin-edit-player.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input type="number" name="playerID" value="<?php echo $playerId; ?>">
      <input id="editSubmit" type="submit">
    </form>

    <!-- PHP Outputs to JS Code -->
    <?php
      if (!$authenticated)
      {
        echo "<script>
                window.location.href = \"admin-sign-in.php\";
              </script>";
      }
      else if ($query)
      {
        echo "<script>
                window.alert(\"Player updated successfully!\");
                document.getElementById(\"editSubmit\").click();
              </script>";
      }
      else
      {
        echo "<script>
                window.alert(\"Failed to update player! Please refresh the page and try again!\");
                document.getElementById(\"editSubmit\").click();
              </script>";
      }
    ?>
  </body>
</html>
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
      $player = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        $firstName = validateInput($_POST["firstName"]);
        $lastName = validateInput($_POST["lastName"]);
        $idOption = validateInput($_POST["idOption"]);
        $idNumber = validateInput($_POST["idNumber"]);
        $dateOfBirth = validateInput($_POST["dateOfBirth"]);
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

        $query = $conn->query(sprintf(GET_PLAYERS_BY_NAME_SEARCH, strtolower($firstName), strtolower($lastName)));

        if ($query->num_rows > 0)
        {
          $player = $query->fetch_assoc();
        }
      }

      closeConn($conn);
    ?>

    <!-- Hidden Forms -->
    <form method="post" action="add-player.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input type="text" name="firstName" value="<?php echo $firstName; ?>">
      <input type="text" name="lastName" value="<?php echo $lastName; ?>">
      <input type="text" name="idOption" value="<?php echo $idOption; ?>">
      <input type="text" name="idNumber" value="<?php echo $idNumber; ?>">
      <input type="text" name="dateOfBirth" value="<?php echo $dateOfBirth; ?>">
      <input type="text" name="gender" value="<?php echo $gender; ?>">
      <input type="text" name="homeAddress" value="<?php echo $homeAddress; ?>">
      <input type="text" name="country" value="<?php echo $country; ?>">
      <input type="text" name="email" value="<?php echo $email; ?>">
      <input type="text" name="mobileNumber" value="<?php echo $mobileNumber; ?>">
      <input type="text" name="handicap" value="<?php echo $handicap; ?>">
      <input type="text" name="nhsNumber" value="<?php echo $nhsNumber; ?>">
      <input type="text" name="homeClub" value="<?php echo $homeClub; ?>">
      <input type="text" name="guardianName" value="<?php echo $guardianName; ?>">
      <input type="text" name="guardianMobileNumber" value="<?php echo $guardianMobileNumber; ?>">
      <input type="text" name="tShirtSize" value="<?php echo $tShirtSize; ?>">
      <input type="text" name="tShirtCut" value="<?php echo $tShirtCut; ?>">
      <input type="text" name="lastUpdatedDate" value="<?php echo $lastUpdatedDate; ?>">
      <input id="checkSubmit" type="submit">
    </form>

    <form method="post" action="admin-add-player.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input type="text" name="firstName" value="<?php echo $firstName; ?>">
      <input type="text" name="lastName" value="<?php echo $lastName; ?>">
      <input type="text" name="idOption" value="<?php echo $idOption; ?>">
      <input type="text" name="idNumber" value="<?php echo $idNumber; ?>">
      <input type="text" name="dateOfBirth" value="<?php echo $dateOfBirth; ?>">
      <input type="text" name="gender" value="<?php echo $gender; ?>">
      <input type="text" name="homeAddress" value="<?php echo $homeAddress; ?>">
      <input type="text" name="country" value="<?php echo $country; ?>">
      <input type="text" name="email" value="<?php echo $email; ?>">
      <input type="text" name="mobileNumber" value="<?php echo $mobileNumber; ?>">
      <input type="text" name="handicap" value="<?php echo $handicap; ?>">
      <input type="text" name="nhsNumber" value="<?php echo $nhsNumber; ?>">
      <input type="text" name="homeClub" value="<?php echo $homeClub; ?>">
      <input type="text" name="guardianName" value="<?php echo $guardianName; ?>">
      <input type="text" name="guardianMobileNumber" value="<?php echo $guardianMobileNumber; ?>">
      <input type="text" name="tShirtSize" value="<?php echo $tShirtSize; ?>">
      <input type="text" name="tShirtCut" value="<?php echo $tShirtCut; ?>">
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
      else if ($player)
      {
        echo "<script>
                if (window.confirm(\"Possible player duplication found in database with the player name: \\\"", $player["firstName"], " ", $player["lastName"], "\\\". Do you still want to add player \\\"", $firstName, " ", $lastName, "\\\"?\"))
                {
                  document.getElementById(\"checkSubmit\").click();
                }
                else
                {
                  document.getElementById(\"cancelSubmit\").click();
                }
              </script>";
      }
      else
      {
        echo "<script>
                document.getElementById(\"checkSubmit\").click();
              </script>";
      }
    ?>
  </body>
</html>
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
      $invalid = "";
      $username = "";
      $password = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"] && $_POST["password"])
      {
        $username = validateInput($_POST["username"]);
        $password = validateInput($_POST["password"]);

        $adminAccount = $conn->query(sprintf(GET_ADMIN_PASSWORD, $username));

        if ($adminAccount->num_rows == 1)
        {
          $acc = $adminAccount->fetch_assoc();
          
          if ($acc["adminPassword"] == $password)
          {
            $authenticated = true;
          }
          else
          {
            $invalid = "password";
          }
        }
        else
        {
          $invalid = "username";
        }
      }

      closeConn($conn);
    ?>

    <!-- Hidden Forms -->
    <form method="post" action="admin-navigation.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="adminSubmit" type="submit">
    </form>
    <form method="post" action="admin-sign-in.php" hidden>
      <input type="text" name="invalid" value="<?php echo $invalid; ?>">
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input type="text" name="password" value="<?php echo $password; ?>">
      <input id="invalidSubmit" type="submit">
    </form>

    <!-- PHP Outputs to JS Code -->
    <?php
      echo "<script>";
      if ($authenticated)
      {
        echo "document.getElementById(\"adminSubmit\").click();";
      }
      else
      {
        echo "document.getElementById(\"invalidSubmit\").click();";
      }
      echo "</script>";
    ?>
  </body>
</html>
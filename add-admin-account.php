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
      $newUsername = "";
      $newPassword = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"] && $_POST["newUsername"] && $_POST["newPassword"])
      {
        $username = validateInput($_POST["username"]);
        $newUsername = validateInput($_POST["newUsername"]);
        $newPassword = validateInput($_POST["newPassword"]);
        $authenticated = true;
        $usernameTaken = true;
        
        $query = $conn->query(sprintf(FIND_ADMIN_ACCOUNT, $newUsername));

        if ($query->num_rows == 0)
        {
          $usernameTaken = false;
          $query = $conn->query(sprintf(ADD_ADMIN_ACCOUNT, $newUsername, $newPassword));
        }
      }

      closeConn($conn);
    ?>

    <!-- Hidden Forms -->
    <form method="post" action="admin-add-admin.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input type="text" name="newUsername" value="<?php echo $newUsername; ?>">
      <input type="text" name="newPassword" value="<?php echo $newPassword; ?>">
      <input id="usernameTakenSubmit" type="submit">
    </form>

    <form method="post" action="admin-navigation.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="homeSubmit" type="submit">
    </form>

    <form method="post" action="admin-add-admin.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="addAdminSubmit" type="submit">
    </form>

    <!-- PHP Outputs to JS Code -->
    <?php
      if (!$authenticated)
      {
        echo "<script>
                window.location.href = \"admin-sign-in.php\";
              </script>";
      }
      else if ($usernameTaken)
      {
        echo "<script>
                document.getElementById(\"usernameTakenSubmit\").click();
              </script>";
      }
      else if ($query)
      {
        echo "<script>
                window.alert(\"New administrator with username \\\"", $newUsername, "\\\" added successfully!\");
                document.getElementById(\"homeSubmit\").click();
              </script>";
      }
      else
      {
        echo "<script>
                window.alert(\"New administrator failed to be added! Please refresh the page and try again!\");
                document.getElementById(\"addAdminSubmit\").click();
              </script>";
      }
    ?>
  </body>
</html>
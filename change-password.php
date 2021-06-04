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

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"] && $_POST["password"])
      {
        $username = validateInput($_POST["username"]);
        $password = validateInput($_POST["password"]);
        $authenticated = true;
        
        $query = $conn->query(sprintf(CHANGE_ADMIN_PASSWORD, $password, $username));
      }

      closeConn($conn);
    ?>

    <!-- Hidden Forms -->
    <form method="post" action="admin-navigation.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="homeSubmit" type="submit">
    </form>
    
    <form method="post" action="admin-password-change.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="passwordChangeSubmit" type="submit">
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
                window.alert(\"Password changed successfully!\");
                document.getElementById(\"homeSubmit\").click();
              </script>";
      }
      else
      {
        echo "<script>
                window.alert(\"Password change failed! Please refresh the page and try again!\");
                document.getElementById(\"passwordChangeSubmit\").click();
              </script>";
      }
    ?>
  </body>
</html>
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
      $numAffectedRows = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        $courseId = (int)validateInput($_POST["courseID"]);

        $conn->query(sprintf(DELETE_YARDAGES, $courseId));
        $conn->query(sprintf(DELETE_TEEBOXES, $courseId));
        $conn->query(sprintf(DELETE_COURSE, $courseId));
        $numAffectedRows = $conn->affected_rows;
      }

      closeConn($conn);
    ?>

    <!-- Hidden Forms -->
    <form method="post" action="admin-view-courses.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="deleteSubmit" type="submit">
    </form>

    <!-- PHP Outputs to JS Code -->
    <?php
      if (!$authenticated)
      {
        echo "<script>
                window.location.href = \"admin-sign-in.php\";
              </script>";
      }
      else if ($numAffectedRows == 1)
      {
        echo "<script>
                window.alert(\"Golf course deleted successfully!\");
                document.getElementById(\"deleteSubmit\").click();
              </script>";
      }
      else
      {
        echo "<script>
                window.alert(\"Failed to delete golf course! Please refresh the page and try again!\");
                document.getElementById(\"deleteSubmit\").click();
              </script>";
      }
    ?>
  </body>
</html>
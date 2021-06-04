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

        $catId = (int)validateInput($_POST["categoryID"]);
        $ageGroupCode = validateInput($_POST["ageGroupCode"]);
        $gender = validateInput($_POST["gender"]);
        $minAge = (int)validateInput($_POST["minAge"]);
        $maxAge = (int)validateInput($_POST["maxAge"]);

        $query = $conn->query(sprintf(EDIT_CATEGORY, $ageGroupCode, $gender, $minAge, $maxAge, $catId));
      }

      closeConn($conn);
    ?>

    <!-- Hidden Forms -->
    <form method="post" action="admin-edit-category.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input type="number" name="categoryID" value="<?php echo $catId; ?>">
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
                window.alert(\"Category updated successfully!\");
                document.getElementById(\"editSubmit\").click();
              </script>";
      }
      else
      {
        echo "<script>
                window.alert(\"Failed to update category! Please refresh the page and try again!\");
                document.getElementById(\"editSubmit\").click();
              </script>";
      }
    ?>
  </body>
</html>
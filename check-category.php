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
      $cat = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        $ageGroupCode = validateInput($_POST["ageGroupCode"]);
        $gender = validateInput($_POST["gender"]);
        $minAge = validateInput($_POST["minAge"]);
        $maxAge = validateInput($_POST["maxAge"]);

        $query = $conn->query(sprintf(GET_CATEGORIES_BY_NAME_SEARCH, $ageGroupCode));

        if ($query->num_rows > 0)
        {
          $cat = $query->fetch_assoc();
        }
      }

      closeConn($conn);
    ?>

    <!-- Hidden Forms -->
    <form method="post" action="add-category.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input type="text" name="ageGroupCode" value="<?php echo $ageGroupCode; ?>">
      <input type="text" name="gender" value="<?php echo $gender; ?>">
      <input type="number" name="minAge" value="<?php echo $minAge; ?>">
      <input type="number" name="maxAge" value="<?php echo $maxAge; ?>">
      <input id="checkSubmit" type="submit">
    </form>

    <form method="post" action="admin-add-category.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input type="text" name="ageGroupCode" value="<?php echo $ageGroupCode; ?>">
      <input type="text" name="gender" value="<?php echo $gender; ?>">
      <input type="number" name="minAge" value="<?php echo $minAge; ?>">
      <input type="number" name="maxAge" value="<?php echo $maxAge; ?>">
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
      else if ($cat)
      {
        echo "<script>
                if (window.confirm(\"Possible category duplication found in database with the category name code: \\\"", $cat["ageGroupCode"], "\\\". Do you still want to add category?\"))
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
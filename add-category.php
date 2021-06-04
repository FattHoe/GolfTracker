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
      $query = false;

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        $ageGroupCode = validateInput($_POST["ageGroupCode"]);
        $gender = validateInput($_POST["gender"]);
        $minAge = (int)validateInput($_POST["minAge"]);
        $maxAge = (int)validateInput($_POST["maxAge"]);

        $query = $conn->query(sprintf(ADD_CATEGORY, $ageGroupCode, $gender, $minAge, $maxAge));
      }

      if ($query)
      {
        $catAdded = $conn->query(GET_LAST_CATEGORY_ADDED);
        $cat = $catAdded->fetch_assoc();
        $catId = $cat["categoryID"];
      }

      closeConn($conn);
    ?>

    <!-- Hidden Forms -->
    <form method="post" action="admin-add-category.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="addSubmit" type="submit">
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
                window.alert(\"Category added successfully with Category ID: ", $catId, "\");
                document.getElementById(\"addSubmit\").click();
              </script>";
      }
      else
      {
        echo "<script>
                window.alert(\"Failed to add category! Please refresh the page and try again!\");
                document.getElementById(\"addSubmit\").click();
              </script>";
      }
    ?>
  </body>
</html>
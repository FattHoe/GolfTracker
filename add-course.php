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

        $clubName = validateInput($_POST["clubName"]);
        $courseName = validateInput($_POST["courseName"]);
        $stateLocation = validateInput($_POST["stateLocation"]);
        $countryLocation = validateInput($_POST["countryLocation"]);
        $numHoles = (int)validateInput($_POST["numHoles"]);
        $yardageUnits = validateInput($_POST["yardageUnits"]);
        $numTeeBoxes = (int)validateInput($_POST["numTeeBoxes"]);
        $par1 = validateInput($_POST["par1"]);
        $par2 = validateInput($_POST["par2"]);
        $par3 = validateInput($_POST["par3"]);
        $par4 = validateInput($_POST["par4"]);
        $par5 = validateInput($_POST["par5"]);
        $par6 = validateInput($_POST["par6"]);
        $par7 = validateInput($_POST["par7"]);
        $par8 = validateInput($_POST["par8"]);
        $par9 = validateInput($_POST["par9"]);
        $par10 = validateInput($_POST["par10"]);
        $par11 = validateInput($_POST["par11"]);
        $par12 = validateInput($_POST["par12"]);
        $par13 = validateInput($_POST["par13"]);
        $par14 = validateInput($_POST["par14"]);
        $par15 = validateInput($_POST["par15"]);
        $par16 = validateInput($_POST["par16"]);
        $par17 = validateInput($_POST["par17"]);
        $par18 = validateInput($_POST["par18"]);

        $colour = array();
        $distance1 = array();
        $distance2 = array();
        $distance3 = array();
        $distance4 = array();
        $distance5 = array();
        $distance6 = array();
        $distance7 = array();
        $distance8 = array();
        $distance9 = array();
        $distance10 = array();
        $distance11 = array();
        $distance12 = array();
        $distance13 = array();
        $distance14 = array();
        $distance15 = array();
        $distance16 = array();
        $distance17 = array();
        $distance18 = array();

        for ($i = 1; $i <= $numTeeBoxes; $i++)
        {
          array_push($colour, $_POST["colour_" . strval($i)]);
          array_push($distance1, $_POST["distance1_" . strval($i)]);
          array_push($distance2, $_POST["distance2_" . strval($i)]);
          array_push($distance3, $_POST["distance3_" . strval($i)]);
          array_push($distance4, $_POST["distance4_" . strval($i)]);
          array_push($distance5, $_POST["distance5_" . strval($i)]);
          array_push($distance6, $_POST["distance6_" . strval($i)]);
          array_push($distance7, $_POST["distance7_" . strval($i)]);
          array_push($distance8, $_POST["distance8_" . strval($i)]);
          array_push($distance9, $_POST["distance9_" . strval($i)]);
          array_push($distance10, $_POST["distance10_" . strval($i)]);
          array_push($distance11, $_POST["distance11_" . strval($i)]);
          array_push($distance12, $_POST["distance12_" . strval($i)]);
          array_push($distance13, $_POST["distance13_" . strval($i)]);
          array_push($distance14, $_POST["distance14_" . strval($i)]);
          array_push($distance15, $_POST["distance15_" . strval($i)]);
          array_push($distance16, $_POST["distance16_" . strval($i)]);
          array_push($distance17, $_POST["distance17_" . strval($i)]);
          array_push($distance18, $_POST["distance18_" . strval($i)]);
        }

        if ($numHoles == 9)
        {
          $query = $conn->query(sprintf(ADD_9HOLE_COURSE, $clubName, $stateLocation, $countryLocation, $yardageUnits, $par1, $par2, $par3, $par4, $par5, $par6, $par7, $par8, $par9));
        }
        else
        {
          $query = $conn->query(sprintf(ADD_18HOLE_COURSE, $clubName, $stateLocation, $countryLocation, $yardageUnits, $par1, $par2, $par3, $par4, $par5, $par6, $par7, $par8, $par9, $par10, $par11, $par12, $par13, $par14, $par15, $par16, $par17, $par18));
        }

        if ($query)
        {
          $courseAdded = $conn->query(GET_LAST_COURSE_ADDED);
          $course = $courseAdded->fetch_assoc();
          $courseId = $course["courseID"];

          if ($courseName)
          {
            $conn->query(sprintf(EDIT_COURSE_COURSENAME, $courseName, $courseId));
          }

          for ($i = 0; $i < $numTeeBoxes; $i++)
          {
            if ($numHoles == 9)
            {
              $query = $conn->query(sprintf(ADD_9HOLE_YARDAGE, $distance1[$i], $distance2[$i], $distance3[$i], $distance4[$i], $distance5[$i], $distance6[$i], $distance7[$i], $distance8[$i], $distance9[$i]));
            }
            else
            {
              $query = $conn->query(sprintf(ADD_18HOLE_YARDAGE, $distance1[$i], $distance2[$i], $distance3[$i], $distance4[$i], $distance5[$i], $distance6[$i], $distance7[$i], $distance8[$i], $distance9[$i], $distance10[$i], $distance11[$i], $distance12[$i], $distance13[$i], $distance14[$i], $distance15[$i], $distance16[$i], $distance17[$i], $distance18[$i]));
            }

            if ($query)
            {
              $yardageAdded = $conn->query(GET_LAST_YARDAGE_ADDED);
              $yardage = $yardageAdded->fetch_assoc();
              $yardageId = $yardage["yardageID"];

              $query = $conn->query(sprintf(ADD_TEEBOX, $courseId, $yardageId, $colour[$i]));
            }
          }
        }
      }

      closeConn($conn);
    ?>

    <!-- Hidden Forms -->
    <form method="post" action="admin-add-course.php" hidden>
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
                window.alert(\"Course added successfully with Course ID: ", $courseId, "\");
                document.getElementById(\"addSubmit\").click();
              </script>";
      }
      else
      {
        echo "<script>
                window.alert(\"Failed to add course! Please refresh the page and try again!\");
                document.getElementById(\"addSubmit\").click();
              </script>";
      }
    ?>
  </body>
</html>
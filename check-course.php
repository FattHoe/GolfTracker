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
      $course = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        $clubName = validateInput($_POST["clubName"]);
        $courseName = validateInput($_POST["courseName"]);
        $stateLocation = validateInput($_POST["stateLocation"]);
        $countryLocation = validateInput($_POST["countryLocation"]);
        $numHoles = validateInput($_POST["numHoles"]);
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

        $query = $conn->query(sprintf(GET_COURSES_BY_NAME_SEARCH, strtolower($clubName), strtolower($courseName), 1));

        if ($query->num_rows > 0)
        {
          $course = $query->fetch_assoc();
        }
      }

      closeConn($conn);
    ?>

    <!-- Hidden Forms -->
    <form method="post" action="add-course.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input type="text" name="clubName" value="<?php echo $clubName; ?>">
      <input type="text" name="courseName" value="<?php echo $courseName; ?>">
      <input type="text" name="stateLocation" value="<?php echo $stateLocation; ?>">
      <input type="text" name="countryLocation" value="<?php echo $countryLocation; ?>">
      <input type="text" name="numHoles" value="<?php echo $numHoles; ?>">
      <input type="text" name="yardageUnits" value="<?php echo $yardageUnits; ?>">
      <input type="text" name="numTeeBoxes" value="<?php echo $numTeeBoxes; ?>">
      <input type="text" name="par1" value="<?php echo $par1; ?>">
      <input type="text" name="par2" value="<?php echo $par2; ?>">
      <input type="text" name="par3" value="<?php echo $par3; ?>">
      <input type="text" name="par4" value="<?php echo $par4; ?>">
      <input type="text" name="par5" value="<?php echo $par5; ?>">
      <input type="text" name="par6" value="<?php echo $par6; ?>">
      <input type="text" name="par7" value="<?php echo $par7; ?>">
      <input type="text" name="par8" value="<?php echo $par8; ?>">
      <input type="text" name="par9" value="<?php echo $par9; ?>">
      <input type="text" name="par10" value="<?php echo $par10; ?>">
      <input type="text" name="par11" value="<?php echo $par11; ?>">
      <input type="text" name="par12" value="<?php echo $par12; ?>">
      <input type="text" name="par13" value="<?php echo $par13; ?>">
      <input type="text" name="par14" value="<?php echo $par14; ?>">
      <input type="text" name="par15" value="<?php echo $par15; ?>">
      <input type="text" name="par16" value="<?php echo $par16; ?>">
      <input type="text" name="par17" value="<?php echo $par17; ?>">
      <input type="text" name="par18" value="<?php echo $par18; ?>">
      <div id="checkInputs"></div>
      <input id="checkSubmit" type="submit">
    </form>

    <form method="post" action="admin-add-course.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input type="text" name="clubName" value="<?php echo $clubName; ?>">
      <input type="text" name="courseName" value="<?php echo $courseName; ?>">
      <input type="text" name="stateLocation" value="<?php echo $stateLocation; ?>">
      <input type="text" name="countryLocation" value="<?php echo $countryLocation; ?>">
      <input type="text" name="numHoles" value="<?php echo $numHoles; ?>">
      <input type="text" name="yardageUnits" value="<?php echo $yardageUnits; ?>">
      <input type="text" name="numTeeBoxes" value="<?php echo $numTeeBoxes; ?>">
      <input type="text" name="par1" value="<?php echo $par1; ?>">
      <input type="text" name="par2" value="<?php echo $par2; ?>">
      <input type="text" name="par3" value="<?php echo $par3; ?>">
      <input type="text" name="par4" value="<?php echo $par4; ?>">
      <input type="text" name="par5" value="<?php echo $par5; ?>">
      <input type="text" name="par6" value="<?php echo $par6; ?>">
      <input type="text" name="par7" value="<?php echo $par7; ?>">
      <input type="text" name="par8" value="<?php echo $par8; ?>">
      <input type="text" name="par9" value="<?php echo $par9; ?>">
      <input type="text" name="par10" value="<?php echo $par10; ?>">
      <input type="text" name="par11" value="<?php echo $par11; ?>">
      <input type="text" name="par12" value="<?php echo $par12; ?>">
      <input type="text" name="par13" value="<?php echo $par13; ?>">
      <input type="text" name="par14" value="<?php echo $par14; ?>">
      <input type="text" name="par15" value="<?php echo $par15; ?>">
      <input type="text" name="par16" value="<?php echo $par16; ?>">
      <input type="text" name="par17" value="<?php echo $par17; ?>">
      <input type="text" name="par18" value="<?php echo $par18; ?>">
      <div id="cancelInputs"></div>
      <input id="cancelSubmit" type="submit">
    </form>

    <!-- PHP Outputs to JS Code -->
    <?php
      echo "<script>
              var inputsHtml = \"\";";

      for ($i = 0; $i < $numTeeBoxes; $i++)
      {
        echo "inputsHtml += \"<input type=\\\"text\\\" name=\\\"colour_" . strval($i + 1) . "\\\" value=\\\"" . $colour[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance1_" . strval($i + 1) . "\\\" value=\\\"" . $distance1[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance2_" . strval($i + 1) . "\\\" value=\\\"" . $distance2[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance3_" . strval($i + 1) . "\\\" value=\\\"" . $distance3[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance4_" . strval($i + 1) . "\\\" value=\\\"" . $distance4[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance5_" . strval($i + 1) . "\\\" value=\\\"" . $distance5[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance6_" . strval($i + 1) . "\\\" value=\\\"" . $distance6[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance7_" . strval($i + 1) . "\\\" value=\\\"" . $distance7[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance8_" . strval($i + 1) . "\\\" value=\\\"" . $distance8[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance9_" . strval($i + 1) . "\\\" value=\\\"" . $distance9[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance10_" . strval($i + 1) . "\\\" value=\\\"" . $distance10[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance11_" . strval($i + 1) . "\\\" value=\\\"" . $distance11[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance12_" . strval($i + 1) . "\\\" value=\\\"" . $distance12[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance13_" . strval($i + 1) . "\\\" value=\\\"" . $distance13[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance14_" . strval($i + 1) . "\\\" value=\\\"" . $distance14[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance15_" . strval($i + 1) . "\\\" value=\\\"" . $distance15[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance16_" . strval($i + 1) . "\\\" value=\\\"" . $distance16[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance17_" . strval($i + 1) . "\\\" value=\\\"" . $distance17[$i] . "\\\">\\
                              <input type=\\\"text\\\" name=\\\"distance18_" . strval($i + 1) . "\\\" value=\\\"" . $distance18[$i] . "\\\">\";";
      }
              
      echo "  document.getElementById(\"checkInputs\").innerHTML = inputsHtml;
              document.getElementById(\"cancelInputs\").innerHTML = inputsHtml;
            </script>";

      if (!$authenticated)
      {
        echo "<script>
                window.location.href = \"admin-sign-in.php\";
              </script>";
      }
      else if ($course)
      {
        echo "<script>
                if (window.confirm(\"Possible course duplication found in database with the course name: \\\"", $course["clubName"];
        
        if ($course["courseName"])
        {
          echo " (", $course["courseName"], ")";
        }
        
        echo "\\\". Do you still want to add course \\\"", $clubName;
        
        if ($courseName)
        {
          echo " (", $courseName, ")";
        }
        
        echo "\\\"?\"))
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
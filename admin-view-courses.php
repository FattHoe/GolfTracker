<!DOCTYPE html>
<html lang="en-US">
  <head>
    <!-- Metadata Definitions -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title and Logo for Browser Navigation Bar -->
    <title>SportExcel Golf Tracker</title>
    <link rel="icon" href="sportexcel-logo.jpg">

    <!-- JS Function Declarations -->
    <script src="adminProfile.js"></script>

    <script>
      function displayCourses(courses)
      {
        var tableHtml = "";

        if (courses.length > 0)
        {
          for (club of courses)
          {
            tableHtml += "<tr><td>";

            tableHtml += "<span style=\"font-size: 20px;\"><b>" + club["clubName"];
            if (club["courseName"])
            {
              tableHtml += "&nbsp;(" + club["courseName"] + ")";
            }
            tableHtml += "</b></span><br>";

            tableHtml += "<span><b>Location:</b>&nbsp;" + club["stateLocation"] + ", " + club["countryLocation"] + "</span>";
            tableHtml += "<span class=\"numHolesAtt\"><b>Number&nbsp;of&nbsp;Holes:</b>&nbsp;" + club["numHoles"] + "</span>";
            tableHtml += "<span class=\"numTeeBoxesAtt\"><b>Number&nbsp;of&nbsp;Tee-Boxes:</b>&nbsp;" + club["numTeeBoxes"] + "</span>";

            tableHtml += "<button class=\"viewButtons\" onclick=\"goToViewCourse(" + club["courseID"] + ")\">View</button>";
            tableHtml += "<button class=\"deleteButtons\" onclick=\"deleteCourse(" + club["courseID"] + ", '" + club["clubName"];
            if (club["courseName"])
            {
              tableHtml += " (" + club["courseName"] + ")";
            }
            tableHtml += "')\">Delete</button>";
            tableHtml += "</td></tr>";
          }
        }
        else
        {
          tableHtml = "<tr><td>No Courses Found</td></tr>";
        }

        document.getElementById("courseTable").innerHTML = tableHtml;

        return;
      }

      function goToViewCourse(courseId)
      {
        document.getElementById("viewCourseId").value = courseId;
        document.getElementById("viewSubmit").click();

        return;
      }

      function deleteCourse(courseId, courseName)
      {
        if (window.confirm("Are you sure you want to delete \"" + courseName + "\" from the database?"))
        {
          document.getElementById("deleteCourseId").value = courseId;
          document.getElementById("deleteSubmit").click();
        }

        return;
      }
    </script>

    <!-- CSS Style Definitions -->
    <style media="screen">
      td
      {
        background-color: white;
        border: solid black 1px;
        border-radius: 5px;
        font-size: 15px;
        padding: 5px;
        position: relative;
      }

      .adminProfileElementButtons
      {
        background-color: white;
        border-bottom: solid black 1px;
        border-left: solid black 1px;
        border-right: solid black 1px;
        color: blue;
        height: 30px;
        width: 200px;
        margin: 0;
        text-align: center;
        line-height: 30px;
      }

      .adminProfileElementButtons:hover
      {
        background-color: lightgrey;
        cursor: pointer;
        text-decoration: underline;
      }

      .numHolesAtt, .numTeeBoxesAtt
      {
        position: absolute;
        top: 27px;
      }

      .numHolesAtt
      {
        left: 400px;
      }

      .numTeeBoxesAtt
      {
        left: 600px;
      }

      .viewButtons, .deleteButtons
      {
        height: 25px;
        margin: 0;
        position: absolute;
        top: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
      }

      .viewButtons
      {
        background-color: deepskyblue;
        left: 90%;
        width: 50px;
        z-index: 1;
      }

      .viewButtons:hover
      {
        background-color: dodgerblue;
      }

      .deleteButtons
      {
        background-color: salmon;
        left: 96%;
        width: 60px;
        z-index: 1;
      }

      .deleteButtons:hover
      {
        background-color: tomato;
      }

      #adminProfileButton
      {
        background-color: orange;
        height: 30px;
        width: 200px;
        margin: 0;
        position: fixed;
        top: 0;
        right: 0;
        z-index: 2;
      }

      #adminProfileButton:hover
      {
        background-color: darkorange;
      }

      #adminProfileContainer
      {
        margin: 0;
        padding: 0;
        position: fixed;
        top: 30px;
        right: 0;
        z-index: 2;
      }

      #homeButton
      {
        background-color: violet;
        margin: 0;
        position: fixed;
        top: 5px;
        left: 5px;
        width: 150px;
        z-index: 2;
      }

      #homeButton:hover
      {
        background-color: orchid;
      }

      #title
      {
        margin: 5px 10px 5px 200px;
      }

      #titleBanner
      {
        background-color: lime;
        margin: 0;
        position: absolute;
        top: 45px;
        left: 0;
        z-index: -1;
      }

      #displayContainer
      {
        height: 540px;
        width: 1030px;
        margin: 0 0 20px;
        position: absolute;
        top: 110px;
      }

      #nameSearchForm
      {
        background-color: lightgrey;
        border: solid lightgrey 1px;
        border-radius: 5px;
        margin: 0;
        padding: 5px;
        position: absolute;
        top: 0;
        left: 0;
        width: auto;
      }

      #clubNameSearchInput, #courseNameSearchInput
      {
        border: solid black 1px;
        margin: 0;
        width: 200px;
      }

      #nameSearchSubmit
      {
        background-color: lightskyblue;
        margin: 0;
      }

      #nameSearchSubmit:hover
      {
        background-color: deepskyblue;
      }

      #nameSearchResetButton
      {
        background-color: salmon;
        margin: 0;
      }

      #nameSearchResetButton:hover
      {
        background-color: tomato;
      }

      #addButton
      {
        background-color: lime;
        height: 30px;
        width: 100px;
        margin: 0;
        position: absolute;
        top: 0;
        right: 60px;
      }

      #addButton:hover
      {
        background-color: limegreen;
      }

      #courseDisplayContainer
      {
        background-color: lime;
        border: solid lime 5px;
        border-radius: 5px;
        height: 500px;
        width: 1000px;
        margin: 0;
        padding: 0;
        position: absolute;
        top: 40px;
        left: 0;
        overflow-y: scroll;
      }

      #courseTable
      {
        width: 980px;
        margin: 0;
      }

      @media screen and (min-width: 1065px) {
        #displayContainer
        {
          left: 50%;
          -ms-transform: translate(-50%);
          transform: translate(-50%);
        }
      }
    </style>
  </head>

  <body>
    <!-- PHP Constant Declarations -->
    <?php
      define("MAX_COURSES", 100);
    ?>

    <!-- PHP Database Operations -->
    <?php
      include "connection.php";
      include "mysqlQueries.php";
      include "validateInput.php";

      $conn = openConn();

      $authenticated = false;
      $username = "";
      $clubSearch = "";
      $courseSearch = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        if ($_POST["clubSearch"] || $_POST["courseSearch"])
        {
          $clubSearch = validateInput($_POST["clubSearch"]);
          $courseSearch = validateInput($_POST["courseSearch"]);
          $courses = $conn->query(sprintf(GET_COURSES_BY_NAME_SEARCH, strtolower($clubSearch), strtolower($courseSearch), MAX_COURSES));
        }
        else
        {
          $courses = $conn->query(sprintf(GET_COURSES, MAX_COURSES));
        }

        $courseIds = array();
        $clubNames = array();
        $courseNames = array();
        $stateLocations = array();
        $countryLocations = array();
        $numHoles = array();
        $numTeeBoxes = array();

        while ($club = $courses->fetch_assoc())
        {
          array_push($courseIds, $club["courseID"]);
          array_push($clubNames, $club["clubName"]);
          array_push($courseNames, $club["courseName"]);
          array_push($stateLocations, $club["stateLocation"]);
          array_push($countryLocations, $club["countryLocation"]);
          array_push($numHoles, $club["numHoles"]);
          array_push($numTeeBoxes, $club["numTeeBoxes"]);
        }
      }

      closeConn($conn);
    ?>

    <!-- User Interface -->
    <button id="adminProfileButton" onclick="showOrHideAdminProfile()"><?php echo $username; ?></button>

    <div id="adminProfileContainer" hidden>
      <div class="adminProfileElementButtons" onclick="document.getElementById('passwordChangeSubmit').click()">Change&nbsp;password</div>
      <div class="adminProfileElementButtons" onclick="document.getElementById('addAdminSubmit').click()">Add&nbsp;another&nbsp;admin&nbsp;account</div>
      <div class="adminProfileElementButtons" onclick="window.location.href = 'admin-sign-in.php'">Sign&nbsp;in&nbsp;as&nbsp;another&nbsp;admin</div>
      <div class="adminProfileElementButtons" onclick="document.getElementById('homeSubmit').click()">Home</div>
    </div>

    <button id="homeButton" onclick="document.getElementById('homeSubmit').click()">Back to Home Page</button>

    <div id="titleBanner">
      <h1 id="title">Golf&nbsp;Courses</h1>
    </div>

    <div id="displayContainer">
      <form id="nameSearchForm" method="post" action="admin-view-courses.php">
        <input type="text" name="username" value="<?php echo $username; ?>" hidden>
        Search&nbsp;Golf&nbsp;Course&nbsp;By:&nbsp;
        <input id="clubNameSearchInput" type="text" name="clubSearch" placeholder="Club Name" value="<?php echo $clubSearch; ?>">&nbsp;
        <input id="courseNameSearchInput" type="text" name="courseSearch" placeholder="Course Name" value="<?php echo $courseSearch; ?>">&nbsp;
        <input id="nameSearchSubmit" type="submit" value="Search">
        <span id="nameSearchResetContainer">&nbsp;<button id="nameSearchResetButton" onclick="document.getElementById('clubNameSearchInput').value = ''; document.getElementById('courseNameSearchInput').value = ''; return true;">Reset Search Filter</button></span>
      </form>

      <button id="addButton" onclick="document.getElementById('addSubmit').click()">Add Course</button>
      
      <div id="courseDisplayContainer">
        <table id="courseTable"></table>
      </div>
    </div>

    <!-- Hidden Forms -->
    <form method="post" action="admin-password-change.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="passwordChangeSubmit" type="submit">
    </form>

    <form method="post" action="admin-add-admin.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="addAdminSubmit" type="submit">
    </form>

    <form method="post" action="admin-navigation.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="homeSubmit" type="submit">
    </form>

    <form method="post" action="admin-add-course.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="addSubmit" type="submit">
    </form>

    <form method="post" action="admin-edit-course.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="viewCourseId" type="number" name="courseID">
      <input id="viewSubmit" type="submit">
    </form>

    <form method="post" action="delete-course.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="deleteCourseId" type="number" name="courseID">
      <input id="deleteSubmit" type="submit">
    </form>

    <!-- JS Code -->
    <script>
      if (document.getElementById("clubNameSearchInput").value == "" && document.getElementById("courseNameSearchInput").value == "")
      {
        document.getElementById("nameSearchResetContainer").setAttributeNode(document.createAttribute("hidden"));
      }
    </script>
    
    <!-- PHP Outputs to JS Code -->
    <?php
      if (!$authenticated)
      {
        echo "<script>
                window.location.href = \"admin-sign-in.php\";
              </script>";
      }
      else
      {
        echo "<script>
                var courses = [];
                var club;";
        for ($i = 0; $i < count($courseIds); $i++)
        {
          echo "club = {};
                club[\"courseID\"] = \"", $courseIds[$i], "\";
                club[\"clubName\"] = \"", $clubNames[$i], "\";
                club[\"courseName\"] = \"", $courseNames[$i], "\";
                club[\"stateLocation\"] = \"", $stateLocations[$i], "\";
                club[\"countryLocation\"] = \"", $countryLocations[$i], "\";
                club[\"numHoles\"] = \"", $numHoles[$i], "\";
                club[\"numTeeBoxes\"] = ", $numTeeBoxes[$i], ";
                courses.push(club);";
        }
        echo   "displayCourses(courses);
              </script>";
      }
    ?>
  </body>
</html>
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
    <script src="constants.js"></script>

    <script>
      const CAT_COLOURS = ["deepskyblue", "lightgrey", "salmon", "gold", "lime", "orange"];
      const CAT_HOVER_COLOURS = ["dodgerblue", "grey", "tomato", "orange", "limegreen", "darkorange"];
      
      var colourIndex = 0;
      var courseIds = [];
      var courseNames = [];
      var teeBoxes = [];
      var catIds = [];
      var catNames = [];
      var numCourses = 1;
    </script>
    <script>
      function checkInput()
      {
        var inputValid = true;
        var warnings = document.getElementsByClassName("warning");

        for (w of warnings)
        {
          w.innerHTML = "";
        }

        if (document.getElementById("nameInput").value == "")
        {
          inputValid = false;
          document.getElementById("nameWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("startDateInput").value == "")
        {
          inputValid = false;
          document.getElementById("startDateWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("endDateInput").value == "")
        {
          inputValid = false;
          document.getElementById("endDateWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }
        else if (document.getElementById("startDateInput").value != "" && document.getElementById("startDateInput").value > document.getElementById("endDateInput").value)
        {
          inputValid = false;
          document.getElementById("endDateWarning").innerHTML = "<b>*&nbsp;End&nbsp;Date&nbsp;Must&nbsp;be&nbsp;After&nbsp;Start&nbsp;Date</b>";
        }

        if (document.getElementById("venueInput").value == "")
        {
          inputValid = false;
          document.getElementById("venueWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("planNumPlayersInput").value == "" && !document.getElementById("noPlanNumPlayersInput").checked)
        {
          inputValid = false;
          document.getElementById("planNumPlayersWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (!document.getElementById("noRegisterDateInput").checked)
        {
          if (document.getElementById("registerOpenDateInput").value == "")
          {
            inputValid = false;
            document.getElementById("registerOpenDateWarning").innerHTML = "<b>*&nbsp;Required</b>";
          }

          if (document.getElementById("registerCloseDateInput").value == "")
          {
            inputValid = false;
            document.getElementById("registerCloseDateWarning").innerHTML = "<b>*&nbsp;Required</b>";
          }
          else if (document.getElementById("registerOpenDateInput").value != "" && document.getElementById("registerOpenDateInput").value > document.getElementById("registerCloseDateInput").value)
          {
            inputValid = false;
            document.getElementById("registerCloseDateWarning").innerHTML = "<b>*&nbsp;Close&nbsp;Date&nbsp;Must&nbsp;be&nbsp;After&nbsp;Open&nbsp;Date</b>";
          }
        }

        if (document.getElementById("paymentCloseDateInput").value == "" && !document.getElementById("noPaymentCloseDateInput").checked)
        {
          inputValid = false;
          document.getElementById("paymentCloseDateWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        return inputValid;
      }

      function planNumPlayersDisable(naChecked)
      {
        if (naChecked)
        {
          document.getElementById("planNumPlayersInput").setAttributeNode(document.createAttribute("disabled"));
        }
        else
        {
          document.getElementById("planNumPlayersInput").removeAttribute("disabled");
        }

        return;
      }

      function registerDateDisable(naChecked)
      {
        if (naChecked)
        {
          document.getElementById("registerOpenDateInput").setAttributeNode(document.createAttribute("disabled"));
          document.getElementById("registerCloseDateInput").setAttributeNode(document.createAttribute("disabled"));
        }
        else
        {
          document.getElementById("registerOpenDateInput").removeAttribute("disabled");
          document.getElementById("registerCloseDateInput").removeAttribute("disabled");
        }

        return;
      }

      function paymentCloseDateDisable(naChecked)
      {
        if (naChecked)
        {
          document.getElementById("paymentCloseDateInput").setAttributeNode(document.createAttribute("disabled"));
        }
        else
        {
          document.getElementById("paymentCloseDateInput").removeAttribute("disabled");
        }

        return;
      }

      function displayTeeBoxes(courseNum)
      {
        var teeBoxButtons = "Tee&nbsp;Box:<br>";
        var courseName = document.getElementById("course" + courseNum).value;

        for (var i = 0; i < courseNames.length; i++)
        {
          if (courseName == courseNames[i])
          {
            break;
          }
        }

        for (var teeBox of teeBoxes[i])
        {
          teeBoxButtons += "<input type=\"radio\" id=\"" + teeBox[1] + courseNum + "\" name=\"yardageId" + courseNum + "\" value=\"" + teeBox[0] + "\">\
                            <label for=\"" + teeBox[1] + courseNum + "\">" + teeBox[1] + "</label><br>";
        }

        document.getElementById("course" + courseNum + "TeeBoxes").innerHTML = teeBoxButtons;
        document.getElementById("courseId" + courseNum).value = courseIds[i];
      }

      function addCategory(courseNum)
      {
        var catButtons = document.getElementById("course" + courseNum + "Categories").innerHTML;
        var catDatalist = document.getElementById("categories").innerHTML;
        var catName = document.getElementById("category" + courseNum).value;
        var index = catDatalist.indexOf("<option value=\"" + catName);

        catButtons += "<button style=\"background-color:" + CAT_COLOURS[colourIndex] + "; border-radius:3px; margin:2px;\" onmouseover=\"this.style.backgroundColor = '" + CAT_HOVER_COLOURS[colourIndex] + "'\" onmouseout=\"this.style.backgroundColor = '" + CAT_COLOURS[colourIndex] + "'\" onclick=\"return removeCategory('" + catName + "', " + courseNum + ");\">" + catName + "&nbsp;&nbsp;<span style=\"color:dimgrey;\">X</span></button>";
        colourIndex = (colourIndex + 1) % CAT_COLOURS.length;
        if (catDatalist.indexOf("<option", index+1) > 0)
        {
          catDatalist = catDatalist.substring(0, index) + catDatalist.substring(catDatalist.indexOf("<option", index+1));
        }
        else
        {
          catDatalist = catDatalist.substring(0, index);
        }

        document.getElementById("course" + courseNum + "Categories").innerHTML = catButtons;
        document.getElementById("categories").innerHTML = catDatalist;
        document.getElementById("category" + courseNum).value = "";
      }

      function removeCategory(catName, courseNum)
      {
        var catButtons = document.getElementById("course" + courseNum + "Categories").innerHTML;
        var catDatalist = document.getElementById("categories").innerHTML;
        var nameIndex = catButtons.indexOf(catName);
        var index = catButtons.indexOf("<button");
        var nextIndex = catButtons.indexOf("<button", index+1);

        while (nextIndex < nameIndex && nextIndex != -1)
        {
          index = nextIndex;
          nextIndex = catButtons.indexOf("<button", index+1);
        }

        if (nextIndex > 0)
        {
          catButtons = catButtons.substring(0, index) + catButtons.substring(nextIndex);
        }
        else
        {
          catButtons = catButtons.substring(0, index);
        }

        catDatalist = "<option value=\"" + catName + "\">" + catDatalist;

        document.getElementById("course" + courseNum + "Categories").innerHTML = catButtons;
        document.getElementById("categories").innerHTML = catDatalist;

        return false;
      }

      function addCourse()
      {
        var newCourse, id, check, tempIndex;
        var catCourseHtml = document.getElementById("catCourseContainer").innerHTML;
        var index = catCourseHtml.indexOf("<button id=\"addCourseButton\"");
        numCourses++;

        newCourse = "<div id=\"course" + numCourses + "Container\" class=\"courseContainer\">\
                      <button class=\"deleteCourse\" onclick=\"return deleteCourse(" + numCourses + ")\">Delete Course</button>\
                      Course:<br>\
                      <input id=\"course" + numCourses + "\" class=\"courseSearch\" list=\"courses\" placeholder=\"Search Course\" value=\"\" oninput=\"displayTeeBoxes(" + numCourses + ")\">\
                      <input type=\"text\" id=\"courseId" + numCourses + "\" name=\"courseId" + numCourses + "\" value=\"\" hidden>\
                      <div id=\"course" + numCourses + "TeeBoxes\" class=\"courseTeeBoxes\"></div>\
                      Categories:&nbsp;<span id=\"course" + numCourses + "Categories\"></span><br>\
                      <input id=\"category" + numCourses + "\" class=\"categorySearch\" list=\"categories\" placeholder=\"Select Category\" oninput=\"addCategory(" + numCourses + ")\">\
					  <div class=\"roundContainer\">\
						Number of Rounds:<br>\
						<input type=\"number\" id=\"course" + numCourses + "NumRounds\" name=\"numRounds" + numCourses + "\" min=\"1\" placeholder=\"Enter Rounds\" value=\"\">\
					  </div>\
                    </div>";
        
        catCourseHtml = catCourseHtml.substring(0, index) + newCourse + catCourseHtml.substring(index);

        for (var i = 1; i < numCourses; i++)
        {
          index = catCourseHtml.indexOf("id=\"course" + i + "\"");
          index = catCourseHtml.indexOf("value=", index) + 7;
          catCourseHtml = catCourseHtml.substring(0, index) + document.getElementById("course" + i).value + catCourseHtml.substring(catCourseHtml.indexOf("\"", index));

          index = catCourseHtml.indexOf("id=\"courseId" + i + "\"");
          index = catCourseHtml.indexOf("value=", index) + 7;
          catCourseHtml = catCourseHtml.substring(0, index) + document.getElementById("courseId" + i).value + catCourseHtml.substring(catCourseHtml.indexOf("\"", index));

          index = catCourseHtml.indexOf("name=\"yardageId" + i + "\"");
          while (index > 0)
          {
            index = catCourseHtml.indexOf(">", index);
            check = catCourseHtml.substring(index - 10, index);

            tempIndex = catCourseHtml.indexOf("for=\"", index) + 5;
            id = catCourseHtml.substring(tempIndex, catCourseHtml.indexOf("\"", tempIndex));
            
            if (document.getElementById(id).checked)
            {
              if (check != "checked=\"\"")
              {
                catCourseHtml = catCourseHtml.substring(0, index) + "checked=\"\"" + catCourseHtml.substring(index);
              }
            }
            else
            {
              if (check == "checked=\"\"")
              {
                catCourseHtml = catCourseHtml.substring(0, index - 10) + catCourseHtml.substring(index);
              }
            }

            index = catCourseHtml.indexOf("name=\"yardageId" + i + "\"", index);
          }

		  index = catCourseHtml.indexOf("id=\"course" + i + "NumRounds\"");
          index = catCourseHtml.indexOf("value=", index) + 7;
          catCourseHtml = catCourseHtml.substring(0, index) + document.getElementById("course" + i + "NumRounds").value + catCourseHtml.substring(catCourseHtml.indexOf("\"", index));
        }

        document.getElementById("catCourseContainer").innerHTML = catCourseHtml;

		return false;
      }

      function deleteCourse(courseNum)
      {
	    var catCourseHtml = document.getElementById("catCourseContainer").innerHTML;
		var startIndex = catCourseHtml.indexOf("<div id=\"course" + courseNum + "Container");
		var endIndex;
		if (courseNum < numCourses)
		{
		  endIndex = catCourseHtml.indexOf("<div id=\"course" + (courseNum + 1) + "Container");
		}
		else
		{
		  endIndex = catCourseHtml.indexOf("<button id=\"addCourseButton\"");
		}

		catCourseHtml = catCourseHtml.substring(0, startIndex) + catCourseHtml.substring(endIndex);

		for (var i = 1; i != courseNum && i <= numCourses; i++)
        {
          index = catCourseHtml.indexOf("id=\"course" + i + "\"");
          index = catCourseHtml.indexOf("value=", index) + 7;
          catCourseHtml = catCourseHtml.substring(0, index) + document.getElementById("course" + i).value + catCourseHtml.substring(catCourseHtml.indexOf("\"", index));

          index = catCourseHtml.indexOf("id=\"courseId" + i + "\"");
          index = catCourseHtml.indexOf("value=", index) + 7;
          catCourseHtml = catCourseHtml.substring(0, index) + document.getElementById("courseId" + i).value + catCourseHtml.substring(catCourseHtml.indexOf("\"", index));

          index = catCourseHtml.indexOf("name=\"yardageId" + i + "\"");
          while (index > 0)
          {
            index = catCourseHtml.indexOf(">", index);
            check = catCourseHtml.substring(index - 10, index);

            tempIndex = catCourseHtml.indexOf("for=\"", index) + 5;
            id = catCourseHtml.substring(tempIndex, catCourseHtml.indexOf("\"", tempIndex));
            
            if (document.getElementById(id).checked)
            {
              if (check != "checked=\"\"")
              {
                catCourseHtml = catCourseHtml.substring(0, index) + "checked=\"\"" + catCourseHtml.substring(index);
              }
            }
            else
            {
              if (check == "checked=\"\"")
              {
                catCourseHtml = catCourseHtml.substring(0, index - 10) + catCourseHtml.substring(index);
              }
            }

			numCourses--;
            index = catCourseHtml.indexOf("name=\"yardageId" + i + "\"", index);
          }

		  index = catCourseHtml.indexOf("id=\"course" + i + "NumRounds\"");
          index = catCourseHtml.indexOf("value=", index) + 7;
          catCourseHtml = catCourseHtml.substring(0, index) + document.getElementById("course" + i + "NumRounds").value + catCourseHtml.substring(catCourseHtml.indexOf("\"", index));
        }

		// Update numbers after deletion
		// Add categories used in deleted course back to datalist

        document.getElementById("catCourseContainer").innerHTML = catCourseHtml;

        return false;
      }
    </script>

    <!-- CSS Style Definitions -->
    <style media="screen">
      label
      {
        color: black;
        font-size: 15px;
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

      .inputContainer
      {
        margin: 20px 20px 0;
        position: relative;
      }

      .secondColumnInputContainer
      {
        position: absolute;
        margin: 0;
        top: 0;
        left: 400px;
      }

      .courseContainer
      {
        border: solid black 1px;
        border-radius: 5px;
        position: relative;
        margin-top: 5px;
        width: 840px;
        padding: 10px;
      }

      .deleteCourse
      {
        background-color: salmon;
        position: absolute;
        top: 5px;
        right: 5px;
      }

      .deleteCourse:hover
      {
        background-color: tomato;
      }

      .courseSearch
      {
        width: 400px;
        margin-bottom: 5px;
      }

      .courseTeeBoxes
      {
        margin-bottom: 5px;
      }

      .roundContainer
      {
        position: absolute;
        top: 10px;
        left: 500px;
      }

      .warning
      {
        color: red;
        font-size: 15px;
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

      #viewTournamentsButton
      {
        background-color: deepskyblue;
        margin: 0;
        position: absolute;
        top: 5px;
        left: 5px;
        width: 200px;
        z-index: 2;
      }

      #viewTournamentsButton:hover
      {
        background-color: dodgerblue;
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

      #formContainer
      {
        border: solid black 1px;
        border-radius: 5px;
        width: 900px;
        margin: 0 0 20px;
        position: absolute;
        top: 150px;
      }

      #form
      {
        font-size: 20px;
        margin: 0;
        padding-bottom: 20px;
        width: 900px;
      }

      #nameInput
      {
        width: 600px;
      }

      #venueInput
      {
        width: 250px;
      }

      #planNumPlayersInput
      {
        width: 100px;
      }

      #addCourseButton
      {
        background-color: deepskyblue;
        margin-top: 10px;
      }

      #addCouseButton:hover
      {
        background-color: dodgerblue;
      }

      #addSubmit
      {
        background-color: lime;
        margin: 0;
        position: absolute;
        bottom: 20px;
        right: 20px;
        z-index: 1;
      }

      #addSubmit:hover
      {
        background-color: limegreen;
      }

      @media screen and (min-width: 920px) {
        #formContainer
        {
          left: 50%;
          -ms-transform: translate(-50%);
          transform: translate(-50%);
        }
      }
    </style>
  </head>

  <body>
    <!-- PHP Database Operations -->
    <?php
      include "connection.php";
      include "mysqlQueries.php";
      include "validateInput.php";

      $conn = openConn();

      $authenticated = false;
      $username = "";
      $tournamentName = "";
      $startDay = "";
      $startMonth = "";
      $startYear = "";
      $endDay = "";
      $endMonth = "";
      $endYear = "";
      $venue = "";
      $planNumPlayers = "";
      $actualNumPlayers = "";
      $registerOpenDay = "";
      $registerOpenMonth = "";
      $registerOpenYear = "";
      $registerCloseDay = "";
      $registerCloseMonth = "";
      $registerCloseYear = "";
      $paymentCloseDay = "";
      $paymentCloseMonth = "";
      $paymentCloseYear = "";
      $catIds = array();
      $categories = array();
      $courseIds = array();
      $courses = array();
      $courseTeeBoxes = array();

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        if ($_POST["tournamentName"])
        {
          $tournamentName = validateInput($_POST["tournamentName"]);
          $startDate = validateInput($_POST["startDate"]);
          $endDate = validateInput($_POST["endDate"]);
          $venue = validateInput($_POST["venue"]);
          $planNumPlayers = validateInput($_POST["planNumPlayers"]);
          $actualNumPlayers = validateInput($_POST["actualNumPlayers"]);
          $registerOpenDate = validateInput($_POST["registerOpenDate"]);
          $registerCloseDate = validateInput($_POST["registerCloseDate"]);
          $paymentCloseDate = validateInput($_POST["paymentCloseDate"]);
        }

        $cats = $conn->query(GET_ALL_CATEGORIES);

        while ($cat = $cats->fetch_assoc())
        {
          array_push($catIds, $cat["categoryID"]);
          array_push($categories, $cat["ageGroupCode"] . " (" . $cat["gender"] . ", " . strval($cat["minAge"]) . "-" . strval($cat["maxAge"]) . ")");
        }

        $clubs = $conn->query(GET_ALL_COURSES);

        while ($club = $clubs->fetch_assoc())
        {
          array_push($courseIds, $club["courseID"]);
		  if ($club["courseName"] != null)
		  {
			array_push($courses, $club["clubName"] . " (" . $club["courseName"] . ")");
		  }
          else
		  {
			array_push($courses, $club["clubName"]);
		  }

          $teeBoxes = $conn->query(sprintf(GET_ALL_TEEBOXES, $club["courseID"]));
          $teeBoxColours = array();
          while ($colour = $teeBoxes->fetch_assoc())
          {
            $yardage = array();
            array_push($yardage, $colour["yardageID"]);
            array_push($yardage, $colour["colour"]);
            array_push($teeBoxColours, $yardage);
          }
          array_push($courseTeeBoxes, $teeBoxColours);
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

    <button id="viewTournamentsButton" onclick="document.getElementById('viewTournamentsSubmit').click()">Back to View Tournaments</button>

    <div id="titleBanner">
      <h1 id="title">Add&nbsp;Tournament</h1>
    </div>

    <div id="formContainer">
      <form id="form" method="post" action="check-tournament.php" onsubmit="return checkInput()">
        <input type="text" name="username" value="<?php echo $username; ?>" hidden>
        
        <div class="inputContainer">
          Name:&nbsp;<span id="nameWarning" class="warning"></span><br>
          <input id="nameInput" type="text" name="tournamentName" value="<?php echo $tournamentName; ?>">
        </div>

        <div class="inputContainer">
          Start&nbsp;Date:&nbsp;<span id="startDateWarning" class="warning"></span><br>
          <input id="startDateInput" type="date" name="startDate" value="<?php echo $startDate; ?>">

          <div class="secondColumnInputContainer">
            End&nbsp;Date:&nbsp;<span id="endDateWarning" class="warning"></span><br>
            <input id="endDateInput" type="date" name="endDate" value="<?php echo $endDate; ?>">
          </div>
        </div>

        <div class="inputContainer">
          Venue:&nbsp;<span id="venueWarning" class="warning"></span><br>
          <input id="venueInput" type="text" name="venue" value="<?php echo $venue; ?>">
          <div class="secondColumnInputContainer">
            Planned&nbsp;Number&nbsp;of&nbsp;Players:&nbsp;<span id="planNumPlayersWarning" class="warning"></span><br>
            <input id="planNumPlayersInput" type="number" name="planNumPlayers" min="0" value="<?php echo $planNumPlayers; ?>">&nbsp;
            <input id="noPlanNumPlayersInput" type="checkbox" onclick="planNumPlayersDisable(this.checked)">
            <label for="noPlanNumPlayersInput">N/A</label><br>
          </div>
        </div>

        <div class="inputContainer">
          Registration&nbsp;Open&nbsp;Date:&nbsp;<span id="registerOpenDateWarning" class="warning"></span><br>
          <input id="registerOpenDateInput" type="date" name="registerOpenDate" value="<?php echo $registerOpenDate; ?>">&nbsp;
          <input id="noRegisterDateInput" type="checkbox" onclick="registerDateDisable(this.checked)">
          <label for="noRegisterDateInput">Closed</label><br>

          <div class="secondColumnInputContainer">
            Registration&nbsp;Close&nbsp;Date:&nbsp;<span id="registerCloseDateWarning" class="warning"></span><br>
            <input id="registerCloseDateInput" type="date" name="registerCloseDate" value="<?php echo $registerCloseDate; ?>">
          </div>
        </div>

        <div class="inputContainer">
          Payment&nbsp;Close&nbsp;Date:&nbsp;<span id="paymentCloseDateWarning" class="warning"></span><br>
          <input id="paymentCloseDateInput" type="date" name="paymentCloseDate" value="<?php echo $paymentCloseDate; ?>">&nbsp;
          <input id="noPaymentCloseDateInput" type="checkbox" onclick="paymentCloseDateDisable(this.checked)">
          <label for="noPaymentCloseDateInput">Closed</label><br>
        </div>

        <div id="catCourseContainer" class="inputContainer">
          Categories&nbsp;&&nbsp;Courses:<br>
          <div id="course1Container" class="courseContainer">
            Course:<br>
            <input id="course1" class="courseSearch" list="courses" placeholder="Search Course" value="" oninput="displayTeeBoxes(1)">
            <datalist id="courses">
              <?php
                foreach ($courses as $course)
                {
                  echo "<option value=\"", $course, "\">";
                }
              ?>
            </datalist>
            <input type="text" id="courseId1" name="courseId1" value="" hidden>
            <div id="course1TeeBoxes" class="courseTeeBoxes"></div>
            Categories:&nbsp;<span id="course1Categories"></span><br>
            <input id="category1" class="categorySearch" list="categories" placeholder="Select Category" oninput="addCategory(1)">
            <datalist id="categories">
              <?php
                foreach ($categories as $category)
                {
                  echo "<option value=\"", $category, "\">";
                }
              ?>
            </datalist>
            <div class="roundContainer">
              Number of Rounds:<br>
              <input type="number" id="course1NumRounds" name="numRounds1" min="1" placeholder="Enter Rounds" value="">
            </div>
          </div>
          <button id="addCourseButton" onclick="return addCourse();">Add Course</button>
        </div>

        <input id="addSubmit" type="submit" value="Add Tournament">
      </form>
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

    <form method="post" action="admin-view-tournaments.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="viewTournamentsSubmit" type="submit">
    </form>

    <!-- JS Code -->
    <script>
      if (document.getElementById("nameInput").value != "")
      {
        if (document.getElementById("planNumPlayersInput").value == "")
        {
          document.getElementById("noPlanNumPlayersInput").setAttributeNode(document.createAttribute("checked"));
          planNumPlayersDisable(true);
        }

        if (document.getElementById("registerOpenDateInput").value == "")
        {
          document.getElementById("noRegisterDateInput").setAttributeNode(document.createAttribute("checked"));
          registerDateDisable(true);
        }

        if (document.getElementById("paymentCloseDateInput").value == "")
        {
          document.getElementById("noPaymentCloseDateInput").setAttributeNode(document.createAttribute("checked"));
          paymentCloseDateDisable(true);
        }
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
      if (count($courseIds) > 0)
      {
        echo "<script>";
        foreach ($courseIds as $id)
        {
          echo "courseIds.push(", $id, ");";
        }
        foreach ($courses as $courseName)
        {
          echo "courseNames.push(\"", $courseName, "\");";
        }
        foreach ($courseTeeBoxes as $teeBox)
        {
          echo "var teeBox = [];";
          foreach ($teeBox as $yardage)
          {
            echo "teeBox.push([", $yardage[0], ", \"", $yardage[1], "\"]);";
          }
          echo "teeBoxes.push(teeBox);";
        }
        echo "</script>";
      }
      if (count($catIds) > 0)
      {
        echo "<script>";
        foreach ($catIds as $id)
        {
          echo "catIds.push(", $id, ");";
        }
        foreach ($categories as $catName)
        {
          echo "catNames.push(\"", $catName, "\");";
        }
      }
    ?>
  </body>
</html>
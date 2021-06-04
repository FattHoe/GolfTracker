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
      var numTeeBoxes = 1;

      function checkInput()
      {
        var inputValid = true;
        var warnings = document.getElementsByClassName("warning");
        var numHoles = "";

        for (w of warnings)
        {
          w.innerHTML = "";
        }

        if (document.getElementById("clubNameInput").value == "")
        {
          inputValid = false;
          document.getElementById("clubNameWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("courseNameInput").value == "" && !document.getElementById("noCourseNameInput").checked)
        {
          inputValid = false;
          document.getElementById("courseNameWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("stateInput").value == "")
        {
          inputValid = false;
          document.getElementById("stateWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("countryInput").value == "")
        {
          inputValid = false;
          document.getElementById("countryWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("numHolesInput").value == "")
        {
          inputValid = false;
          document.getElementById("numHolesWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }
        else
        {
          numHoles = parseInt(document.getElementById("numHolesInput").value);
        }

        if (document.getElementById("yardageUnitsInput").value == "")
        {
          inputValid = false;
          document.getElementById("yardageUnitsWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (numHoles != "")
        {
          var elems = document.getElementsByClassName("first9ParsInputs");

          for (e of elems)
          {
            if (e.value == "")
            {
              inputValid = false;
              document.getElementById("parsWarning").innerHTML = "<b>*&nbsp;All&nbsp;pars&nbsp;required</b>";
              break;
            }
          }

          if (numHoles == 18)
          {
            elems = document.getElementsByClassName("second9ParsInputs");

            for (e of elems)
            {
              if (e.value == "")
              {
                inputValid = false;
                document.getElementById("parsWarning").innerHTML = "<b>*&nbsp;All&nbsp;pars&nbsp;required</b>";
                break;
              }
            }
          }

          for (var i = 1; i <= numTeeBoxes; i++)
          {
            if (document.getElementById("teeBoxColourInput_" + i).value == "")
            {
              inputValid = false;
              document.getElementById("colourWarning_" + i).innerHTML = "<b>*&nbsp;Required</b>";
            }

            elems = document.getElementsByClassName("first9DistancesInputs_" + i);

            for (e of elems)
            {
              if (e.value == "")
              {
                inputValid = false;
                document.getElementById("distancesWarning_" + i).innerHTML = "<b>*&nbsp;All&nbsp;distances&nbsp;required</b>";
                break;
              }
            }

            if (numHoles == 18)
            {
              elems = document.getElementsByClassName("second9DistancesInputs_" + i);

              for (e of elems)
              {
                if (e.value == "")
                {
                  inputValid = false;
                  document.getElementById("distancesWarning_" + i).innerHTML = "<b>*&nbsp;All&nbsp;distances&nbsp;required</b>";
                  break;
                }
              }
            }
          }
        }

        if (inputValid)
        {
          document.getElementById("numTeeBoxes").value = numTeeBoxes;
        }

        return inputValid;
      }

      function courseNameDisable(naChecked)
      {
        if (naChecked)
        {
          document.getElementById("courseNameInput").setAttributeNode(document.createAttribute("disabled"));
        }
        else
        {
          document.getElementById("courseNameInput").removeAttribute("disabled");
        }

        return;
      }

      function changeNumHoles(numHoles)
      {
        var yardages = document.getElementsByClassName("distanceContainer");

        if (numHoles == "")
        {
          if (!document.getElementById("parsContainer").hidden)
          {
            document.getElementById("parsContainer").setAttributeNode(document.createAttribute("hidden"));
          }

          if (!document.getElementById("yardagesContainer").hidden)
          {
            document.getElementById("yardagesContainer").setAttributeNode(document.createAttribute("hidden"));
          }
        }
        else if (numHoles == "9")
        {
          if (document.getElementById("parsContainer").hidden)
          {
            document.getElementById("parsContainer").removeAttribute("hidden");
          }

          if (document.getElementById("yardagesContainer").hidden)
          {
            document.getElementById("yardagesContainer").removeAttribute("hidden");
          }
          
          if (!document.getElementById("second9ParsTable").hidden)
          {
            document.getElementById("second9ParsTable").setAttributeNode(document.createAttribute("hidden"));
          }

          for (var i = 0; i < yardages.length; i++)
          {
            if (yardages[0].hidden)
            {
              yardages[0].removeAttribute("hidden");
            }
            
            if (!document.getElementById("second9DistancesTable_" + (i + 1)).hidden)
            {
              document.getElementById("second9DistancesTable_" + (i + 1)).setAttributeNode(document.createAttribute("hidden"));
            }
          }
        }
        else
        {
          if (document.getElementById("parsContainer").hidden)
          {
            document.getElementById("parsContainer").removeAttribute("hidden");
          }

          if (document.getElementById("yardagesContainer").hidden)
          {
            document.getElementById("yardagesContainer").removeAttribute("hidden");
          }
          
          if (document.getElementById("second9ParsTable").hidden)
          {
            document.getElementById("second9ParsTable").removeAttribute("hidden");
          }

          for (var i = 0; i < yardages.length; i++)
          {
            if (yardages[0].hidden)
            {
              yardages[0].removeAttribute("hidden");
            }
            
            if (document.getElementById("second9DistancesTable_" + (i + 1)).hidden)
            {
              document.getElementById("second9DistancesTable_" + (i + 1)).removeAttribute("hidden");
            }
          }
        }

        return;
      }

      function addFirst9Pars()
      {
        var pars = document.getElementsByClassName("first9ParsInputs");
        var sum = 0;

        for (p of pars)
        {
          if (p.value != "")
          {
            sum += parseInt(p.value);
          }
        }

        document.getElementById("first9ParsTotal").innerHTML = sum;
        addFull18Pars()

        return;
      }

      function addSecond9Pars()
      {
        var pars = document.getElementsByClassName("second9ParsInputs");
        var sum = 0;

        for (p of pars)
        {
          if (p.value != "")
          {
            sum += parseInt(p.value);
          }
        }

        document.getElementById("second9ParsTotal").innerHTML = sum;
        addFull18Pars();

        return;
      }

      function addFull18Pars()
      {
        var first9Par = parseInt(document.getElementById("first9ParsTotal").innerHTML);
        var second9Par = parseInt(document.getElementById("second9ParsTotal").innerHTML);

        document.getElementById("full18ParsTotal").innerHTML = first9Par + second9Par;

        return;
      }

      function addFirst9Distances(teeBoxNum)
      {
        var distances = document.getElementsByClassName("first9DistancesInputs_" + teeBoxNum);
        var sum = 0;

        for (d of distances)
        {
          if (d.value != "")
          {
            sum += parseInt(d.value);
          }
        }

        document.getElementById("first9DistancesTotal_" + teeBoxNum).innerHTML = sum;
        addFull18Distances(teeBoxNum);

        return;
      }

      function addSecond9Distances(teeBoxNum)
      {
        var distances = document.getElementsByClassName("second9DistancesInputs_" + teeBoxNum);
        var sum = 0;

        for (d of distances)
        {
          if (d.value != "")
          {
            sum += parseInt(d.value);
          }
        }

        document.getElementById("second9DistancesTotal_" + teeBoxNum).innerHTML = sum;
        addFull18Distances(teeBoxNum);

        return;
      }

      function addFull18Distances(teeBoxNum)
      {
        var first9Distance = parseInt(document.getElementById("first9DistancesTotal_" + teeBoxNum).innerHTML);
        var second9Distance = parseInt(document.getElementById("second9DistancesTotal_" + teeBoxNum).innerHTML);

        document.getElementById("full18DistancesTotal_" + teeBoxNum).innerHTML = first9Distance + second9Distance;

        return;
      }

      function addAllParsAndDistances()
      {
        addFirst9Pars();
        addSecond9Pars();

        for (var i = 1; i <= numTeeBoxes; i++)
        {
          addFirst9Distances(i);
          addSecond9Distances(i);
        }

        return;
      }

      function addTeeBoxInput()
      {
        var colour;
        var distances;
        var yardageHtml = document.getElementById("yardagesContainer").innerHTML;
        var yardageIndex = yardageHtml.indexOf("<button id=\"addTeeBox\"");
        var newYardageHtml = yardageHtml.substring(0, yardageIndex);
        numTeeBoxes += 1;

        newYardageHtml += "<div class=\"distanceContainer\">\
                            Tee&nbsp;Box&nbsp;" + numTeeBoxes + "&nbsp;Colour:&nbsp;<span id=\"colourWarning_" + numTeeBoxes + "\" class=\"warning\"></span><br>\
                            <input id=\"teeBoxColourInput_" + numTeeBoxes + "\" class=\"colourInputs\" type=\"text\" name=\"colour_" + numTeeBoxes + "\" value=\"\">&nbsp;\
                            <button class=\"deleteTeeBox\" onclick=\"return deleteTeeBoxInput(" + numTeeBoxes + ")\">Delete Tee Box</button>&nbsp;<span id=\"distancesWarning_" + numTeeBoxes + "\" class=\"warning\"></span><br>\
                            <table>\
                              <tr>\
                                <td>Hole</td>\
                                <td>1</td>\
                                <td>2</td>\
                                <td>3</td>\
                                <td>4</td>\
                                <td>5</td>\
                                <td>6</td>\
                                <td>7</td>\
                                <td>8</td>\
                                <td>9</td>\
                                <td class=\"nineTotals\">Out</td>\
                              </tr>\
                              <tr>\
                                <td>Distance</td>\
                                <td><input class=\"distanceInputs first9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance1_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addFirst9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs first9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance2_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addFirst9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs first9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance3_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addFirst9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs first9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance4_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addFirst9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs first9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance5_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addFirst9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs first9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance6_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addFirst9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs first9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance7_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addFirst9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs first9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance8_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addFirst9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs first9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance9_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addFirst9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td id=\"first9DistancesTotal_" + numTeeBoxes + "\">0</td>\
                              </tr>\
                            </table>\
                            <table id=\"second9DistancesTable_" + numTeeBoxes + "\">\
                              <tr>\
                                <td>Hole</td>\
                                <td>10</td>\
                                <td>11</td>\
                                <td>12</td>\
                                <td>13</td>\
                                <td>14</td>\
                                <td>15</td>\
                                <td>16</td>\
                                <td>17</td>\
                                <td>18</td>\
                                <td class=\"nineTotals\">In</td>\
                                <td>Total</td>\
                              </tr>\
                              <tr>\
                              <td>Distance</td>\
                                <td><input class=\"distanceInputs second9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance10_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addSecond9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs second9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance11_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addSecond9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs second9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance12_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addSecond9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs second9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance13_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addSecond9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs second9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance14_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addSecond9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs second9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance15_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addSecond9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs second9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance16_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addSecond9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs second9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance17_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addSecond9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td><input class=\"distanceInputs second9DistancesInputs_" + numTeeBoxes + "\" type=\"number\" name=\"distance18_" + numTeeBoxes + "\" min=\"0\" max=\"1000\" oninput=\"addSecond9Distances(" + numTeeBoxes + ")\" value=\"\"></td>\
                                <td id=\"second9DistancesTotal_" + numTeeBoxes + "\">0</td>\
                                <td id=\"full18DistancesTotal_" + numTeeBoxes + "\">0</td>\
                              </tr>\
                            </table><br>\
                          </div>";

        newYardageHtml += yardageHtml.substring(yardageIndex);

        for (var i = 1; i < numTeeBoxes; i++)
        {
          colour = document.getElementById("teeBoxColourInput_" + i);
          yardageIndex = newYardageHtml.indexOf("teeBoxColourInput_" + i);
          yardageIndex = newYardageHtml.indexOf("value", yardageIndex) + 7;
          newYardageHtml = newYardageHtml.substring(0, yardageIndex) + colour.value + newYardageHtml.substring(newYardageHtml.indexOf("\"", yardageIndex));

          distances = document.getElementsByClassName("first9DistancesInputs_" + i);
          yardageIndex = newYardageHtml.indexOf("first9DistancesInputs_" + i);
          yardageIndex = newYardageHtml.indexOf("value", yardageIndex) + 7;

          for (d of distances)
          {
            newYardageHtml = newYardageHtml.substring(0, yardageIndex) + d.value + newYardageHtml.substring(newYardageHtml.indexOf("\"", yardageIndex));
            yardageIndex = newYardageHtml.indexOf("value", yardageIndex) + 7;
          }

          distances = document.getElementsByClassName("second9DistancesInputs_" + i);
          yardageIndex = newYardageHtml.indexOf("second9DistancesInputs_" + i);
          yardageIndex = newYardageHtml.indexOf("value", yardageIndex) + 7;

          for (d of distances)
          {
            newYardageHtml = newYardageHtml.substring(0, yardageIndex) + d.value + newYardageHtml.substring(newYardageHtml.indexOf("\"", yardageIndex));
            yardageIndex = newYardageHtml.indexOf("value", yardageIndex) + 7;
          }
        }

        document.getElementById("yardagesContainer").innerHTML = newYardageHtml;
        changeNumHoles(document.getElementById("numHolesInput").value);

        return false;
      }

      function deleteTeeBoxInput(teeBoxNum)
      {
        if (!window.confirm("Are you sure you want to delete Tee Box " + teeBoxNum + "?"))
        {
          return false;
        }

        var colour;
        var distances;
        var tempTeeBoxNum;
        var yardageHtml = document.getElementById("yardagesContainer").innerHTML;
        var yardageIndex = yardageHtml.indexOf("<div class=\"distanceContainer\"");

        for (var i = 1; i < teeBoxNum; i++)
        {
          yardageIndex = yardageHtml.indexOf("<div class=\"distanceContainer\"", yardageIndex + 1);
        }

        yardageHtml = yardageHtml.substring(0, yardageIndex) + yardageHtml.substring(yardageHtml.indexOf("</div>", yardageIndex) + 6);
        numTeeBoxes -= 1;

        for (var i = teeBoxNum; i <= numTeeBoxes; i++)
        {
          yardageIndex = yardageHtml.indexOf("Tee&nbsp;Box&nbsp;" + (i + 1));
          yardageHtml = yardageHtml.substring(0, yardageIndex) + "Tee&nbsp;Box&nbsp;" + i + "&nbsp;" + yardageHtml.substring(yardageHtml.indexOf("Colour", yardageIndex));

          yardageIndex = yardageHtml.indexOf("_" + (i + 1));
          while (yardageIndex > -1)
          {
            yardageHtml = yardageHtml.substring(0, yardageIndex) + "_" + i + yardageHtml.substring(yardageIndex + 2);
            yardageIndex = yardageHtml.indexOf("_" + (i + 1));
          }

          yardageIndex = yardageHtml.indexOf("deleteTeeBoxInput(" + (i + 1) + ")");
          yardageHtml = yardageHtml.substring(0, yardageIndex) + "deleteTeeBoxInput(" + i + ")" + yardageHtml.substring(yardageHtml.indexOf(")", yardageIndex) + 1);

          yardageIndex = yardageHtml.indexOf("addFirst9Distances(" + (i + 1) + ")");
          while (yardageIndex > -1)
          {
            yardageHtml = yardageHtml.substring(0, yardageIndex) + "addFirst9Distances(" + i + ")" + yardageHtml.substring(yardageHtml.indexOf(")", yardageIndex) + 1);
            yardageIndex = yardageHtml.indexOf("addFirst9Distances(" + (i + 1) + ")");
          }

          yardageIndex = yardageHtml.indexOf("addSecond9Distances(" + (i + 1) + ")");
          while (yardageIndex > -1)
          {
            yardageHtml = yardageHtml.substring(0, yardageIndex) + "addSecond9Distances(" + i + ")" + yardageHtml.substring(yardageHtml.indexOf(")", yardageIndex) + 1);
            yardageIndex = yardageHtml.indexOf("addSecond9Distances(" + (i + 1) + ")");
          }
        }

        for (var i = 1; i <= numTeeBoxes; i++)
        {
          if (i < teeBoxNum)
          {
            tempTeeBoxNum = i;
          }
          else
          {
            tempTeeBoxNum = i + 1;
          }

          colour = document.getElementById("teeBoxColourInput_" + tempTeeBoxNum);
          yardageIndex = yardageHtml.indexOf("teeBoxColourInput_" + i);
          yardageIndex = yardageHtml.indexOf("value", yardageIndex) + 7;
          yardageHtml = yardageHtml.substring(0, yardageIndex) + colour.value + yardageHtml.substring(yardageHtml.indexOf("\"", yardageIndex));

          distances = document.getElementsByClassName("first9DistancesInputs_" + tempTeeBoxNum);
          yardageIndex = yardageHtml.indexOf("first9DistancesInputs_" + i);
          yardageIndex = yardageHtml.indexOf("value", yardageIndex) + 7;

          for (d of distances)
          {
            yardageHtml = yardageHtml.substring(0, yardageIndex) + d.value + yardageHtml.substring(yardageHtml.indexOf("\"", yardageIndex));
            yardageIndex = yardageHtml.indexOf("value", yardageIndex) + 7;
          }

          distances = document.getElementsByClassName("second9DistancesInputs_" + tempTeeBoxNum);
          yardageIndex = yardageHtml.indexOf("second9DistancesInputs_" + i);
          yardageIndex = yardageHtml.indexOf("value", yardageIndex) + 7;

          for (d of distances)
          {
            yardageHtml = yardageHtml.substring(0, yardageIndex) + d.value + yardageHtml.substring(yardageHtml.indexOf("\"", yardageIndex));
            yardageIndex = yardageHtml.indexOf("value", yardageIndex) + 7;
          }
        }

        document.getElementById("yardagesContainer").innerHTML = yardageHtml;

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

      table
      {
        border-collapse: collapse;
      }

      td
      {
        border: solid black 1px;
        padding: 5px;
        text-align: center;
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

      .distanceContainer
      {
        margin: 10px;
      }

      .secondColumnInputContainer
      {
        position: absolute;
        margin: 0;
        top: 0;
        left: 450px;
      }

      .warning
      {
        color: red;
        font-size: 15px;
      }

      .nineTotals
      {
        width: 42px;
      }

      .colourInputs
      {
        margin-bottom: 5px;
      }

      .deleteTeeBox
      {
        background-color: salmon;
      }

      .deleteTeeBox:hover
      {
        background-color: tomato;
      }

      .first9ParsInputs, .second9ParsInputs, .distanceInputs
      {
        width: 50px;
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

      #viewCoursesButton
      {
        background-color: lime;
        margin: 0;
        position: absolute;
        top: 5px;
        left: 5px;
        width: 180px;
        z-index: 2;
      }

      #viewCoursesButton:hover
      {
        background-color: limegreen;
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

      #countryInput, #numHolesInput, #yardageUnitsInput
      {
        height: 23px;
      }

      #addTeeBox
      {
        background-color: deepskyblue;
        margin-top: 10px;
      }

      #addTeeBox:hover
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
      include "validateInput.php";

      $authenticated = false;
      $username = "";
      $clubName = "";
      $courseName = "";
      $stateLocation = "";
      $countryLocation = "";
      $numHoles = "";
      $yardageUnits = "";
      $numTeeBoxes = "";
      $par1 = "";
      $par2 = "";
      $par3 = "";
      $par4 = "";
      $par5 = "";
      $par6 = "";
      $par7 = "";
      $par8 = "";
      $par9 = "";
      $par10 = "";
      $par11 = "";
      $par12 = "";
      $par13 = "";
      $par14 = "";
      $par15 = "";
      $par16 = "";
      $par17 = "";
      $par18 = "";
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

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        if ($_POST["clubName"])
        {
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
        }
      }
    ?>

    <!-- User Interface -->
    <button id="adminProfileButton" onclick="showOrHideAdminProfile()"><?php echo $username; ?></button>

    <div id="adminProfileContainer" hidden>
      <div class="adminProfileElementButtons" onclick="document.getElementById('passwordChangeSubmit').click()">Change&nbsp;password</div>
      <div class="adminProfileElementButtons" onclick="document.getElementById('addAdminSubmit').click()">Add&nbsp;another&nbsp;admin&nbsp;account</div>
      <div class="adminProfileElementButtons" onclick="window.location.href = 'admin-sign-in.php'">Sign&nbsp;in&nbsp;as&nbsp;another&nbsp;admin</div>
      <div class="adminProfileElementButtons" onclick="document.getElementById('homeSubmit').click()">Home</div>
    </div>

    <button id="viewCoursesButton" onclick="document.getElementById('viewCoursesSubmit').click()">Back to View Golf Courses</button>

    <div id="titleBanner">
      <h1 id="title">Add&nbsp;Golf&nbsp;Course</h1>
    </div>

    <div id="formContainer">
      <form id="form" method="post" action="check-course.php" onsubmit="return checkInput()">
        <input type="text" name="username" value="<?php echo $username; ?>" hidden>
        <input id="numTeeBoxes" type="number" name="numTeeBoxes" value="" hidden>
        
        <div class="inputContainer">
          Golf&nbsp;Club&nbsp;Name:&nbsp;<span id="clubNameWarning" class="warning"></span><br>
          <input id="clubNameInput" type="text" name="clubName" value="<?php echo $clubName; ?>">

          <div class="secondColumnInputContainer">
            Course&nbsp;Name:&nbsp;<span id="courseNameWarning" class="warning"></span><br>
            <input id="courseNameInput" type="text" name="courseName" value="<?php echo $courseName; ?>">
            <input id="noCourseNameInput" type="checkbox" onclick="courseNameDisable(this.checked)"<?php if ($clubName && $courseName == "") { echo " checked"; } ?>>
            <label for="noCourseNameInput">N/A</label>
          </div>
        </div>

        <div class="inputContainer">
          State:&nbsp;<span id="stateWarning" class="warning"></span><br>
          <input id="stateInput" type="text" name="stateLocation" value="<?php echo $stateLocation; ?>">

          <div class="secondColumnInputContainer">
            Country:&nbsp;<span id="countryWarning" class="warning"></span><br>
            <select id="countryInput" name="countryLocation">
              <option value="">Select Country</option>
              <option value="Malaysia">Malaysia</option>
              <option value="Afghanistan">Afghanistan</option>
              <option value="Åland Islands">Åland Islands</option>
              <option value="Albania">Albania</option>
              <option value="Algeria">Algeria</option>
              <option value="American Samoa">American Samoa</option>
              <option value="Andorra">Andorra</option>
              <option value="Angola">Angola</option>
              <option value="Anguilla">Anguilla</option>
              <option value="Antarctica">Antarctica</option>
              <option value="Antigua and Barbuda">Antigua and Barbuda</option>
              <option value="Argentina">Argentina</option>
              <option value="Armenia">Armenia</option>
              <option value="Aruba">Aruba</option>
              <option value="Australia">Australia</option>
              <option value="Austria">Austria</option>
              <option value="Azerbaijan">Azerbaijan</option>
              <option value="Bahamas">Bahamas</option>
              <option value="Bahrain">Bahrain</option>
              <option value="Bangladesh">Bangladesh</option>
              <option value="Barbados">Barbados</option>
              <option value="Belarus">Belarus</option>
              <option value="Belgium">Belgium</option>
              <option value="Belize">Belize</option>
              <option value="Benin">Benin</option>
              <option value="Bermuda">Bermuda</option>
              <option value="Bhutan">Bhutan</option>
              <option value="Bolivia">Bolivia</option>
              <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
              <option value="Botswana">Botswana</option>
              <option value="Bouvet Island">Bouvet Island</option>
              <option value="Brazil">Brazil</option>
              <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
              <option value="Brunei Darussalam">Brunei Darussalam</option>
              <option value="Bulgaria">Bulgaria</option>
              <option value="Burkina Faso">Burkina Faso</option>
              <option value="Burundi">Burundi</option>
              <option value="Cambodia">Cambodia</option>
              <option value="Cameroon">Cameroon</option>
              <option value="Canada">Canada</option>
              <option value="Cape Verde">Cape Verde</option>
              <option value="Cayman Islands">Cayman Islands</option>
              <option value="Central African Republic">Central African Republic</option>
              <option value="Chad">Chad</option>
              <option value="Chile">Chile</option>
              <option value="China">China</option>
              <option value="Christmas Island">Christmas Island</option>
              <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
              <option value="Colombia">Colombia</option>
              <option value="Comoros">Comoros</option>
              <option value="Congo">Congo</option>
              <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
              <option value="Cook Islands">Cook Islands</option>
              <option value="Costa Rica">Costa Rica</option>
              <option value="Cote D'ivoire">Cote D'ivoire</option>
              <option value="Croatia">Croatia</option>
              <option value="Cuba">Cuba</option>
              <option value="Cyprus">Cyprus</option>
              <option value="Czech Republic">Czech Republic</option>
              <option value="Denmark">Denmark</option>
              <option value="Djibouti">Djibouti</option>
              <option value="Dominica">Dominica</option>
              <option value="Dominican Republic">Dominican Republic</option>
              <option value="Ecuador">Ecuador</option>
              <option value="Egypt">Egypt</option>
              <option value="El Salvador">El Salvador</option>
              <option value="Equatorial Guinea">Equatorial Guinea</option>
              <option value="Eritrea">Eritrea</option>
              <option value="Estonia">Estonia</option>
              <option value="Ethiopia">Ethiopia</option>
              <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
              <option value="Faroe Islands">Faroe Islands</option>
              <option value="Fiji">Fiji</option>
              <option value="Finland">Finland</option>
              <option value="France">France</option>
              <option value="French Guiana">French Guiana</option>
              <option value="French Polynesia">French Polynesia</option>
              <option value="French Southern Territories">French Southern Territories</option>
              <option value="Gabon">Gabon</option>
              <option value="Gambia">Gambia</option>
              <option value="Georgia">Georgia</option>
              <option value="Germany">Germany</option>
              <option value="Ghana">Ghana</option>
              <option value="Gibraltar">Gibraltar</option>
              <option value="Greece">Greece</option>
              <option value="Greenland">Greenland</option>
              <option value="Grenada">Grenada</option>
              <option value="Guadeloupe">Guadeloupe</option>
              <option value="Guam">Guam</option>
              <option value="Guatemala">Guatemala</option>
              <option value="Guernsey">Guernsey</option>
              <option value="Guinea">Guinea</option>
              <option value="Guinea-bissau">Guinea-bissau</option>
              <option value="Guyana">Guyana</option>
              <option value="Haiti">Haiti</option>
              <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
              <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
              <option value="Honduras">Honduras</option>
              <option value="Hong Kong">Hong Kong</option>
              <option value="Hungary">Hungary</option>
              <option value="Iceland">Iceland</option>
              <option value="India">India</option>
              <option value="Indonesia">Indonesia</option>
              <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
              <option value="Iraq">Iraq</option>
              <option value="Ireland">Ireland</option>
              <option value="Isle of Man">Isle of Man</option>
              <option value="Israel">Israel</option>
              <option value="Italy">Italy</option>
              <option value="Jamaica">Jamaica</option>
              <option value="Japan">Japan</option>
              <option value="Jersey">Jersey</option>
              <option value="Jordan">Jordan</option>
              <option value="Kazakhstan">Kazakhstan</option>
              <option value="Kenya">Kenya</option>
              <option value="Kiribati">Kiribati</option>
              <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
              <option value="Korea, Republic of">Korea, Republic of</option>
              <option value="Kuwait">Kuwait</option>
              <option value="Kyrgyzstan">Kyrgyzstan</option>
              <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
              <option value="Latvia">Latvia</option>
              <option value="Lebanon">Lebanon</option>
              <option value="Lesotho">Lesotho</option>
              <option value="Liberia">Liberia</option>
              <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
              <option value="Liechtenstein">Liechtenstein</option>
              <option value="Lithuania">Lithuania</option>
              <option value="Luxembourg">Luxembourg</option>
              <option value="Macao">Macao</option>
              <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
              <option value="Madagascar">Madagascar</option>
              <option value="Malawi">Malawi</option>
              <option value="Maldives">Maldives</option>
              <option value="Mali">Mali</option>
              <option value="Malta">Malta</option>
              <option value="Marshall Islands">Marshall Islands</option>
              <option value="Martinique">Martinique</option>
              <option value="Mauritania">Mauritania</option>
              <option value="Mauritius">Mauritius</option>
              <option value="Mayotte">Mayotte</option>
              <option value="Mexico">Mexico</option>
              <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
              <option value="Moldova, Republic of">Moldova, Republic of</option>
              <option value="Monaco">Monaco</option>
              <option value="Mongolia">Mongolia</option>
              <option value="Montenegro">Montenegro</option>
              <option value="Montserrat">Montserrat</option>
              <option value="Morocco">Morocco</option>
              <option value="Mozambique">Mozambique</option>
              <option value="Myanmar">Myanmar</option>
              <option value="Namibia">Namibia</option>
              <option value="Nauru">Nauru</option>
              <option value="Nepal">Nepal</option>
              <option value="Netherlands">Netherlands</option>
              <option value="Netherlands Antilles">Netherlands Antilles</option>
              <option value="New Caledonia">New Caledonia</option>
              <option value="New Zealand">New Zealand</option>
              <option value="Nicaragua">Nicaragua</option>
              <option value="Niger">Niger</option>
              <option value="Nigeria">Nigeria</option>
              <option value="Niue">Niue</option>
              <option value="Norfolk Island">Norfolk Island</option>
              <option value="Northern Mariana Islands">Northern Mariana Islands</option>
              <option value="Norway">Norway</option>
              <option value="Oman">Oman</option>
              <option value="Pakistan">Pakistan</option>
              <option value="Palau">Palau</option>
              <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
              <option value="Panama">Panama</option>
              <option value="Papua New Guinea">Papua New Guinea</option>
              <option value="Paraguay">Paraguay</option>
              <option value="Peru">Peru</option>
              <option value="Philippines">Philippines</option>
              <option value="Pitcairn">Pitcairn</option>
              <option value="Poland">Poland</option>
              <option value="Portugal">Portugal</option>
              <option value="Puerto Rico">Puerto Rico</option>
              <option value="Qatar">Qatar</option>
              <option value="Reunion">Reunion</option>
              <option value="Romania">Romania</option>
              <option value="Russian Federation">Russian Federation</option>
              <option value="Rwanda">Rwanda</option>
              <option value="Saint Helena">Saint Helena</option>
              <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
              <option value="Saint Lucia">Saint Lucia</option>
              <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
              <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
              <option value="Samoa">Samoa</option>
              <option value="San Marino">San Marino</option>
              <option value="Sao Tome and Principe">Sao Tome and Principe</option>
              <option value="Saudi Arabia">Saudi Arabia</option>
              <option value="Senegal">Senegal</option>
              <option value="Serbia">Serbia</option>
              <option value="Seychelles">Seychelles</option>
              <option value="Sierra Leone">Sierra Leone</option>
              <option value="Singapore">Singapore</option>
              <option value="Slovakia">Slovakia</option>
              <option value="Slovenia">Slovenia</option>
              <option value="Solomon Islands">Solomon Islands</option>
              <option value="Somalia">Somalia</option>
              <option value="South Africa">South Africa</option>
              <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
              <option value="Spain">Spain</option>
              <option value="Sri Lanka">Sri Lanka</option>
              <option value="Sudan">Sudan</option>
              <option value="Suriname">Suriname</option>
              <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
              <option value="Swaziland">Swaziland</option>
              <option value="Sweden">Sweden</option>
              <option value="Switzerland">Switzerland</option>
              <option value="Syrian Arab Republic">Syrian Arab Republic</option>
              <option value="Taiwan, Province of China">Taiwan, Province of China</option>
              <option value="Tajikistan">Tajikistan</option>
              <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
              <option value="Thailand">Thailand</option>
              <option value="Timor-leste">Timor-leste</option>
              <option value="Togo">Togo</option>
              <option value="Tokelau">Tokelau</option>
              <option value="Tonga">Tonga</option>
              <option value="Trinidad and Tobago">Trinidad and Tobago</option>
              <option value="Tunisia">Tunisia</option>
              <option value="Turkey">Turkey</option>
              <option value="Turkmenistan">Turkmenistan</option>
              <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
              <option value="Tuvalu">Tuvalu</option>
              <option value="Uganda">Uganda</option>
              <option value="Ukraine">Ukraine</option>
              <option value="United Arab Emirates">United Arab Emirates</option>
              <option value="United Kingdom">United Kingdom</option>
              <option value="United States of America">United States of America</option>
              <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
              <option value="Uruguay">Uruguay</option>
              <option value="Uzbekistan">Uzbekistan</option>
              <option value="Vanuatu">Vanuatu</option>
              <option value="Venezuela">Venezuela</option>
              <option value="Viet Nam">Viet Nam</option>
              <option value="Virgin Islands, British">Virgin Islands, British</option>
              <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
              <option value="Wallis and Futuna">Wallis and Futuna</option>
              <option value="Western Sahara">Western Sahara</option>
              <option value="Yemen">Yemen</option>
              <option value="Zambia">Zambia</option>
              <option value="Zimbabwe">Zimbabwe</option>
            </select>
          </div>
        </div>

        <div class="inputContainer">
          Number&nbsp;of&nbsp;Holes:&nbsp;<span id="numHolesWarning" class="warning"></span><br>
          <select id="numHolesInput" name="numHoles" onchange="changeNumHoles(this.value)">
            <option value="">Select Number of Holes</option>
            <option value="9">9 Holes</option>
            <option value="18">18 Holes</option>
          </select>

          <div class="secondColumnInputContainer">
            Yardage&nbsp;Measurement&nbsp;Units:&nbsp;<span id="yardageUnitsWarning" class="warning"></span><br>
            <select id="yardageUnitsInput" name="yardageUnits">
              <option value="">Select Units</option>
              <option value="meters">Meters</option>
              <option value="yards">Yards</option>
            </select>
          </div>
        </div>

        <div id="parsContainer" class="inputContainer" hidden>
          Course&nbsp;Pars:&nbsp;<span id="parsWarning" class="warning"></span><br>
          <table>
            <tr>
              <td>Hole</td>
              <td>1</td>
              <td>2</td>
              <td>3</td>
              <td>4</td>
              <td>5</td>
              <td>6</td>
              <td>7</td>
              <td>8</td>
              <td>9</td>
              <td class="nineTotals">Out</td>
            </tr>
            <tr>
              <td>Par</td>
              <td><input class="first9ParsInputs" type="number" name="par1" min="3" max="5" oninput="addFirst9Pars()" value="<?php echo $par1; ?>"></td>
              <td><input class="first9ParsInputs" type="number" name="par2" min="3" max="5" oninput="addFirst9Pars()" value="<?php echo $par2; ?>"></td>
              <td><input class="first9ParsInputs" type="number" name="par3" min="3" max="5" oninput="addFirst9Pars()" value="<?php echo $par3; ?>"></td>
              <td><input class="first9ParsInputs" type="number" name="par4" min="3" max="5" oninput="addFirst9Pars()" value="<?php echo $par4; ?>"></td>
              <td><input class="first9ParsInputs" type="number" name="par5" min="3" max="5" oninput="addFirst9Pars()" value="<?php echo $par5; ?>"></td>
              <td><input class="first9ParsInputs" type="number" name="par6" min="3" max="5" oninput="addFirst9Pars()" value="<?php echo $par6; ?>"></td>
              <td><input class="first9ParsInputs" type="number" name="par7" min="3" max="5" oninput="addFirst9Pars()" value="<?php echo $par7; ?>"></td>
              <td><input class="first9ParsInputs" type="number" name="par8" min="3" max="5" oninput="addFirst9Pars()" value="<?php echo $par8; ?>"></td>
              <td><input class="first9ParsInputs" type="number" name="par9" min="3" max="5" oninput="addFirst9Pars()" value="<?php echo $par9; ?>"></td>
              <td id="first9ParsTotal">0</td>
            </tr>
          </table>
          <table id="second9ParsTable">
            <tr>
              <td>Hole</td>
              <td>10</td>
              <td>11</td>
              <td>12</td>
              <td>13</td>
              <td>14</td>
              <td>15</td>
              <td>16</td>
              <td>17</td>
              <td>18</td>
              <td class="nineTotals">In</td>
              <td>Total</td>
            </tr>
            <tr>
              <td>Par</td>
              <td><input class="second9ParsInputs" type="number" name="par10" min="3" max="5" oninput="addSecond9Pars()" value="<?php echo $par10; ?>"></td>
              <td><input class="second9ParsInputs" type="number" name="par11" min="3" max="5" oninput="addSecond9Pars()" value="<?php echo $par11; ?>"></td>
              <td><input class="second9ParsInputs" type="number" name="par12" min="3" max="5" oninput="addSecond9Pars()" value="<?php echo $par12; ?>"></td>
              <td><input class="second9ParsInputs" type="number" name="par13" min="3" max="5" oninput="addSecond9Pars()" value="<?php echo $par13; ?>"></td>
              <td><input class="second9ParsInputs" type="number" name="par14" min="3" max="5" oninput="addSecond9Pars()" value="<?php echo $par14; ?>"></td>
              <td><input class="second9ParsInputs" type="number" name="par15" min="3" max="5" oninput="addSecond9Pars()" value="<?php echo $par15; ?>"></td>
              <td><input class="second9ParsInputs" type="number" name="par16" min="3" max="5" oninput="addSecond9Pars()" value="<?php echo $par16; ?>"></td>
              <td><input class="second9ParsInputs" type="number" name="par17" min="3" max="5" oninput="addSecond9Pars()" value="<?php echo $par17; ?>"></td>
              <td><input class="second9ParsInputs" type="number" name="par18" min="3" max="5" oninput="addSecond9Pars()" value="<?php echo $par18; ?>"></td>
              <td id="second9ParsTotal">0</td>
              <td id="full18ParsTotal">0</td>
            </tr>
          </table>
        </div>

        <div id="yardagesContainer" class="inputContainer" hidden>
          Course&nbsp;Distances:<br>
          <div class="distanceContainer">
            Tee&nbsp;Box&nbsp;1&nbsp;Colour:&nbsp;<span id="colourWarning_1" class="warning"></span><br>
            <input id="teeBoxColourInput_1" class="colourInputs" type="text" name="colour_1" value="<?php echo $colour[0]; ?>">&nbsp;<span id="distancesWarning_1" class="warning"></span><br>
            <table>
              <tr>
                <td>Hole</td>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td class="nineTotals">Out</td>
              </tr>
              <tr>
                <td>Distance</td>
                <td><input class="distanceInputs first9DistancesInputs_1" type="number" name="distance1_1" min="0" max="1000" oninput="addFirst9Distances(1)" value="<?php echo $distance1[0]; ?>"></td>
                <td><input class="distanceInputs first9DistancesInputs_1" type="number" name="distance2_1" min="0" max="1000" oninput="addFirst9Distances(1)" value="<?php echo $distance2[0]; ?>"></td>
                <td><input class="distanceInputs first9DistancesInputs_1" type="number" name="distance3_1" min="0" max="1000" oninput="addFirst9Distances(1)" value="<?php echo $distance3[0]; ?>"></td>
                <td><input class="distanceInputs first9DistancesInputs_1" type="number" name="distance4_1" min="0" max="1000" oninput="addFirst9Distances(1)" value="<?php echo $distance4[0]; ?>"></td>
                <td><input class="distanceInputs first9DistancesInputs_1" type="number" name="distance5_1" min="0" max="1000" oninput="addFirst9Distances(1)" value="<?php echo $distance5[0]; ?>"></td>
                <td><input class="distanceInputs first9DistancesInputs_1" type="number" name="distance6_1" min="0" max="1000" oninput="addFirst9Distances(1)" value="<?php echo $distance6[0]; ?>"></td>
                <td><input class="distanceInputs first9DistancesInputs_1" type="number" name="distance7_1" min="0" max="1000" oninput="addFirst9Distances(1)" value="<?php echo $distance7[0]; ?>"></td>
                <td><input class="distanceInputs first9DistancesInputs_1" type="number" name="distance8_1" min="0" max="1000" oninput="addFirst9Distances(1)" value="<?php echo $distance8[0]; ?>"></td>
                <td><input class="distanceInputs first9DistancesInputs_1" type="number" name="distance9_1" min="0" max="1000" oninput="addFirst9Distances(1)" value="<?php echo $distance9[0]; ?>"></td>
                <td id="first9DistancesTotal_1">0</td>
              </tr>
            </table>
            <table id="second9DistancesTable_1">
              <tr>
                <td>Hole</td>
                <td>10</td>
                <td>11</td>
                <td>12</td>
                <td>13</td>
                <td>14</td>
                <td>15</td>
                <td>16</td>
                <td>17</td>
                <td>18</td>
                <td class="nineTotals">In</td>
                <td>Total</td>
              </tr>
              <tr>
              <td>Distance</td>
                <td><input class="distanceInputs second9DistancesInputs_1" type="number" name="distance10_1" min="0" max="1000" oninput="addSecond9Distances(1)" value="<?php echo $distance10[0]; ?>"></td>
                <td><input class="distanceInputs second9DistancesInputs_1" type="number" name="distance11_1" min="0" max="1000" oninput="addSecond9Distances(1)" value="<?php echo $distance11[0]; ?>"></td>
                <td><input class="distanceInputs second9DistancesInputs_1" type="number" name="distance12_1" min="0" max="1000" oninput="addSecond9Distances(1)" value="<?php echo $distance12[0]; ?>"></td>
                <td><input class="distanceInputs second9DistancesInputs_1" type="number" name="distance13_1" min="0" max="1000" oninput="addSecond9Distances(1)" value="<?php echo $distance13[0]; ?>"></td>
                <td><input class="distanceInputs second9DistancesInputs_1" type="number" name="distance14_1" min="0" max="1000" oninput="addSecond9Distances(1)" value="<?php echo $distance14[0]; ?>"></td>
                <td><input class="distanceInputs second9DistancesInputs_1" type="number" name="distance15_1" min="0" max="1000" oninput="addSecond9Distances(1)" value="<?php echo $distance15[0]; ?>"></td>
                <td><input class="distanceInputs second9DistancesInputs_1" type="number" name="distance16_1" min="0" max="1000" oninput="addSecond9Distances(1)" value="<?php echo $distance16[0]; ?>"></td>
                <td><input class="distanceInputs second9DistancesInputs_1" type="number" name="distance17_1" min="0" max="1000" oninput="addSecond9Distances(1)" value="<?php echo $distance17[0]; ?>"></td>
                <td><input class="distanceInputs second9DistancesInputs_1" type="number" name="distance18_1" min="0" max="1000" oninput="addSecond9Distances(1)" value="<?php echo $distance18[0]; ?>"></td>
                <td id="second9DistancesTotal_1">0</td>
                <td id="full18DistancesTotal_1">0</td>
              </tr>
            </table><br>
          </div>
          <button id="addTeeBox" onclick="return addTeeBoxInput()">Add Tee Box</button>
        </div>

        <input id="addSubmit" type="submit" value="Add Course">
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

    <form method="post" action="admin-view-courses.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="viewCoursesSubmit" type="submit">
    </form>

    <!-- JS Code -->
    <script>
      if (document.getElementById("clubNameInput").value != "")
      {
        if (document.getElementById("courseNameInput").value == "")
        {
          document.getElementById("noCourseNameInput").setAttributeNode(document.createAttribute("checked"));
          courseNameDisable(true);
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
      else if ($clubName)
      {
        echo "<script>
                var options = document.getElementById(\"countryInput\").options;
                for (opt of options)
                {
                  if (opt.value == \"", $countryLocation, "\")
                  {
                    opt.setAttributeNode(document.createAttribute(\"selected\"));
                    break;
                  }
                }

                options = document.getElementById(\"numHolesInput\").options;
                for (opt of options)
                {
                  if (opt.value == \"", $numHoles, "\")
                  {
                    opt.setAttributeNode(document.createAttribute(\"selected\"));
                    break;
                  }
                }

                options = document.getElementById(\"yardageUnitsInput\").options;
                for (opt of options)
                {
                  if (opt.value == \"", $yardageUnits, "\")
                  {
                    opt.setAttributeNode(document.createAttribute(\"selected\"));
                    break;
                  }
                }
              </script>";

        if ($courseName == "")
        {
          echo "<script>
                  document.getElementById(\"courseNameInput\").setAttributeNode(document.createAttribute(\"disabled\"));
                </script>";
        }
        
        if ($numTeeBoxes)
        {
          echo "<script>";
          if ($numTeeBoxes > 1)
          {
            echo "  var yardageHtml = document.getElementById(\"yardagesContainer\").innerHTML;
                    var yardageIndex = yardageHtml.indexOf(\"<button id=\\\"addTeeBox\\\"\");
                    var newYardageHtml = yardageHtml.substring(0, yardageIndex);";
            
            for ($i = 1; $i < $numTeeBoxes; $i++)
            {
              echo "numTeeBoxes += 1;
    
                    newYardageHtml += \"<div class=\\\"distanceContainer\\\">\\
                                        Tee&nbsp;Box&nbsp;\" + numTeeBoxes + \"&nbsp;Colour:&nbsp;<span id=\\\"colourWarning_\" + numTeeBoxes + \"\\\" class=\\\"warning\\\"></span><br>\\
                                        <input id=\\\"teeBoxColourInput_\" + numTeeBoxes + \"\\\" class=\\\"colourInputs\\\" type=\\\"text\\\" name=\\\"colour_\" + numTeeBoxes + \"\\\" value=\\\"", $colour[$i], "\\\">&nbsp;\\
                                        <button class=\\\"deleteTeeBox\\\" onclick=\\\"return deleteTeeBoxInput(\" + numTeeBoxes + \")\\\">Delete Tee Box</button>&nbsp;<span id=\\\"distancesWarning_\" + numTeeBoxes + \"\\\" class=\\\"warning\\\"></span><br>\\
                                        <table>\\
                                          <tr>\\
                                            <td>Hole</td>\\
                                            <td>1</td>\\
                                            <td>2</td>\\
                                            <td>3</td>\\
                                            <td>4</td>\\
                                            <td>5</td>\\
                                            <td>6</td>\\
                                            <td>7</td>\\
                                            <td>8</td>\\
                                            <td>9</td>\\
                                            <td class=\\\"nineTotals\\\">Out</td>\\
                                          </tr>\\
                                          <tr>\\
                                            <td>Distance</td>\\
                                            <td><input class=\\\"distanceInputs first9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance1_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addFirst9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance1[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs first9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance2_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addFirst9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance2[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs first9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance3_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addFirst9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance3[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs first9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance4_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addFirst9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance4[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs first9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance5_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addFirst9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance5[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs first9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance6_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addFirst9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance6[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs first9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance7_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addFirst9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance7[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs first9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance8_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addFirst9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance8[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs first9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance9_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addFirst9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance9[$i], "\\\"></td>\\
                                            <td id=\\\"first9DistancesTotal_\" + numTeeBoxes + \"\\\">0</td>\\
                                          </tr>\\
                                        </table>\\
                                        <table id=\\\"second9DistancesTable_\" + numTeeBoxes + \"\\\">\\
                                          <tr>\\
                                            <td>Hole</td>\\
                                            <td>10</td>\\
                                            <td>11</td>\\
                                            <td>12</td>\\
                                            <td>13</td>\\
                                            <td>14</td>\\
                                            <td>15</td>\\
                                            <td>16</td>\\
                                            <td>17</td>\\
                                            <td>18</td>\\
                                            <td class=\\\"nineTotals\\\">In</td>\\
                                            <td>Total</td>\\
                                          </tr>\\
                                          <tr>\\
                                          <td>Distance</td>\\
                                            <td><input class=\\\"distanceInputs second9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance10_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addSecond9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance10[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs second9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance11_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addSecond9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance11[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs second9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance12_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addSecond9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance12[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs second9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance13_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addSecond9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance13[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs second9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance14_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addSecond9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance14[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs second9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance15_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addSecond9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance15[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs second9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance16_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addSecond9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance16[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs second9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance17_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addSecond9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance17[$i], "\\\"></td>\\
                                            <td><input class=\\\"distanceInputs second9DistancesInputs_\" + numTeeBoxes + \"\\\" type=\\\"number\\\" name=\\\"distance18_\" + numTeeBoxes + \"\\\" min=\\\"0\\\" max=\\\"1000\\\" oninput=\\\"addSecond9Distances(\" + numTeeBoxes + \")\\\" value=\\\"", $distance18[$i], "\\\"></td>\\
                                            <td id=\\\"second9DistancesTotal_\" + numTeeBoxes + \"\\\">0</td>\\
                                            <td id=\\\"full18DistancesTotal_\" + numTeeBoxes + \"\\\">0</td>\\
                                          </tr>\\
                                        </table><br>\\
                                      </div>\";";
            }
            
            echo "  newYardageHtml += yardageHtml.substring(yardageIndex);
                    document.getElementById(\"yardagesContainer\").innerHTML = newYardageHtml;";
          }
          echo "  changeNumHoles(document.getElementById(\"numHolesInput\").value);
                  addAllParsAndDistances();
                </script>";
        }
      }
    ?>
  </body>
</html>
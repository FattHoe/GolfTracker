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
      function checkInput()
      {
        var inputValid = true;
        var date = new Date();
        var warnings = document.getElementsByClassName("warning");
        var mobile;
        var dob;

        for (w of warnings)
        {
          w.innerHTML = "";
        }

        if (document.getElementById("firstNameInput").value == "")
        {
          inputValid = false;
          document.getElementById("firstNameWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("lastNameInput").value == "")
        {
          inputValid = false;
          document.getElementById("lastNameWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (!document.getElementById("myKadInput").checked && !document.getElementById("passportInput").checked && !document.getElementById("noIdInput").checked)
        {
          inputValid = false;
          document.getElementById("idWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if ((document.getElementById("myKadInput").checked || document.getElementById("passportInput").checked) && document.getElementById("idInput").value == "")
        {
          inputValid = false;
          document.getElementById("idWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }
        else if (document.getElementById("myKadInput").checked)
        {
          var myKadNumbers = document.getElementById("idInput").value.split("-");
          
          if (!isNumeric(myKadNumbers[0]) || myKadNumbers[0].length != 6)
          {
            inputValid = false;
            document.getElementById("idWarning").innerHTML = "<b>*&nbsp;Invalid</b>&nbsp;(XXXXXX-XX-XXXX)";
          }
          else if (!isNumeric(myKadNumbers[1]) || myKadNumbers[1].length != 2)
          {
            inputValid = false;
            document.getElementById("idWarning").innerHTML = "<b>*&nbsp;Invalid</b>&nbsp;(XXXXXX-XX-XXXX)";
          }
          else if (!isNumeric(myKadNumbers[2]) || myKadNumbers[2].length != 4)
          {
            inputValid = false;
            document.getElementById("idWarning").innerHTML = "<b>*&nbsp;Invalid</b>&nbsp;(XXXXXX-XX-XXXX)";
          }
          else
          {
            if (document.getElementById("dobInput").value != "")
            {
              dob = document.getElementById("dobInput").value.split("-");
              if (myKadNumbers[0].substr(0, 2) != dob[0].substr(2) || myKadNumbers[0].substr(2, 2) != dob[1] || myKadNumbers[0].substr(4) != dob[2])
              {
                inputValid = false;
                document.getElementById("idWarning").innerHTML = "<b>*&nbsp;Must&nbsp;Match&nbsp;Date&nbsp;of&nbsp;Birth</b>";
              }
            }
          }
        }

        if (document.getElementById("dobInput").value == "")
        {
          inputValid = false;
          document.getElementById("dobWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }
        else
        {
          dob = document.getElementById("dobInput").value.split("-");

          if (date.getFullYear() < (parseInt(dob[0]) + MIN_AGE))
          {
            inputValid = false;
            document.getElementById("dobWarning").innerHTML = "<b>*&nbsp;Too&nbsp;Young</b>";
          }
        }
        
        if (!document.getElementById("maleInput").checked && !document.getElementById("femaleInput").checked)
        {
          inputValid = false;
          document.getElementById("genderWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("addressInput").value == "" && !document.getElementById("noAddressInput").checked)
        {
          inputValid = false;
          document.getElementById("addressWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("countryInput").value == "")
        {
          inputValid = false;
          document.getElementById("countryWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        var emailValid = false;
        var emailIndex1 = document.getElementById("emailInput").value.indexOf("@");
        if (emailIndex1 > 0)
        {
          var emailIndex2 = document.getElementById("emailInput").value.indexOf(".", emailIndex1);
          if (emailIndex2 > (emailIndex1 + 1))
          {
            emailValid = true;
          }
        }

        if (!emailValid)
        {
          inputValid = false;
          document.getElementById("emailWarning").innerHTML = "<b>*&nbsp;Invalid</b>";
        }

        if (document.getElementById("emailInput").value == "")
        {
          inputValid = false;
          document.getElementById("emailWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("mobileInput").value == "" && !document.getElementById("noMobileInput").checked)
        {
          inputValid = false;
          document.getElementById("mobileWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }
        else if (!document.getElementById("noMobileInput").checked)
        {
          mobile = document.getElementById("mobileInput").value.split(" ");

          if (mobile.length == 1 && !isNumeric(mobile[0]))
          {
            inputValid = false;
            document.getElementById("mobileWarning").innerHTML = "<b>*&nbsp;Invalid</b>&nbsp;(+XX&nbsp;XXXXXXXXX&nbsp;/&nbsp;XXXXXXXXXX)";
          }
          else if (mobile.length == 2 && (mobile[0].length < 2 || mobile[1].length == 0 || mobile[0][0] != "+" || !isNumeric(mobile[0].substr(1)) || !isNumeric(mobile[1])))
          {
            inputValid = false;
            document.getElementById("mobileWarning").innerHTML = "<b>*&nbsp;Invalid</b>&nbsp;(+XX&nbsp;XXXXXXXXX&nbsp;/&nbsp;XXXXXXXXXX)";
          }
          else if (mobile.length > 2)
          {
            inputValid = false;
            document.getElementById("mobileWarning").innerHTML = "<b>*&nbsp;Invalid</b>&nbsp;(+XX&nbsp;XXXXXXXXX&nbsp;/&nbsp;XXXXXXXXXX)";
          }
        }

        if (document.getElementById("handicapInput").value == "" && !document.getElementById("noHandicapInput").checked)
        {
          inputValid = false;
          document.getElementById("handicapWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("nhsInput").value == "" && !document.getElementById("noHandicapInput").checked)
        {
          inputValid = false;
          document.getElementById("nhsWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("homeClubInput").value == "" && !document.getElementById("noHomeClubInput").checked)
        {
          inputValid = false;
          document.getElementById("homeClubWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("guardianNameInput").value == "")
        {
          inputValid = false;
          document.getElementById("guardianNameWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (document.getElementById("guardianMobileInput").value == "")
        {
          inputValid = false;
          document.getElementById("guardianMobileWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }
        else
        {
          mobile = document.getElementById("guardianMobileInput").value.split(" ");

          if (mobile.length == 1 && !isNumeric(mobile[0]))
          {
            inputValid = false;
            document.getElementById("guardianMobileWarning").innerHTML = "<b>*&nbsp;Invalid</b>&nbsp;(+XX&nbsp;XXXXXXXXX&nbsp;/&nbsp;XXXXXXXXXX)";
          }
          else if (mobile.length == 2 && (mobile[0].length < 2 || mobile[1].length == 0 || mobile[0][0] != "+" || !isNumeric(mobile[0].substr(1)) || !isNumeric(mobile[1])))
          {
            inputValid = false;
            document.getElementById("guardianMobileWarning").innerHTML = "<b>*&nbsp;Invalid</b>&nbsp;(+XX&nbsp;XXXXXXXXX&nbsp;/&nbsp;XXXXXXXXXX)";
          }
          else if (mobile.length > 2)
          {
            inputValid = false;
            document.getElementById("guardianMobileWarning").innerHTML = "<b>*&nbsp;Invalid</b>&nbsp;(+XX&nbsp;XXXXXXXXX&nbsp;/&nbsp;XXXXXXXXXX)";
          }
        }

        if (((!document.getElementById("mensCutInput").checked && !document.getElementById("ladiesCutInput").checked) || (!document.getElementById("xsSizeInput").checked && !document.getElementById("sSizeInput").checked && !document.getElementById("mSizeInput").checked && !document.getElementById("lSizeInput").checked && !document.getElementById("xlSizeInput").checked && !document.getElementById("xxlSizeInput").checked)) && !document.getElementById("noTShirtInput").checked)
        {
          inputValid = false;
          document.getElementById("tShirtWarning").innerHTML = "<b>*&nbsp;Required</b>";
        }

        if (inputValid)
        {
          var luDate = date.getFullYear().toString() + "-" + (date.getMonth() + 1) + "-" + date.getDate();

          document.getElementById("lastUpdatedDateInput").value = luDate;
        }

        return inputValid;
      }

      function isNumeric(str)
      {
        for (var i = 0; i < str.length; i++)
        {
          if (str.charCodeAt(i) < 48 || str.charCodeAt(i) > 57)
          {
            return false;
          }
        }

        return true;
      }

      function addressDisable(naChecked)
      {
        if (naChecked)
        {
          document.getElementById("addressInput").setAttributeNode(document.createAttribute("disabled"));
        }
        else
        {
          document.getElementById("addressInput").removeAttribute("disabled");
        }

        return;
      }

      function mobileDisable(naChecked)
      {
        if (naChecked)
        {
          document.getElementById("mobileInput").setAttributeNode(document.createAttribute("disabled"));
        }
        else
        {
          document.getElementById("mobileInput").removeAttribute("disabled");
        }

        return;
      }

      function handicapDisable(naChecked)
      {
        if (naChecked)
        {
          document.getElementById("handicapInput").setAttributeNode(document.createAttribute("disabled"));
          document.getElementById("nhsInput").setAttributeNode(document.createAttribute("disabled"));
        }
        else
        {
          document.getElementById("handicapInput").removeAttribute("disabled");
          document.getElementById("nhsInput").removeAttribute("disabled");
        }

        return;
      }

      function homeClubDisable(naChecked)
      {
        if (naChecked)
        {
          document.getElementById("homeClubInput").setAttributeNode(document.createAttribute("disabled"));
        }
        else
        {
          document.getElementById("homeClubInput").removeAttribute("disabled");
        }

        return;
      }

      function tShirtDisable(naChecked)
      {
        var radios = document.getElementsByClassName("tShirtRadios");
        if (naChecked)
        {
          for (rad of radios)
          {
            rad.setAttributeNode(document.createAttribute("disabled"));
          }
        }
        else
        {
          for (rad of radios)
          {
            rad.removeAttribute("disabled");
          }
        }

        return;
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
        left: 450px;
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

      #viewPlayersButton
      {
        background-color: gold;
        margin: 0;
        position: absolute;
        top: 5px;
        left: 5px;
        width: 150px;
        z-index: 2;
      }

      #viewPlayersButton:hover
      {
        background-color: orange;
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

      #addressInput
      {
        width: 300px;
      }

      #countryInput
      {
        height: 23px;
      }

      #mobileInput, #guardianMobileInput
      {
        width: 210px;
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
      $firstName = "";
      $lastName = "";
      $idOption = "";
      $myKadNumber = "";
      $passportNumber = "";
      $dateOfBirth = "";
      $gender = "";
      $homeAddress = "";
      $country = "";
      $email = "";
      $mobileNumber = "";
      $handicap = "";
      $nhsNumber = "";
      $homeClub = "";
      $guardianName = "";
      $guardianMobileNumber = "";
      $tShirtSize = "";
      $tShirtCut = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["username"])
      {
        $username = validateInput($_POST["username"]);
        $authenticated = true;

        if ($_POST["firstName"])
        {
          $firstName = validateInput($_POST["firstName"]);
          $lastName = validateInput($_POST["lastName"]);

          $idOption = validateInput($_POST["idOption"]);
          if ($idOption == "M")
          {
            $myKadNumber = validateInput($_POST["idNumber"]);
          } else if ($idOption == "P")
          {
            $passportNumber = validateInput($_POST["idNumber"]);
          }

          $dateOfBirth = validateInput($_POST["dateOfBirth"]);
          $gender = validateInput($_POST["gender"]);
          $homeAddress = validateInput($_POST["homeAddress"]);
          $country = validateInput($_POST["country"]);
          $email = validateInput($_POST["email"]);
          $mobileNumber = validateInput($_POST["mobileNumber"]);
          $handicap = validateInput($_POST["handicap"]);
          $nhsNumber = validateInput($_POST["nhsNumber"]);
          $homeClub = validateInput($_POST["homeClub"]);
          $guardianName = validateInput($_POST["guardianName"]);
          $guardianMobileNumber = validateInput($_POST["guardianMobileNumber"]);
          $tShirtSize = validateInput($_POST["tShirtSize"]);
          $tShirtCut = validateInput($_POST["tShirtCut"]);
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

    <button id="viewPlayersButton" onclick="document.getElementById('viewPlayersSubmit').click()">Back to View Players</button>

    <div id="titleBanner">
      <h1 id="title">Add&nbsp;Player</h1>
    </div>

    <div id="formContainer">
      <form id="form" method="post" action="check-player.php" onsubmit="return checkInput()">
        <input type="text" name="username" value="<?php echo $username; ?>" hidden>
        <input id="lastUpdatedDateInput" type="text" name="lastUpdatedDate" hidden>
        
        <div class="inputContainer">
          First&nbsp;Name:&nbsp;<span id="firstNameWarning" class="warning"></span><br>
          <input id="firstNameInput" type="text" name="firstName" value="<?php echo $firstName; ?>">

          <div class="secondColumnInputContainer">
            Last&nbsp;Name:&nbsp;<span id="lastNameWarning" class="warning"></span><br>
            <input id="lastNameInput" type="text" name="lastName" value="<?php echo $lastName; ?>">
          </div>
        </div>

        <div class="inputContainer">
          MyKad/Passport&nbsp;Number:&nbsp;<span id="idWarning" class="warning"></span><br>
          <input id="myKadInput" type="radio" name="idOption" onclick="document.getElementById('idInput').removeAttribute('disabled'); document.getElementById('idInput').placeholder = 'Eg: 000123-45-6789';" value="M"<?php if ($idOption == "M") { echo " checked"; } ?>>
          <label for="myKadInput">MyKad</label>&nbsp;
          <input id="passportInput" type="radio" name="idOption" onclick="document.getElementById('idInput').removeAttribute('disabled'); document.getElementById('idInput').placeholder = '';" value="P"<?php if ($idOption == "P") { echo " checked"; } ?>>
          <label for="passportInput">Passport</label>&nbsp;
          <input id="noIdInput" type="radio" name="idOption" onclick="document.getElementById('idInput').setAttributeNode(document.createAttribute('disabled')); document.getElementById('idInput').placeholder = '';" value="N"<?php if ($idOption == "N") { echo " checked"; } ?>>
          <label for="noIdInput">N/A</label><br>
          <input id="idInput" type="text" name="idNumber" value="<?php echo $myKadNumber, $passportNumber; ?>">
        </div>

        <div class="inputContainer">
          Date&nbsp;of&nbsp;Birth:&nbsp;<span id="dobWarning" class="warning"></span><br>
          <input id="dobInput" type="date" name="dateOfBirth" value="<?php echo $dateOfBirth; ?>">

          <div class="secondColumnInputContainer">
            Gender:&nbsp;<span id="genderWarning" class="warning"></span><br>
            <input id="maleInput" type="radio" name="gender" value="M"<?php if ($gender == "M") { echo " checked"; } ?>>
            <label for="maleInput">Male</label>&nbsp;
            <input id="femaleInput" type="radio" name="gender" value="F"<?php if ($gender == "F") { echo " checked"; } ?>>
            <label for="femaleInput">Female</label>
          </div>
        </div>

        <div class="inputContainer">
          Address:&nbsp;<span id="addressWarning" class="warning"></span><br>
          <input id="addressInput" type="text" name="homeAddress" value="<?php echo $homeAddress; ?>">
          <input id="noAddressInput" type="checkbox" onclick="addressDisable(this.checked)">
          <label for="noAddressInput">N/A</label>

          <div class="secondColumnInputContainer">
            Country:&nbsp;<span id="countryWarning" class="warning"></span><br>
            <select id="countryInput" name="country">
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
          Email:&nbsp;<span id="emailWarning" class="warning"></span><br>
          <input id="emailInput" type="text" name="email" value="<?php echo $email; ?>">

          <div class="secondColumnInputContainer">
            Mobile&nbsp;Number:&nbsp;<span id="mobileWarning" class="warning"></span><br>
            <input id="mobileInput" type="text" name="mobileNumber" placeholder="Eg: +60 123456789 / 0123456789" value="<?php echo $mobileNumber; ?>">
            <input id="noMobileInput" type="checkbox" onclick="mobileDisable(this.checked)">
            <label for="noMobileInput">N/A</label>
          </div>
        </div>

        <div class="inputContainer">
          Handicap&nbsp;Index:&nbsp;<span id="handicapWarning" class="warning"></span><br>
          <input id="handicapInput" type="number" name="handicap" min="-18" max="72" step="0.1" value="<?php echo $handicap; ?>">&nbsp;
          <input id="noHandicapInput" type="checkbox" onclick="handicapDisable(this.checked)">
          <label for="noHandicapInput">N/A</label>

          <div class="secondColumnInputContainer">
            NHS&nbsp;Number:&nbsp;<span id="nhsWarning" class="warning"></span><br>
            <input id="nhsInput" type="number" name="nhsNumber" min="1" value="<?php echo $nhsNumber; ?>">
          </div>
        </div>

        <div class="inputContainer">
          Home&nbsp;Club:&nbsp;<span id="homeClubWarning" class="warning"></span><br>
          <input id="homeClubInput" type="text" name="homeClub" value="<?php echo $homeClub; ?>">
          <input id="noHomeClubInput" type="checkbox" onclick="homeClubDisable(this.checked)">
          <label for="noHomeClubInput">N/A</label>
        </div>

        <div class="inputContainer">
          Parent/Guardian&nbsp;Name:&nbsp;<span id="guardianNameWarning" class="warning"></span><br>
          <input id="guardianNameInput" type="text" name="guardianName" value="<?php echo $guardianName; ?>">

          <div class="secondColumnInputContainer">
            Parent/Guardian&nbsp;Mobile&nbsp;Number:&nbsp;<span id="guardianMobileWarning" class="warning"></span><br>
            <input id="guardianMobileInput" type="text" name="guardianMobileNumber" placeholder="Eg: +60 123456789 / 0123456789" value="<?php echo $guardianMobileNumber; ?>">
          </div>
        </div>

        <div id="tShirtContainer" class="inputContainer">
          T-Shirt&nbsp;Size:&nbsp;<span id="tShirtWarning" class="warning"></span><br>
          <input id="mensCutInput" class="tShirtRadios" type="radio" name="tShirtCut" value="M"<?php if ($tShirtCut == "M") { echo " checked"; } ?>>
          <label for="mensCutInput">Men's&nbsp;Cut</label>&nbsp;
          <input id="ladiesCutInput" class="tShirtRadios" type="radio" name="tShirtCut" value="F"<?php if ($tShirtCut == "F") { echo " checked"; } ?>>
          <label for="ladiesCutInput">Ladies'&nbsp;Cut</label>&nbsp;
          <input id="noTShirtInput" type="checkbox" onclick="tShirtDisable(this.checked)">
          <label for="noTShirtInput">N/A</label><br>
          <input id="xsSizeInput" class="tShirtRadios" type="radio" name="tShirtSize" value="XS"<?php if ($tShirtSize == "XS") { echo " checked"; } ?>>
          <label for="xsSizeInput">XS</label>&nbsp;
          <input id="sSizeInput" class="tShirtRadios" type="radio" name="tShirtSize" value="S"<?php if ($tShirtSize == "S") { echo " checked"; } ?>>
          <label for="sSizeInput">S</label>&nbsp;
          <input id="mSizeInput" class="tShirtRadios" type="radio" name="tShirtSize" value="M"<?php if ($tShirtSize == "M") { echo " checked"; } ?>>
          <label for="mSizeInput">M</label>&nbsp;
          <input id="lSizeInput" class="tShirtRadios" type="radio" name="tShirtSize" value="L"<?php if ($tShirtSize == "L") { echo " checked"; } ?>>
          <label for="lSizeInput">L</label>&nbsp;
          <input id="xlSizeInput" class="tShirtRadios" type="radio" name="tShirtSize" value="XL"<?php if ($tShirtSize == "XL") { echo " checked"; } ?>>
          <label for="xlSizeInput">XL</label>&nbsp;
          <input id="xxlSizeInput" class="tShirtRadios" type="radio" name="tShirtSize" value="XXL"<?php if ($tShirtSize == "XXL") { echo " checked"; } ?>>
          <label for="xxlSizeInput">XXL</label>
        </div>

        <input id="addSubmit" type="submit" value="Add Player">
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

    <form method="post" action="admin-view-players.php" hidden>
      <input type="text" name="username" value="<?php echo $username; ?>">
      <input id="viewPlayersSubmit" type="submit">
    </form>

    <!-- JS Code -->
    <script>
      if (document.getElementById("firstNameInput").value != "")
      {
        if (document.getElementById("noIdInput").checked)
        {
          document.getElementById("idInput").setAttributeNode(document.createAttribute("disabled"));
        }

        if (document.getElementById("addressInput").value == "")
        {
          document.getElementById("noAddressInput").setAttributeNode(document.createAttribute("checked"));
          addressDisable(true);
        }
        
        if (document.getElementById("mobileInput").value == "")
        {
          document.getElementById("noMobileInput").setAttributeNode(document.createAttribute("checked"));
          mobileDisable(true);
        }

        if (document.getElementById("handicapInput").value == "")
        {
          document.getElementById("noHandicapInput").setAttributeNode(document.createAttribute("checked"));
          handicapDisable(true);
        }

        if (document.getElementById("homeClubInput").value == "")
        {
          document.getElementById("noHomeClubInput").setAttributeNode(document.createAttribute("checked"));
          homeClubDisable(true);
        }

        if (!document.getElementById("mensCutInput").checked && !document.getElementById("ladiesCutInput").checked)
        {
          document.getElementById("noTShirtInput").setAttributeNode(document.createAttribute("checked"));
          tShirtDisable(true);
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
      else
      {
        echo "<script>
                var countries = document.getElementById(\"countryInput\").options;
                for (opt of countries)
                {
                  if (opt.value == \"", $country, "\")
                  {
                    opt.setAttributeNode(document.createAttribute(\"selected\"));
                    break;
                  }
                }
              </script>";
      }
    ?>
  </body>
</html>
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
    <script>
    </script>

    <!-- CSS Style Definitions -->
    <style media="screen">
    </style>
  </head>

  <body>
    <!-- PHP Database Operations -->
    <?php
      include "connection.php";
      include "validateInput.php";

      $conn = openConn();

      $tId = "";

      if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["tournamentID"])
      {
        $tId = int(validateInput($_GET["tournamentID"]));
      }

      closeConn($conn);
    ?>

    <!-- User Interface -->
    <h1 id="test"></h1>

    <!-- PHP Outputs to JS Code -->
    <?php
      if ($tId)
      {
        echo "<script>
                document.getElementById(\"test\").innerHTML = \"Tournament ID: ", $tId, "\";
              </script>";
      }
    ?>
  </body>
</html>
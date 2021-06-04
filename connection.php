<?php
  function openConn()
  {
    $dbHost = "sql207.epizy.com";
    $dbUser = "epiz_28798540";
    $dbPass = "OtSen3SR5zC";
    $dbName = "epiz_28798540_Main";
    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    if(!$conn)
    {
      die("Connection to Database Failed: %s\n" . $conn->error);
    }
    return $conn;
  }
  
  function closeConn($conn)
  {
    $conn->close();
  }
?>
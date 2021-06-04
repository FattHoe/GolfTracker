<?php
  function openConn()
  {
    $dbHost = "sql204.epizy.com";
    $dbUser = "epiz_27287764";
    $dbPass = "bvrUCF1l73lyWT";
    $dbName = "epiz_27287764_Main";
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
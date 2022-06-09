<?php
  @session_start();
  $serverid = "localhost";
  $user = "root";
  $password = "";
  $dbname = "eshopper";

  $conn = mysqli_connect($serverid, $user, $password, $dbname);
  if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
  }
?>
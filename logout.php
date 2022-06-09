<?php

require "./includes/conn.php";
if(isset($_SESSION)){
  session_destroy();
  header("location: ./login.php");

  mysqli_close($conn);
}

?>
<?php
  require './../includes/conn.php';
  if(isset($_SESSION['username'])) {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $id = $_POST['id'];
      $sql = "DELETE FROM variant WHERE id = '$id'";
      $result = mysqli_query($conn, $sql);
      if($result) {
        $sql = "DELETE FROM variant_details WHERE vid = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result) {
          echo 'success';
          exit;
        } else {
          echo 'error';
          exit;
        }
      } else {
        echo 'error';
        exit;
      }
    }
  } else {
    echo 'Please Login to Continue';
    header('Location: login.php');
    exit;
  }
?>
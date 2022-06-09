<?php
  require './../includes/conn.php';
  if(isset($_SESSION['username'])) {
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
      $id = $_POST['id'];
      $status = $_POST['status'];
      $table = $_POST['table'];
      $sql = 'UPDATE '.$table.' SET status = '.$status.' WHERE id = '.$id;
      $result = mysqli_query($conn, $sql);
      if($result) {
        echo "success";
        exit;
      } else {
        echo "error";
        exit;
      }
    }
  } else {
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "You must be logged in to access this page.";
    header('Location: login.php');
    exit;
  }
?>
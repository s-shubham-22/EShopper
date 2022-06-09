<?php
  require './../includes/conn.php';
  if(isset($_SESSION['username'])){
    $id = $_POST['id'];
    $sql = "SELECT * FROM brand WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $img_name = $row['img_name'];
    $sql = "DELETE FROM brand WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if($result) {
      unlink("uploads/brand/".$img_name);
      echo 'success';
      exit;
    } else {
      echo 'error';
      exit;
    }
  } else {
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "Please login to continue.";
    header('Location: login.php');
    exit;
  }
?>
<?php
  require './../includes/conn.php';
  if(isset($_SESSION['username'])){
    $id = $_POST['id'];
    $sql = "SELECT * FROM product WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $img_name = $row['img_name'];
    $sql = "DELETE FROM product WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if($result) {
      unlink("uploads/product/".$img_name);
      $sql = "SELECT * FROM product_variant WHERE pid = '$id'";
      $result = mysqli_query($conn, $sql);
      while($row = mysqli_fetch_assoc($result)){
        $vid = $row['id'];
        $sql2 = "SELECT * FROM product_variant WHERE id = '$vid'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $img_name = $row2['img_name'];
        $sql2 = "DELETE FROM product_variant WHERE id = '$vid'";
        $result2 = mysqli_query($conn, $sql2);
        if($result2) {
          unlink("uploads/product_variant/".$img_name);
        }
      }
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
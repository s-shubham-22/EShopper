<?php
  require './../includes/conn.php';

  if(isset($_SESSION['username'])) {
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['address'])) {
      if(isset($_POST['id'])) {
        $id = $_POST['id'];
      } else {
        $id = 1;
      }
      $email = $_POST['email'];
      $mobile = $_POST['mobile'];
      $address = $_POST['address'];
      $sql = "SELECT * FROM contact WHERE id = $id";
      $result = mysqli_query($conn, $sql);
      if($result &&  mysqli_num_rows($result) > 0) {
        $sql = 'UPDATE contact SET email = "'.$email.'", mobile = "'.$mobile.'", address = "'.$address.'" WHERE id = '.$id;
      } else {
        // $sql = "INSERT INTO contact (email, mobile, address) VALUES ('".$email."', '".$mobile."', '".$address."')";
        $sql = 'INSERT INTO contact (email, mobile, address) VALUES ("'.$email.'", "'.$mobile.'", "'.$address.'")';
      }
      $result = mysqli_query($conn, $sql);
      if($result) {
        $_SESSION['success'] = 1;
        $_SESSION['successmsg'] = "Contact details updated successfully.";
      } else {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = "Error updating contact details.";
      }
      header("Location: contact.php");
    } else {
      $_SESSION['err'] = 1;
      $_SESSION['errmsg'] = 'Invalid Request';
      header('Location: contact.php');
      exit();
    }
  } else {
    $_SESSION['success'] = 0;
    $_SESSION['successmsg'] = "";
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "Please login first.";
    header('Location: ./login.php');
    exit;
  }
?>
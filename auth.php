<?php

require "./includes/conn.php";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    // print_r($row);
    echo $row['username']. "<br>";
    echo $row['password'];
    if(password_verify($password, $row['password'])) {
      $sql = "UPDATE users SET lastlogin = now() WHERE username = '$username'";
      $result = mysqli_query($conn, $sql);
      $_SESSION['success'] = 1;
      $_SESSION['successmsg'] = 'Login Successful!';
      $_SESSION['username'] = $username;
      $_SESSION['id'] = $row['id'];
      header("Location: ./index.php");
    } else {
      $_SESSION['err'] = 1;
      $_SESSION['errmsg'] = "Invalid Username or Password";
      header("Location: ./login.php");
    }
  } else {
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "User not found!";
    header("Location: ./login.php");
  }
  mysqli_close($conn);
}

?>
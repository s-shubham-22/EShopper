<?php
  require './../includes/conn.php';
  $username = $_POST['username'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM admin WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row['password'])){
      if(isset($_POST['remember']) && $_POST['remember'] == 1) {
        setcookie('username', $username, time() + (86400 * 30), "/");
        setcookie('password', $password, time() + (86400 * 30), "/");
        echo 'Cookie has been set.';
      }
      session_start();
      $_SESSION['id'] = $row['id'];
      $_SESSION['username'] = $username;
      header("Location: index.php");
      exit;
    } else {
      echo 'Invalid Username or Password.';
      exit;
    }
  } else {
    echo "No user found";
    exit;
  }
?>
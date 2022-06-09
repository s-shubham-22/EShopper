<?php

require "./includes/conn.php";

function checkPassword($password) {
  if(strlen($password) < 8) {
    return false;
  }
  if(!preg_match("#[0-9]+#", $password)) {
    return false;
  }
  if(!preg_match("#[a-z]+#", $password)) {
    return false;
  }
  if(!preg_match("#[A-Z]+#", $password)) {
    return false;
  }
  return true;
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
  $username = $_POST['username'];
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $mobile = $_POST['mobile'];
  $email = $_POST['email'];
  $gender = $_POST['gender'];
  $address = $_POST['address'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email' OR mobile = '$mobile'";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result) > 0){
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "Username / Email ID / Mobile No. already exists!";
    header("Location: ./signup.php");
  } else {
    if($password == $cpassword){
      if(checkPassword($password)){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, fname, lname, mobile, email, gender, address, password) VALUES ('$username', '$fname', '$lname', '$mobile', '$email', '$gender', '$address', '$password')";
        $result = mysqli_query($conn, $sql);
        if($result){
          $_SESSION['loggedin'] = true;
          $_SESSION['username'] = $username;
          $_SESSION['sno'] = mysqli_insert_id($conn);
          header("Location: ./index.php");
        } else {
          $_SESSION['err'] = 1;
          $_SESSION['errmsg'] = "Something went wrong!";
          header("Location: ./signup.php");
        }
      } else {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = "Password must contain at least one uppercase letter, one lowercase letter, one number, and be at least 8 characters long!";
        header("Location: ./register.php");
      }
    } else {
      $_SESSION['err'] = 1;
      $_SESSION['errmsg'] = "Both Password doesn't match";
      header("Location: ./register.php");
    }
  }

  
  mysqli_close($conn);
}


?>
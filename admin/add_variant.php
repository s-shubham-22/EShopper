<?php
  require './../includes/conn.php';
  if(isset($_SESSION['username'])) {
    if(isset($_POST['title']) && isset($_POST['type']) && isset($_POST['v_value'])) {
      $title = $_POST['title'];
      $type = $_POST['type'];
      $v_value = $_POST['v_value'];
      $slug = create_slug($title);
      $sql = "SELECT * FROM variant WHERE slug = '$slug'";
      $result = mysqli_query($conn, $sql);
      if($result && mysqli_num_rows($result) > 0) {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = 'Variant already exists';
        header('Location: variant.php');
        exit;
      }      
      $sql = "INSERT INTO variant (title, type, slug) VALUES ('$title', '$type', '$slug')";
      $result = mysqli_query($conn, $sql);
      if($result) {
        $vid = mysqli_insert_id($conn);
        foreach($v_value as $value) {
          $sql = "INSERT INTO variant_details (vid, type, v_value) VALUES ('$vid', '$type', '$value')";
          $result = mysqli_query($conn, $sql);
          if(!$result) {
            $_SESSION['err'] = 1;
            $_SESSION['errmsg'] = 'Variant Value Insertion Failed';
            header("Location: variant.php");
            exit;
          }
        }
        $_SESSION['success'] = 1;
        $_SESSION['successmsg'] = 'Variant Added Successfully';
        header("Location: list_variant.php");
        exit;
      } else {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = 'Variant Value Insertion Failed';
        header("Location: variant.php");
        exit;
      }
    }
  } else {
    echo 'Please Login to Continue!';
    header('Location: ./login.php');
    exit;
  }

  function create_slug($string){
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    $slug = strtolower($slug);
    return $slug;
  }
?>
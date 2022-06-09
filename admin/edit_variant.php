<?php
  require './../includes/conn.php';
  if(isset($_SESSION['username'])) {
    if($_SERVER['REQUEST_METHOD'] = 'POST') {
      $v_id = $_POST['v_id'];
      $title = $_POST['title'];
      $slug = create_slug($title);
      $type = $_POST['type'];
      $id = $_POST['id'];
      $v_value = $_POST['v_value'];
      $diff = array();
      $sql = "SELECT * FROM variant WHERE slug = '$slug' AND id != '$v_id'";
      $result = mysqli_query($conn, $sql);
      if($result && mysqli_num_rows($result) > 0) {
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = 'Variant already exists';
        header('Location: variant_edit.php?id='.$v_id);
        exit;
      }
      $sql = 'SELECT * FROM variant_details WHERE vid = '.$v_id;
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      while($row = mysqli_fetch_assoc($result)) {
        if(!in_array($row['id'], $id)) {
          $diff[] = $row['id'];
        }
      }
      print_r($diff);
      $i = 0;
      while($i < count($id)) {
        $sql = "UPDATE variant_details SET v_value = '$v_value[$i]' WHERE id = '$id[$i]'";
        $result = mysqli_query($conn, $sql);
        $i++;
      }
      while($i < count($v_value)) {
        $sql = "INSERT INTO variant_details (vid, type, v_value) VALUES ('$v_id', '$type', '$v_value[$i]')";
        $result = mysqli_query($conn, $sql);
        $i++;
      }
      $i = 0;
      while($i < count($diff)) {
        $sql = "DELETE FROM variant_details WHERE id = '$diff[$i]'";
        $result = mysqli_query($conn, $sql);
        $i++;
      }
      $sql = "UPDATE variant SET title = '$title', slug = '$slug' WHERE id = '$v_id'";
      header('Location: list_variant.php');
    } else {
      echo 'Invalid Request';
      header('Location: ./variant.php');
    }
  } else {
      header("Location: login.php");
    exit;
  }

  function create_slug($string){
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    $slug = strtolower($slug);
    return $slug;
  }
?>
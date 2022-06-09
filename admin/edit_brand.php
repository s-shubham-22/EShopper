<?php
  require './../includes/conn.php';

  if(isset($_SESSION['username'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    if(isset($_POST['img_name'])) {
      $img_name = $_POST['img_name'];
    } else {
      $img_name = "";
    }
    $slug = create_slug($title);
    if(isset($_POST['status'])) {
      $status = $_POST['status'];
    } else {
      $status = 0;
    }
    $sql = "SELECT * FROM brand WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1) {
      $slug = create_slug($title);
      $sql = "SELECT * FROM brand WHERE slug = '$slug' AND id != '$id'";
      $result = mysqli_query($conn, $sql);
      if($result && mysqli_num_rows($result) > 0) {
        $_SESSION['err'] = '1';
        $_SESSION['errmsg'] = 'Brand already exists';
        header('Location: brand_edit.php?id='.$id);
        exit;
      }
      if(isset($_POST['title'])) {
        $sql = "SELECT * FROM brand WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result){
          $old_img_name = mysqli_fetch_assoc($result)['img_name'];
        }
        $target_dir = "./uploads/brand/";
        $imageFileType = strtolower(pathinfo($_FILES["img_name"]["name"],PATHINFO_EXTENSION));
        $target_file_name = uniqid('brand', true).'.'.$imageFileType;
        $target_file = $target_dir . $target_file_name;
        $uploadOk = 1;
        $sql = "UPDATE brand SET title = '$title', slug = '$slug', status = '$status' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result) {
          // Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["img_name"]["tmp_name"]);
            if($check !== false) {
              $uploadOk = 1;
              header('Location: brand_edit.php?id='.$id);
              exit;
            } else {
              echo "File is not an image.";
              $uploadOk = 0;
              header('Location: brand_edit.php?id='.$id);
              exit;
            }
          }
      
          if(isset($_FILES["img_name"]['tmp_name']) && !empty($_FILES["img_name"]['tmp_name']))
          {
            // Check file size
            if ($_FILES["img_name"]["size"] > 2000000) {
              $_SESSION['success'] = 0;
              $_SESSION['successmsg'] = "";
              $_SESSION['err'] = 1;
              $_SESSION['errmsg'] = "Sorry, your file is too large.";
              $uploadOk = 0;
              header('Location: brand_edit.php?id='.$id);
              exit;
            }
        
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $_SESSION['success'] = 0;
                $_SESSION['successmsg'] = "";
                $_SESSION['err'] = 1;
                $_SESSION['errmsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
                header('Location: list_brand.php');
                exit;
            
            }
            if ( move_uploaded_file($_FILES["img_name"]["tmp_name"], $target_file)) {
              unlink("./uploads/brand/".$old_img_name);
              $sql = "UPDATE brand SET img_name = '$target_file_name' WHERE id = '$id'";
              $result = mysqli_query($conn, $sql);
              $_SESSION['success'] = 1;
              $_SESSION['successmsg'] = "Brand Updated Successfully!";
              header('Location: list_brand.php');
              exit;
            } else {
              $_SESSION['success'] = 0;
              $_SESSION['successmsg'] = "";
              $_SESSION['err'] = 1;
              $_SESSION['errmsg'] = "Data Updated Successfully, But there was an Error Updating Image!";
              header('Location: brand_edit.php?id='.$id);
              exit;
            }
          } else {
            $_SESSION['success'] = 0;
            $_SESSION['successmsg'] = "";
            $_SESSION['success'] = 1;
            $_SESSION['successmsg'] = "Brand Updated Successfully!";
            header('Location: list_brand.php');
            exit;
          }             
        } else {
          $_SESSION['success'] = 0;
          $_SESSION['successmsg'] = "";
          $_SESSION['err'] = 1;
          $_SESSION['errmsg'] = "Sorry, There was no Image detected.";
          header('Location: brand_edit.php?id='.$id);
          exit;
        }
        //}
      } else {
        $_SESSION['success'] = 0;
        $_SESSION['successmsg'] = "";
        $_SESSION['err'] = 1;
        $_SESSION['errmsg'] = "Please fill all the fields.";
        header('Location: brand_edit.php?id='.$id);
        exit;
      }
    } else {
      $_SESSION['success'] = 0;
      $_SESSION['successmsg'] = "";
      $_SESSION['err'] = 1;
      $_SESSION['errmsg'] = "Brand Already Exists!";
      header('location: brand_edit.php?id='.$id);
      exit;
    }
  } else {
    $_SESSION['success'] = 0;
    $_SESSION['successmsg'] = "";
    $_SESSION['err'] = 1;
    $_SESSION['errmsg'] = "Please login first.";
    header('Location: ./login.php');
    exit;
  }
  // print_r($_POST);
  function create_slug($string){
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    $slug = strtolower($slug);
    return $slug;
  }
?>
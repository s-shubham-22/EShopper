<?php
  require './../includes/conn.php';
  if(isset($_SESSION['username'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['title']) && isset($_FILES['img_name']['name'])){
          $title = $_POST['title'];
          $slug = create_slug($title);
          $img_name = $_FILES['img_name']['name'];
          $sql = "SELECT * FROM category WHERE slug = '$slug'";
          $result = mysqli_query($conn, $sql);
          if($result){
            $num = mysqli_num_rows($result);
            if($num == 0) {
              $sql = "INSERT INTO category (title, slug) VALUES ('$title', '$slug')";
              $result = mysqli_query($conn, $sql);
              if($result){
                $target_dir = "uploads/category/";
                $imageFileType = strtolower(pathinfo($img_name,PATHINFO_EXTENSION));
                $target_file_name = uniqid('category', true).'.'.$imageFileType;
                $target_file = $target_dir . $target_file_name;
                $uploadOk = 1;

                $id = mysqli_insert_id($conn);
                if(isset($_POST["submit"])) {
                  $check = getimagesize($img_name);
                  if($check !== false) {
                    $uploadOk = 1;
                    header('Location: category.php');
                    exit;
                  } else {
                   
                    echo "File is not an image.";
                    $uploadOk = 0;
                    header('Location: category.php');
                    exit;
                  }
                }

                // Check file size
                if ($_FILES["img_name"]["size"] > 5000000) {
                  $_SESSION['success'] = 0;
                  $_SESSION['successmsg'] = "";
                  $_SESSION['err'] = 1;
                  $_SESSION['errmsg'] = "Sorry, your file is too large.";
                  $uploadOk = 0;
                  header('Location: category.php');
                  exit;
                }
            
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                
                    $_SESSION['success'] = 0;
                    $_SESSION['successmsg'] = "";
                    $_SESSION['err'] = 1;
                    $_SESSION['errmsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                    header('Location: list_category.php');
                    exit;
                
                }

                if ( move_uploaded_file($_FILES["img_name"]["tmp_name"], $target_file)) {
                  $sql = "UPDATE category SET img_name = '".$target_file_name."' WHERE id = ".$id;
                  $result = mysqli_query($conn, $sql);
                  $_SESSION['success'] = 1;
                  $_SESSION['successmsg'] = "Category Added Successfully!";
                  header('Location: list_category.php');
                  exit;
                } else {
                  $_SESSION['err'] = 1;
                  $_SESSION['errmsg'] = "Data Uploaded Successfully, But there was an Error Uploading Image!";
                  header('Location: category.php');
                  exit;
                }
              } else {
                echo 'Sorry there was an error!';
                header('Location: category.php');
                exit;
              }
            } else {
              echo 'Category Already Exist!';
              header('Location: category.php');
              exit;
            }
          } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            header('Location: category.php');
            exit;
          }
          exit;
      }else {
          header("Location: category.php");
          exit;
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
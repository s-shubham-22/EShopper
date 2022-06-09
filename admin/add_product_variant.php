<?php
  require './../includes/conn.php';
  if(isset($_SESSION['username'])){
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['img_name']['name'])){
      $pid = $_POST['pid'];
      $size = $_POST['size'];
      $color = $_POST['color'];
      $price = $_POST['price'];
      $stock = $_POST['stock'];
      $img_name = $_FILES['img_name']['name'];
      $sql = "SELECT * FROM product_variant WHERE pid = '$pid' AND size = '$size' AND color = '$color'";
      $result = mysqli_query($conn, $sql);
      if($result){
        $num = mysqli_num_rows($result);
        if($num == 0) {
          $sql = 'INSERT INTO product_variant (pid, size, color, price, stock) VALUES ('.$pid.', "'.$size.'", "'.$color.'", '.$price.', '.$stock.')';
          $result = mysqli_query($conn, $sql);
          if($result){
            $target_dir = "uploads/product_variant/";
            $imageFileType = strtolower(pathinfo($img_name,PATHINFO_EXTENSION));
            $target_file_name = uniqid('product_variant', true).'.'.$imageFileType;
            $target_file = $target_dir . $target_file_name;
            $uploadOk = 1;

            $id = mysqli_insert_id($conn);
            if(isset($_POST["submit"])) {
              $check = getimagesize($img_name);
              if($check !== false) {
                $uploadOk = 1;
                header('Location: product_variant.php');
                exit;
              } else {
                
                echo "File is not an image.";
                $uploadOk = 0;
                header('Location: product_variant.php');
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
              header('Location: product_variant.php');
              exit;
            }
        
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            
                $_SESSION['success'] = 0;
                $_SESSION['successmsg'] = "";
                $_SESSION['err'] = 1;
                $_SESSION['errmsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
                header('Location: list_product_variant.php?id='.$pid);
                exit;
            
            }

            if ( move_uploaded_file($_FILES["img_name"]["tmp_name"], $target_file)) {
              $sql = "UPDATE product_variant SET img_name = '".$target_file_name."' WHERE id = ".$id;
              $result = mysqli_query($conn, $sql);
              $_SESSION['success'] = 1;
              $_SESSION['successmsg'] = "Product Variant Added Successfully!";
              header('Location: list_product_variant.php?id='.$pid );
              exit;
            } else {
              $_SESSION['err'] = 1;
              $_SESSION['errmsg'] = "Data Uploaded Successfully, But there was an Error Uploading Image!";
              header('Location: product_variant.php');
              exit;
            }
          } else {
            echo 'Sorry there was an error!';
            header('Location: product_variant.php');
            exit;
          }
        } else {
          echo 'Product Variant Already Exist!';
          header('Location: product_variant.php');
          exit;
        }
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        header('Location: product_variant.php');
        exit;
      }
      exit;
    }else {
        header("Location: product_variant.php");
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
<?php
    require './../includes/conn.php';
    if(isset($_SESSION['username'])){
        if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
            $sql = "SELECT * FROM admin WHERE username = '".$_COOKIE['username']."'";
            $result = mysqli_query($conn, $sql);
            $password = $_COOKIE['password'];
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if(password_verify($password, $row['password'])){
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                } else {
                    setcookie('username', '', time() - 3600);
                    setcookie('password', '', time() - 3600);
                    header("Location: login.php");
                }
            } else {
                setcookie('username', '', time() - 3600);
                setcookie('password', '', time() - 3600);
                header("Location: login.php");
            }
        }else {
            header("Location: login.php");
        } 
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EShopper - Product Variant</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            $pgname = 'product_variant';
            require './includes/sidebar.php';
        ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                    require './includes/topbar.php';
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?php
                        if(isset($_SESSION['err']) && $_SESSION['err'] == 1){
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> '.$_SESSION['errmsg'].' 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                            $_SESSION['err'] = 0;
                            $_SESSION['errmsg'] = "";
                        } else if (isset($_SESSION['success']) && $_SESSION['success'] == 1){
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success!</strong> '.$_SESSION['successmsg'].' 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                            $_SESSION['success'] = 0;
                            $_SESSION['successmsg'] = "";
                        }
                        $id = $_GET['id'];
                        $pid = $_GET['pid'];
                        $sql = "SELECT * FROM product WHERE id = '$pid'";
                        $result = mysqli_query($conn, $sql);
                        if($result && mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);
                            $title = $row['title'];
                            $status = $row['status'];
                        } else {
                            $_SESSION['err'] = 1;
                            $_SESSION['errmsg'] = "No product_variant found! But you can create a New Product Variant Here!";
                            exit;
                        }
                    ?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Product Variant (<?php echo $row['title']; ?>) - Edit</h1>
                    </div>

                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Product Variant</h6>
                    </div>
                    <div class="card-body">
                        <form action="edit_product_variant.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                            <div class="form-group">
                                <label for="size">Size <strong class=text-danger>*</strong></label>
                                <select name="size" id="size" class="form-control" required>
                                  <?php
                                    $sql2 = "SELECT * FROM variant_details WHERE vid = 2";
                                    $result2 = mysqli_query($conn, $sql2);
                                    $sql3 = "SELECT * FROM product_variant WHERE id = '$id'";
                                    $result3 = mysqli_query($conn, $sql3);
                                    if ($result2 && $result3 && mysqli_num_rows($result2) > 0) {
                                        $row3 = mysqli_fetch_assoc($result3);
                                        $img_name = $row3['img_name'];
                                        while($row2 = mysqli_fetch_assoc($result2)) {
                                            $selected = '';
                                            if($row2['id'] == $row3['size']){
                                                $selected = 'selected';
                                            }
                                            echo '<option value="'.$row2['id'].'" '.$selected.'>'.$row2['v_value'].'</option>';
                                        }
                                    }
                                  ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title">Color <strong class=text-danger>*</strong></label>
                                <?php
                                  $sql2 = "SELECT * FROM variant_details WHERE vid = 1";
                                  $result2 = mysqli_query($conn, $sql2);
                                  if ($result2 && mysqli_num_rows($result2) > 0) {
                                    while($row2 = mysqli_fetch_assoc($result2)) {
                                        $checked = "";
                                        if($row3['color'] == $row2['id']){
                                            $checked = "checked";
                                        }
                                        echo '<div id="'.$row3['id'].'">
                                        <input type="radio" name="color" value="'.$row2['id'].'" '.$checked.'>
                                          <span style="background-color:'.$row2['v_value'].'; width:50px; height:30px; display:inline-block; border: 1px solid grey; border-radius: 3px;"></span></div>';
                                          $checked = '';
                                      }
                                  }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="price">Price <strong class=text-danger>*</strong></label>
                                <input type="text" class="form-control" id="price" name="price" aria-describedby="emailHelp" value="<?php echo $row3['price']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock <strong class=text-danger>*</strong></label>
                                <input type="text" class="form-control" id="stock" name="stock" aria-describedby="emailHelp" value="<?php echo $row3['stock']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="img_name">Product Variant Image <strong class=text-danger>*</strong></label>
                                <input type="file" class="form-control-file" id="img_name" name="img_name">
                                <br><img id="preview_img" src="./uploads/product_variant/<?php echo $img_name; ?>" alt="your image" width="150px" />
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                  </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; EShopper 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        $('#img_name').change(function() {
            $('#preview_img').attr('hidden', false);
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

        if($('#preview_img').attr('src') == '') {
            $('#preview_img').attr('hidden', true);
        } else {
            $('#preview_img').attr('hidden', false);
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }
    </script>


</body>

</html>
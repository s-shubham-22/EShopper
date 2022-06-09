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

    <title>EShopper - Contact</title>

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
            $pgname = 'contact';
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
                        $sql = "SELECT * FROM contact WHERE id = 1";
                        $result = mysqli_query($conn, $sql);
                        if($result && mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);
                            $email = $row['email'];
                            $mobile = $row['mobile'];
                            $address = $row['address'];
                        } else {
                            $email = "";
                            $mobile = "";
                            $address = "";
                        }
                    ?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Contact</h1>
                    </div>

                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Contact</h6>
                    </div>
                    <div class="card-body">
                        <form action="edit_contact.php" method="post">
                            <input type="text" name="id" id="id" value="1" hidden>
                            <div class="form-group">
                                <label for="email">Email <strong class=text-danger>*</strong></label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" maxlength="80" value="<?php echo $email ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile No. <strong class=text-danger>*</strong></label>
                                <input type="tel" class="form-control" id="mobile" name="mobile" aria-describedby="emailHelp" maxlength="10" value="<?php echo $mobile ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address <strong class=text-danger>*</strong></label>
                                <textarea class="form-control" id="address" name="address" rows="3" cols="100" required><?php echo $address ?></textarea>
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

</body>

</html>
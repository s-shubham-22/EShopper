<?php
    require './../includes/conn.php';
    if(!isset($_SESSION['username'])){
        if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
            echo 'Hello';
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

    <title>EShopper - Brand</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php
            $pgname = 'brand';
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
                    ?>
                  <div class="d-sm-flex align-items-center justify-content-between">
                      <h1 class="h3 mb-0 text-gray-800">Brand</h1>
                  </div>

                  <div class="d-flex justify-content-end">
                    <a href="./brand.php">
                        <button class="btn btn-primary mb-4">Add Brand</button>
                    </a>
                  </div>

                  <!-- Home Sliders Table -->
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Brand</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Brand Title</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Brand Title</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                      $sql = "SELECT * FROM brand";
                                      $result = mysqli_query($conn, $sql);
                                      if($result && mysqli_num_rows($result) > 0){
                                        $row = mysqli_fetch_assoc($result);
                                        $i = 1;
                                        do {
                                          echo '<tr id="trow-'.$row['id'].'">';
                                          echo '<td>'.$i.'</td>';
                                          echo '<td>'.$row['title'].'</td>';
                                          echo '<td class="text-center"><img src="./uploads/brand/'.$row['img_name'].'" alt="'.$row['title'].'" height="150px" max-width="150px"></td>';
                                          $status_checked = '';
                                          if($row['status'] == 0) {
                                            $status_checked = '';
                                          } else if ($row['status'] == 1) {
                                            $status_checked = 'checked';
                                          } else {
                                            $status_checked = '';
                                          }
                                          echo '<td class="text-center"><input type="checkbox" id="status-'.$row['id'].'" '.$status_checked.' onclick="change_status('.$row['id'].');"></td>';
                                          echo '<td class="text-center"><a href="brand_edit.php?id='.$row['id'].'" class="btn btn-primary">Edit</a></td>';
                                          echo '<td class="text-center"><a id="delete-'.$row['id'].'" href-url="delete_brand.php" href="javascript:void(0);" onclick="confirmation('.$row['id'].');" class="btn btn-danger">Delete</a></td>';
                                          echo '</tr>';
                                          $i++;
                                        } while($row = mysqli_fetch_assoc($result));
                                      } else {
                                        ?>
                                        <tr><td colspan="6" class="text-center">No Brand Found</td></tr>
                                        <?php
                                      }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
                  <!-- End of Home Sliders Table -->

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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        function change_status(id) {
            var status = $('#status-'+id).is(':checked');
            if(status) {
                status = 1;
            } else {
                status = 0;
            }
            $.ajax({
                url: './change_status.php',
                type: 'POST',
                data: {
                    id: id,
                    status: status,
                    table: 'brand' 
                },
                success: function(response) {
                    console.log(response);
                }
            });
        }

        function confirmation(id){
            var answer = confirm("Are you sure you want to delete this Brand?");
            if(answer){
                $.ajax({
                    url: document.getElementById('delete-' + id).getAttribute('href-url'),
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        console.log(response);
                        if(response == 'success') {
                            $('#trow-' + id).remove();
                            alert('Brand Deleted Successfully');
                        } else {
                            alert('Error Deleting Category');
                        }
                    }
                });
            }
        }
    </script>
    

</body>

</html>
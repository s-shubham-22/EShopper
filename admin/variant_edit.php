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

    <title>EShopper - Variant</title>

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
            $pgname = 'variant';
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
                        $sql = "SELECT * FROM variant WHERE id = '$id'";
                        $result = mysqli_query($conn, $sql);
                        if($result && mysqli_num_rows($result) > 0){
                            $row = mysqli_fetch_assoc($result);
                            $vid = $row['id'];
                            $title = $row['title'];
                            $type = $row['type'];
                            $status = $row['status'];
                        } else {
                            $_SESSION['err'] = 1;
                            $_SESSION['errmsg'] = "No variant found! But you can create a New Variant Here!";
                            exit;
                        }
                    ?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Variant - Edit</h1>
                    </div>

                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Variant</h6>
                    </div>
                    <div class="card-body">
                        <form action="edit_variant.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Variant Title <strong class=text-danger>*</strong></label>
                                <input value="<?php echo $row['title']; ?>" type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" required>
                                <input type="hidden" name="v_id" value="<?php echo $vid; ?>">
                            </div>
                            <div class="form-group">
                                <label for="type">Variant Type <strong class=text-danger>*</strong></label>
                                <select name="type" id="type" class="form-control">
                                  <option value="text" <?php 
                                  if($type == 'text'){
                                    echo 'selected';
                                  }
                                  ?>>Text</option>
                                  <option value="color" <?php 
                                  if($type == 'color'){
                                    echo 'selected';
                                  }
                                  ?>>Color</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="v_value">Variants <strong class=text-danger>*</strong></label>
                                <table class="rowdata" width="100%">
                                  <tbody id="variants">
                                    <?php
                                      $sql = "SELECT * FROM variant_details WHERE vid = '$id' AND type = '$type'";
                                      $result = mysqli_query($conn, $sql);
                                      if($result && mysqli_num_rows($result) > 0) {
                                        $i = 0;
                                        while($row = mysqli_fetch_assoc($result)) {
                                          echo '<tr id="'.$i.'">
                                          <input type="hidden" name="id[]" value="'.$row['id'].'">
                                          <td><input value="'.$row['v_value'].'" type="'.$type.'" class="form-control value" name="v_value[]" aria-describedby="emailHelp" required></td>';
                                          if($i == 0) {
                                            echo '<td><button type="button" class="btn btn-primary ml-3" onclick="add_variant();">Add Variant</button></td>';
                                          } else {
                                            echo '<td><button type="button" class="btn btn-danger ml-3" onclick="remove_variant('.$i.');">X</button></td>';
                                          }
                                        echo '</tr>';
                                         $i++;
                                        }
                                      } else {
                                        echo '<tr id="0">
                                        <td><input type="'.$typeValue.'" class="form-control value" name="v_value[]" aria-describedby="emailHelp" required></td>
                                        <td><button type="button" class="btn btn-primary ml-3" onclick="add_variant();">Add Variant</button></td>
                                      </tr>';
                                      }
                                    ?>
                                  </tbody>
                                </table>
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
      $('#type').change(function(){
            if($('#type').val() == "color"){
                $('.value').attr('type', 'color');
            } else {
                $('.value').attr('type', 'text');
                $('.value').val('');
            }
        });

        function add_variant() {
            var rowCount = $('#variants tr').length;
            var type = $('#type').val();
          $('#variants').append(`
            <tr id=`+rowCount+`>
                <td><input type="`+type+`" class="form-control value" name="v_value[]" aria-describedby="emailHelp" required></td>
                <td><button type="button" class="btn btn-danger ml-3" onclick="remove_variant(`+rowCount+`);">X</button></td>
            </tr>
          `);
        }

        function remove_variant(id) {
          $('#variants tr#'+id).remove();
        }
    </script>


</body>

</html>
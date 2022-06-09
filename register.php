<?php
    require './includes/conn.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EShopper</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <?php
        require './includes/topbar.php';
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
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Category</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <?php
                    require './includes/category.php';
                ?>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <?php
                        $pgname = 'register';
                        require './includes/navbar.php';
                    ?>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Register</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Register</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid pt-5" id="register">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Register Here</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-8 mb-5 mx-auto">
                <div class="register-form">
                    <form method="POST" action="add_user.php" id="contact-form">
                        <div class="control-group">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" required="required" maxlength="80" data-validation-required-message="Please Enter Username" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter First Name" required="required" maxlength="80" data-validation-required-message="Please Enter First Name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" name="lname" class="form-control" id="lname" placeholder="Enter Last Name" required="required" maxlength="80" data-validation-required-message="Please Enter Last Name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="tel" name="mobile" class="form-control" id="mobile" placeholder="Enter Mobile No." required="required" maxlength="10" data-validation-required-message="Please Enter Mobile No." />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email ID" required="required" maxlength="10" data-validation-required-message="Please Enter Email ID" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <label>Gender: </label><br>
                            <input type="radio" name="gender" id="male" value="male" required="required" data-validation-required-message="Please Enter Email ID" />
                            <label for="male">Male</label>
                            <input type="radio" name="gender" id="female" value="female" required="required" data-validation-required-message="Please Enter Email ID" />
                            <label for="female">Female</label>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" name="address" rows="6" id="address" placeholder="Enter Address" required="required" data-validation-required-message="Please Enter Address"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required="required" data-validation-required-message="Please Enter password" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Confirm password" required="required" data-validation-required-message="Please Confirm password" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <?php
        require './includes/footer.php';
    ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>
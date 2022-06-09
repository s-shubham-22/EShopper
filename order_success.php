<?php
    require 'includes/conn.php';
    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['order_id'])) {
        $sql = 'SELECT * FROM orders WHERE id = '.$_GET['order_id'];
        $result = mysqli_query($conn, $sql);
        if(!$result || mysqli_num_rows($result) == 0) {
            header('Location: index.php');
            exit;
        }
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
    ?>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
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
                        $pgname = 'admin';
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Order Successful</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="./index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Order Success</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <?php
        $order_id = $_GET['order_id'];
        $sql = "SELECT * FROM orders WHERE id = $order_id";
        $result = mysqli_query($conn, $sql);
        if($result && mysqli_num_rows($result) > 0) {
            echo mysqli_num_rows($result);
            $row = mysqli_fetch_assoc($result);
            $sql2 = 'SELECT sum(total) as total FROM order_details WHERE order_id = '.$order_id;
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
        } else {
            echo 'Error';
        }
    ?>

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5 w-75 mx-auto">
            <div class="col-lg-12 pb-5 mx-auto">
                <h1 class="text-center">Thank You For Your Order</h1>
            </div>
            <div class="col-lg-2 pb-5 mx-auto">
                <h6><strong>Order Id:</strong></h6>
                <h6><strong>Order Date:</strong></h6>
                <h6><strong>Total Amount:</strong></h6>
            </div>
            <div class="col-lg-8 pb-5 mx-auto">
                <h6><?php echo $order_id; ?></h6>
                <h6><?php echo $row['order_date']; ?></h6>
                <h6>$ <?php echo $row2['total']; ?></h6>
            </div>
            <div class="col-lg-5 p-3 px-5 mx-auto border shadow rounded">
                <h4><strong>Billing Address</strong></h4><br>
                <h5><?php echo $row['b_fname'].' '.$row['b_lname']; ?></h5><br>
                <h6><?php echo $row['b_addr_1'].', '.$row['b_addr_2']; ?></h6>
                <h6><?php echo $row['b_city'].' - '.$row['b_zip']; ?></h6>
                <h6><?php echo $row['b_state'].' - '.$row['b_country']; ?></h6>
                <h6>Mobile: <?php echo $row['b_mobile']; ?></h6>
            </div>
            <div class="col-lg-5 p-3 px-5 mx-auto border shadow rounded">
                <h4 pb-3><strong>Shipping Address</strong></h4><br>
                <h5><?php echo $row['s_fname'].' '.$row['s_lname']; ?></h5><br>
                <h6><?php echo $row['s_addr_1'].', '.$row['s_addr_2']; ?></h6>
                <h6><?php echo $row['s_city'].' - '.$row['s_zip']; ?></h6>
                <h6><?php echo $row['s_state'].' - '.$row['s_country']; ?></h6>
                <h6>Mobile: <?php echo $row['s_mobile']; ?></h6>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

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
<?php
    } else {
        echo 'Invalid Request';
    }
?>
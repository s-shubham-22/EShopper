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
                    <?php
                        $pgname = "admin";
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="./index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <form action="add_order.php" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input id="b_fname" type="text" name="b_fname" class="form-control" type="text" placeholder="John" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input id="b_lname" type="text" name="b_lname" class="form-control" type="text" placeholder="Doe" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input id="b_email" type="email" name="b_email" class="form-control" type="text" placeholder="example@email.com" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input id="b_mobile" type="tel" name="b_mobile" class="form-control" type="text" placeholder="+123 456 789" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input id="b_addr_1" type="text"  name="b_addr_1" class="form-control" type="text" placeholder="123 Street" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input id="b_addr_2" type="text" name="b_addr_2" class="form-control" type="text" placeholder="123 Street" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select id="b_country" name="b_country" class="custom-select" required>
                                <option value="India" selected>India</option>
                                <option value="United States">United States</option>
                                <option value="Japan">Japan</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input id="b_city" type="text" name="b_city" class="form-control" type="text" placeholder="New York" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input id="b_state" type="text" name="b_state" class="form-control" type="text" placeholder="New York" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input id="b_zip" type="tel" name="b_zip" class="form-control" type="text" placeholder="123" required maxlength="6">
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input name="shipto" value=1 type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto">Ship to Same Address as Billing Address</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input id="s_fname" name="s_fname" class="form-control" type="text" placeholder="John">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input id="s_lname" name="s_lname" class="form-control" type="text" placeholder="Doe">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input id="s_email" name="s_email" class="form-control" type="text" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input id="s_mobile" name="s_mobile" class="form-control" type="text" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input id="s_addr_1" name="s_addr_1" class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input id="s_addr_2" name="s_addr_2" class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select id="s_country" name="s_country" class="custom-select">
                                <option value="India" selected>India</option>
                                <option value="United States">United States</option>
                                <option value="Japan">Japan</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input id="s_city" name="s_city" class="form-control" type="text" placeholder="New York" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input id="s_state" name="s_state" class="form-control" type="text" placeholder="New York" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input id="s_zip" name="s_zip" class="form-control" type="text" placeholder="123" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        <div class="d-flex justify-content-between">
                            <strong><p>Product Name</p></strong>
                            <strong><p>Quantity x Price = Total</p></strong>
                        </div>
                        <?php
                            $id = $_SESSION['id'];
                            $total = 0;
                            $sql = 'SELECT * FROM cart WHERE id='.$id;
                            $result = mysqli_query($conn, $sql);
                            if($result && mysqli_num_rows($result) > 0){
                                while($row = mysqli_fetch_assoc($result)){
                                    $qty = $row['qty'];
                                    $sql2 = 'SELECT * FROM product WHERE id='.$row['pid'];
                                    $result2 = mysqli_query($conn, $sql2);
                                    if($result2 && mysqli_num_rows($result2) > 0){
                                        $row2 = mysqli_fetch_assoc($result2);
                                        $title = $row2['title'];
                                        $price = $row2['sale_price'];
                                        if($row['color'] != 0 && $row['size'] != 0){
                                            $sql3 = 'SELECT * FROM variant_details WHERE id='.$row['color'];
                                            $result3 = mysqli_query($conn, $sql3);
                                            $row3 = mysqli_fetch_assoc($result3);
                                            $color = $row3['v_value'];
                                            $sql3 = 'SELECT * FROM variant_details WHERE id='.$row['size'];
                                            $result3 = mysqli_query($conn, $sql3);
                                            $row3 = mysqli_fetch_assoc($result3);
                                            $size = $row3['v_value'];
                                            $title .= ' ( '.$color.', '.$size.' )';
                                            $sql3 = 'SELECT * FROM product_variant WHERE pid='.$row['pid'].' AND color='.$row['color'].' AND size='.$row['size'];
                                            $result3 = mysqli_query($conn, $sql3);
                                            $row3 = mysqli_fetch_assoc($result3);
                                            $price = $row3['price'];
                                        }
                                        $total += $qty * $price;
                                        ?>
                                            <div class="d-flex justify-content-between">
                                                <p><?php echo $title; ?></p>
                                                <p><?php echo $qty.' x '.$price.' = '.($price * $qty); ?></p>
                                            </div>
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">$<?php echo $total; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <p>Cash On Delivery</p>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <input type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold py-3" value="Place Order"/>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- Checkout End -->


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

    <script>
        $('#shipto').change(function(){
            console.log($(this).is(':checked'));
            if($(this).is(':checked')){
                $('#s_fname').val($('#b_fname').val());
                $('#s_lname').val($('#b_lname').val());
                $('#s_email').val($('#b_email').val());
                $('#s_mobile').val($('#b_mobile').val());
                $('#s_addr_1').val($('#b_addr_1').val());
                $('#s_addr_2').val($('#b_addr_2').val());
                $('#s_city').val($('#b_city').val());
                $('#s_state').val($('#b_state').val());
                $('#s_country').val($('#b_country').val());
                $('#s_zip').val($('#b_zip').val());
            }
            else{
                $('#s_fname').val('');
                $('#s_lname').val('');
                $('#s_email').val('');
                $('#s_mobile').val('');
                $('#s_addr_1').val('');
                $('#s_addr_2').val('');
                $('#s_city').val('');
                $('#s_state').val('');
                $('#s_country').val('');
                $('#s_zip').val('');
            }
        });
    </script>
</body>

</html>
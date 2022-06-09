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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">

                        <?php
                            $sql = 'SELECT * FROM cart WHERE id = '.$_SESSION['id'];
                            $result = mysqli_query($conn, $sql);
                            $total = 0;
                            if($result && mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $cart_id = $row['cart_id'];
                                    $pid = $row['pid'];
                                    $color = $row['color'];
                                    $size = $row['size'];
                                    $qty = $row['qty'];
                                    $sql2 = 'SELECT * FROM product WHERE id = '.$pid;
                                    $result2 = mysqli_query($conn, $sql2);
                                    if($result2 && mysqli_num_rows($result2) > 0) {
                                        $row2 = mysqli_fetch_assoc($result2);
                                        $title = $row2['title'];
                                        $price = $row2['sale_price'];
                                        $img_name = 'product/'.$row2['img_name'];
                                    }
                                    if($color != '0' && $size != '0') {
                                        $sql2 = 'SELECT * FROM product_variant WHERE pid = '.$pid.' AND color = "'.$color.'" AND size = "'.$size.'"';
                                        $result2 = mysqli_query($conn, $sql2);
                                        if($result2 && mysqli_num_rows($result2) > 0) {
                                            $row2 = mysqli_fetch_assoc($result2);
                                            $price = $row2['price'];
                                            $img_name = 'product_variant/'.$row2['img_name'];
                                            $sql2 = 'SELECT * FROM variant_details WHERE id = '.$color;
                                            $result2 = mysqli_query($conn, $sql2);
                                            if($result2 && mysqli_num_rows($result2) > 0) {
                                                $row2 = mysqli_fetch_assoc($result2);
                                                $color_value = $row2['v_value'];
                                            }

                                            $sql2 = 'SELECT * FROM variant_details WHERE id = '.$size;
                                            $result2 = mysqli_query($conn, $sql2);
                                            if($result2 && mysqli_num_rows($result2) > 0) {
                                                $row2 = mysqli_fetch_assoc($result2);
                                                $size_value = $row2['v_value'];
                                            }
                                            $title .= ' ('.$color_value.', '.$size_value.')';
                                        }
                                    }
                                    if($qty > 0) {
                                    $total += $price * $qty;
                                    ?>
                                        <tr id="row-<?php echo $cart_id; ?>">
                                            <td class="align-left"><img src="./admin/uploads/<?php echo $img_name; ?>" alt="" style="width: 50px;"> <?php echo $title; ?></td>
                                            <td class="align-middle" id="price-<?php echo $cart_id; ?>"><?php echo $price; ?></td>
                                            <td class="align-middle">
                                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-sm btn-primary btn-minus" onclick="Qty(<?php echo $pid.', \''.$color.'\', \''.$size.'\', \''.$cart_id.'\''; ?>, 'dec');">
                                                        <i class="fa fa-minus"></i>
                                                        </button>
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm bg-secondary text-center" id="qty-<?php echo $cart_id; ?>" value="<?php echo $qty; ?>">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-sm btn-primary btn-plus" onclick="Qty(<?php echo $pid.', \''.$color.'\', \''.$size.'\', \''.$cart_id.'\''; ?>, 'inc');">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle" id="total-<?php echo $cart_id; ?>"><?php echo $price * $qty; ?></td>
                                            <td class="align-middle"><button type="button" class="btn btn-sm btn-primary" onclick="remove(<?php echo $cart_id; ?>);"><i class="fa fa-times"></i></button></td>
                                        </tr>
                                    <?php
                                    }
                                }
                            } else {
                                echo '<tr><td colspan="5" class="text-center">No products in cart</td></tr>';
                            }
                        ?>                        
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium" id="subtotal">$<?php echo $total; ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$0</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold" id="total">$<?php echo $total; ?></h5>
                        </div>
                        <a href="./checkout.php" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->


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
        function Qty(pid, color, size, cart_id, action) {
            $.ajax({
                url: './ajax/manage_quantity.php',
                type: 'POST',
                data: {
                    id: <?php echo $_SESSION['id']; ?>,
                    pid: pid,
                    color: color,
                    size: size,
                    action: action
                },
                success: function(response) {
                    if(response == 'success') {
                        console.log('Success');
                        var total = parseInt($('#subtotal').text().replace('$', ''));
                        if($('#qty-'+cart_id).val() == 0) {
                            total -= parseInt($('#price-'+cart_id).text());
                            $('#row-'+cart_id).remove();
                        } else {
                            $('#total-'+cart_id).text($('#qty-'+cart_id).val() * $('#price-'+cart_id).text());
                            if(action == 'inc') {
                                total += parseInt($('#price-'+cart_id).text());
                            } else {
                                total -= parseInt($('#price-'+cart_id).text());
                            }
                        }
                        $('#subtotal').text('$'+total);
                        $('#total').text('$'+total);
                    } else { 
                        console.log('Error');
                    }
                }
            });
        }

        function remove(cart_id) {
            $.ajax({
                url: './ajax/remove_from_cart.php',
                type: 'POST',
                data: {
                    id: <?php echo $_SESSION['id']; ?>,
                    cart_id: cart_id
                },
                success: function(response) {
                    if(response == 'success') {
                        console.log('Success');
                        var total = parseInt($('#subtotal').text().replace('$', ''));
                        total -= parseInt($('#total-'+cart_id).text());
                        $('#subtotal').text('$'+total);
                        $('#total').text('$'+total);
                        $('#row-'+cart_id).remove();
                    } else { 
                        console.log('Error');
                    }
                }
            });
        }
    </script>
</body>

</html>
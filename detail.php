<?php
    require 'includes/conn.php';
    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
        $sql = 'SELECT * FROM product WHERE id = '.$_GET['id'];
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
                                $pgname = 'detail';
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
                    <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Detail</h1>
                    <div class="d-inline-flex">
                        <p class="m-0"><a href="./index.php">Home</a></p>
                        <p class="m-0 px-2">-</p>
                        <p class="m-0">Shop Detail</p>
                    </div>
                </div>
            </div>
            <!-- Page Header End -->

            <?php
                $id = $_GET['id'];
                $sql = "SELECT * FROM product WHERE id = $id";
                $result = mysqli_query($conn, $sql);
                if($result && mysqli_num_rows($result) > 0) {
                    echo mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result);
                } else {
                    echo 'Error';
                }
            ?>

            <!-- Shop Detail Start -->
            <div class="container-fluid py-5">
                <div class="row px-xl-5">
                    <div class="col-lg-5 pb-5">
                        <div id="product-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner border">
                                <div class="carousel-item active">
                                    <img class="w-100 h-100" src="./admin/uploads/product/<?php echo $row['img_name']; ?>" alt="Image">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                                <i class="fa fa-2x fa-angle-left text-dark"></i>
                            </a>
                            <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                                <i class="fa fa-2x fa-angle-right text-dark"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-7 pb-5">
                        <h3 class="font-weight-semi-bold"><?php echo $row['title'] ?></h3>
                        <h3 class="font-weight-semi-bold mb-4">$<?php echo $row['sale_price'] ?> <span class="text-muted ml-2"><del>$<?php echo $row['price'] ?></del></span></h3>
                        <form method="POST" action="add_to_cart.php">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="d-flex mb-4">
                                <?php
                                    $sql = 'SELECT * FROM product_variant WHERE pid = '.$id;
                                    $result = mysqli_query($conn, $sql);
                                    $load = 0;
                                    if($result && mysqli_num_rows($result) > 0) {
                                        $load = 1;
                                        ?><p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p><?php
                                        $i = 0;
                                        }
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $sql2 = 'SELECT * FROM variant_details WHERE id = '.$row['color'];
                                            $result2 = mysqli_query($conn, $sql2);
                                            if($result2 && mysqli_num_rows($result2) > 0) {
                                                $row2 = mysqli_fetch_assoc($result2);
                                                $checked = '';
                                                if($i == 0) {
                                                    $color = $row['color'];
                                                    $checked = 'checked';
                                                }
                                                ?>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" id="color_<?php echo $row['id']; ?>" name="color" value="<?php echo $row2['id']; ?>" <?php echo $checked; ?> onclick="load_size(<?php echo $row['id'].', '.$row['color']; ?>);">
                                                        <label class="custom-control-label" for="color_<?php echo $row['id']; ?>"><span style="background-color:<?php echo $row2['v_value']; ?>; width:50px; height:30px; display:inline-block; border: 1px solid grey; border-radius: 3px;"></span></label>
                                                    </div>
                                                <?php
                                            ?>
                                                
                                            <?php
                                            $i++;
                                        }
                                    }
                                ?>
                            </div>
                            <div class="d-flex mb-3" id="size">
                                <?php
                                if($load == 1) {
                                    $sql = 'SELECT * FROM product_variant WHERE pid = '.$id.' AND color = '.$color;
                                    $result = mysqli_query($conn, $sql);
                                    if($result && mysqli_num_rows($result) > 0) {
                                        ?><p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p><?php
                                        $i = 0;
                                        }
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $sql2 = 'SELECT * FROM variant_details WHERE id = '.$row['size'];
                                            $result2 = mysqli_query($conn, $sql2);
                                            if($result2 && mysqli_num_rows($result2) > 0) {
                                                $row2 = mysqli_fetch_assoc($result2);
                                                $checked = '';
                                                if($i == 0) {
                                                    $checked = 'checked';
                                                }
                                                ?>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" class="custom-control-input" id="size_<?php echo $row['id']; ?>" name="size" value="<?php echo $row2['id']; ?>" <?php echo $checked; ?>>
                                                        <label class="custom-control-label" for="size_<?php echo $row['id']; ?>"><?php echo $row2['v_value']; ?></label>
                                                    </div>
                                                <?php
                                            ?>
                                                
                                            <?php
                                            $i++;
                                        }
                                    }
                                }
                                ?>
                            </div>
                            <div class="d-flex align-items-center mb-4 pt-2">
                                <div class="input-group quantity mr-3" style="width: 130px;">
                                    <div class="">
                                        <button type="button" class="btn btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control bg-secondary text-center"  name="qty" id="qty" value="1">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value='Add To Cart' class="btn btn-primary px-3">
                        </form>     
                    </div>
                </div>
                <!-- Product Description -->
                <div class="row px-xl-5">
                    <div class="col">
                        <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                            <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-pane-1">
                                <h4 class="mb-3">Product Description</h4>
                                <p>
                                    <?php
                                        $sql = 'SELECT * FROM product WHERE id = '.$id;
                                        $result = mysqli_query($conn, $sql);
                                        if($result && mysqli_num_rows($result) > 0) {
                                            $row = mysqli_fetch_assoc($result);
                                            echo $row['description'];
                                        } else {
                                            echo 'No Description!';
                                        }
                                    ?>
                                </p>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-2">
                                <h4 class="mb-3">Additional Information</h4>
                                <p>Eos no lorem eirmod diam diam, eos elitr et gubergren diam sea. Consetetur vero aliquyam invidunt duo dolores et duo sit. Vero diam ea vero et dolore rebum, dolor rebum eirmod consetetur invidunt sed sed et, lorem duo et eos elitr, sadipscing kasd ipsum rebum diam. Dolore diam stet rebum sed tempor kasd eirmod. Takimata kasd ipsum accusam sadipscing, eos dolores sit no ut diam consetetur duo justo est, sit sanctus diam tempor aliquyam eirmod nonumy rebum dolor accusam, ipsum kasd eos consetetur at sit rebum, diam kasd invidunt tempor lorem, ipsum lorem elitr sanctus eirmod takimata dolor ea invidunt.</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0">
                                                Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                            </li>
                                        </ul> 
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item px-0">
                                                Sit erat duo lorem duo ea consetetur, et eirmod takimata.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Amet kasd gubergren sit sanctus et lorem eos sadipscing at.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Duo amet accusam eirmod nonumy stet et et stet eirmod.
                                            </li>
                                            <li class="list-group-item px-0">
                                                Takimata ea clita labore amet ipsum erat justo voluptua. Nonumy.
                                            </li>
                                        </ul> 
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4 class="mb-4">1 review for "Colorful Stylish Shirt"</h4>
                                        <div class="media mb-4">
                                            <img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                            <div class="media-body">
                                                <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                                <div class="text-primary mb-2">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                                <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h4 class="mb-4">Leave a review</h4>
                                        <small>Your email address will not be published. Required fields are marked *</small>
                                        <div class="d-flex my-3">
                                            <p class="mb-0 mr-2">Your Rating * :</p>
                                            <div class="text-primary">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                        </div>
                                        <form>
                                            <div class="form-group">
                                                <label for="message">Your Review *</label>
                                                <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Your Name *</label>
                                                <input type="text" class="form-control" id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Your Email *</label>
                                                <input type="email" class="form-control" id="email">
                                            </div>
                                            <div class="form-group mb-0">
                                                <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Shop Detail End -->


            <!-- Products Start -->
            <div class="container-fluid py-5">
                <div class="text-center mb-4">
                    <h2 class="section-title px-5"><span class="px-2">Related Products</span></h2>
                </div>
                <div class="row px-xl-5">
                    <div class="col">
                        <div class="owl-carousel related-carousel">
                            <?php
                                $cid = $row['cid'];
                                $sql = 'SELECT * FROM product WHERE cid = "'.$cid.'" AND id != '.$id.' ORDER BY RAND() LIMIT 4';
                                $result = mysqli_query($conn, $sql);
                                if($result && mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <div class="card product-item border-0">
                                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                                <img class="img-fluid w-100" src="./admin/uploads/product/<?php echo $row['img_name']; ?>" alt="">
                                            </div>
                                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                                <h6 class="text-truncate mb-3"><?php echo $row['title']; ?></h6>
                                                <div class="d-flex justify-content-center">
                                                    <h6>$<?php echo $row['sale_price']; ?></h6><h6 class="text-muted ml-2"><del>$<?php echo $row['price']; ?></del></h6>
                                                </div>
                                            </div>
                                            <div class="card-footer d-flex justify-content-between bg-light border">
                                                <a href="./detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- Products End -->


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
                function add_to_cart(id) {
                    console.log(id);
                    $.ajax({
                        url: './add_to_cart.php',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            if(response == 'success') {
                                alert('Product added to cart');
                            } else if(response == 'error-login') {
                                window.location.replace("./login.php");
                            }
                        }
                    });
                }

                function load_size(id, cid) {
                    $.ajax({
                        url: 'ajax/get_size.php',
                        method: 'POST',
                        data: {
                            id: id,
                            cid: cid
                        },
                        success: function(response) {
                            $('#size').html(response);
                        }
                    });
                }
            </script>
        </body>

        </html>
        <?php
    } else {
        echo 'Invalid Request';
    }
?>
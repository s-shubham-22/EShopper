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
    
    <!-- Double Slider -->
    <link rel="stylesheet" href="./css/double_range_slider.css">
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
                        $pgname = 'shop'; 
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
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="./index.php">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12" id="filter-container">
                <form id="filter-form">
                    <!-- Price Start -->
                    <div class="border-bottom mb-4 pb-4">
                        <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                        <?php
                            $sql = 'SELECT max(sale_price) FROM product WHERE status=1';
                            $result = mysqli_query($conn, $sql);

                            $sql2 = 'SELECT max(price) FROM product_variant WHERE status=1';
                            $result2 = mysqli_query($conn, $sql2);
                            if($result && $result2) {
                                $row = mysqli_fetch_assoc($result);
                                $max_price1 = $row['max(sale_price)'];
                                $row2 = mysqli_fetch_assoc($result2);
                                $max_price2 = $row2['max(price)'];
                                $max_price = max($max_price1, $max_price2);
                            }
                        ?>
                        <section class="range-slider mx-auto" id="price-slider">
                            <span class="output outputOne"></span>
                            <span class="output outputTwo"><?php echo $max_price; ?></span>
                            <span class="full-range"></span>
                            <span class="incl-range"></span>
                            <input name="minPrice" value="0" min="0" max="<?php echo $max_price; ?>" step="1" type="range">
                            <input name="maxPrice" value="<?php echo $max_price; ?>" min="0" max="<?php echo $max_price; ?>" step="1" type="range">
                        </section>
                    </div>
                    <!-- Price End -->
                    
                    <!-- Color Start -->
                    <div class="border-bottom mb-4 pb-4">
                        <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                        <?php
                            $sql = 'SELECT * FROM variant_details WHERE vid=1';
                            $result = mysqli_query($conn, $sql);
                            if($result && mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $value = $row['v_value'];
                                    ?>
                                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                        <input name="color[]" value="<?php echo $id; ?>" type="checkbox" class="custom-control-input" id="color_<?php echo $id; ?>">
                                        <label class="custom-control-label" for="color_<?php echo $id; ?>"><span style=" display: inline-block; width: 25px; height:25px; border-radius:4px; background-color: <?php echo $value; ?>"></span></label>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    <!-- Color End -->

                    <!-- Size Start -->
                    <div class="mb-5">
                        <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                        <?php
                            $sql = 'SELECT * FROM variant_details WHERE vid=2';
                            $result = mysqli_query($conn, $sql);
                            if($result && mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $value = $row['v_value'];
                                    ?>
                                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                        <input name="size[]" value="<?php echo $id; ?>" type="checkbox" class="custom-control-input" id="color_<?php echo $id; ?>">
                                        <label class="custom-control-label" for="color_<?php echo $id; ?>"><?php echo $value; ?></label>
                                    </div>
                                    <?php
                                }
                            }
                        ?>
                    </div>
                    <!-- Size End -->
                </form>
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3" id="product-list">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </div>
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                            Sort by
                                        </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" onclick="sort_by('latest');">Latest</a>
                                    <a class="dropdown-item" onclick="sort_by('pricel2h');">Price Low to High</a>
                                    <a class="dropdown-item" onclick="sort_by('priceh2l');">Price High to Low</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        $sql = "SELECT * FROM product WHERE status = 1";
                        if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['cid'])){
                            $sql = "SELECT * FROM product WHERE status = 1 AND cid = ".$_GET['cid'];
                        }
                        $result = mysqli_query($conn,$sql);
                        if($result && mysqli_num_rows($result) > 0) {
                            echo fetch_product($result);
                        }

                        function fetch_product($result) {
                            $output = '';
                            global $conn;
                            while($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $sale_price = $row['sale_price'];
                                $img_name = $row['img_name'];
                                $price_html = '';
                                $sql2 = "SELECT * FROM product_variant WHERE pid = ".$id;
                                $result2 = mysqli_query($conn,$sql2);
                                if($result2 && mysqli_num_rows($result2) > 0) {
                                    $sql2 = 'SELECT min(price), max(price) FROM product_variant WHERE pid = '.$id;
                                    $result2 = mysqli_query($conn, $sql2);
                                    if($result2 && mysqli_num_rows($result2) > 0) {
                                        $row2 = $result2->fetch_assoc();
                                        $price_html = '<h6>$'.$row2['min(price)'].' - $'.$row2['max(price)'].'</h6>';
                                    }
                                } else {
                                    $price_html = '<h6>$'.$sale_price.'</h6><h6 class="text-muted ml-2"><del>$'.$price.'</del></h6>';
                                }
                                $output .= '
                                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1 product_list product" id='.$id.'>
                                        <div class="card product-item border-0 mb-4">
                                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                                <a href="./detail.php?id='.$id.'"><img class="img-fluid w-100" src="./admin/uploads/product/'.$img_name.'" alt=""></a>
                                            </div>
                                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                                <h6 class="text-truncate mb-3">'.$title.'</h6>
                                                <div class="d-flex justify-content-center">
                                                    '.$price_html.'
                                                </div>
                                            </div>
                                            <div class="card-footer d-flex justify-content-between bg-light border">
                                                <a href="./detail.php?id='.$id.'" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                            return $output;
                        }
                    ?>
                    <div class="col-12 pb-1 product_list">
                        <nav aria-label="Page navigation">
                          <ul class="pagination justify-content-center mb-3">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                              </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                              <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    </div>                    
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->


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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- Double Range Slider -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="./js/double_range_slider.js"></script>

    <script>
        function clear_list() {
            $('.product_list').remove();
        }
        
        function sort_by(sort_type) {
            $.ajax({
                url: './ajax/sort_by.php',
                type: 'POST',
                data: {
                    sort_type: sort_type
                },
                success: function(data) {
                    $data = JSON.parse(data);
                    if($data.status == 'success') {
                        clear_list();
                        $('#product-list').append($data.html);
                        $('#product-list').append(`
                        <div class="col-12 pb-1 product_list">
                            <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                                </li>
                            </ul>
                            </nav>
                        </div>
                        `);
                    } else {
                        alert('Something went wrong');
                    }
                }
            });
        }

        $('#filter-container').mouseup(function() {
            setTimeout(() => {
                console.log($('#filter-form').serialize());
                $.ajax({
                    url: './ajax/filter.php',
                    type: 'POST',
                    data: $('#filter-form').serialize(),
                    success: function(data) {
                        if(data != 'error') {
                            clear_list();
                            $('#product-list').append(data);
                            $('#product-list').append(`
                            <div class="col-12 pb-1 product_list">
                                <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mb-3">
                                    <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                    </li>
                                </ul>
                                </nav>
                            </div>
                            `);
                        } else {
                            console.log(data);
                            alert('No Product Found');
                        }
                    }
                });
            }, 500);
        });
    </script>
</body>

</html>
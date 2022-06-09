<?php
    require './../includes/conn.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sort_type'])) {
        $sort_type = $_POST['sort_type'];
        if($sort_type == 'latest') {
            $sql = 'SELECT * FROM product ORDER BY id DESC';
        } else if ($sort_type == 'pricel2h') {
            $sql = 'SELECT p.id, p.title, p.img_name, p.sale_price, p.price as pprice, MIN(pv.price) as pvprice FROM product AS p LEFT JOIN product_variant AS pv ON p.id = pv.pid AND p.status=1 GROUP BY p.id ORDER BY pv.price, p.sale_price';
        } else if ($sort_type == 'priceh2l') {
            $sql = 'SELECT p.id, p.title, p.img_name, p.sale_price, p.price as pprice, pv.price as pvprice FROM product AS p LEFT JOIN product_variant AS pv ON p.id = pv.pid AND p.status=1 GROUP BY p.id ORDER BY  pv.price DESC, p.sale_price DESC';
        }
        $result = mysqli_query($conn, $sql);
        $html = '';
        if($result && mysqli_num_rows($result) > 0) {
            $html = fetch_product($result, $sort_type);
        } else {
            $html = '<div class="alert alert-danger">No product found</div>';
        }
        $output = array();
        $output['html'] = $html;
        $output['status'] = 'success';
        echo json_encode($output);
    }

    function fetch_product($result, $sort_type) {
        // $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // print_r($rows);
        $output = '';
        global $conn;
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $title = $row['title'];
            $img_name = $row['img_name'];
            if($sort_type == 'pricel2h' || $sort_type == 'priceh2l') {
                $pprice = $row['pprice'];
                $pvprice = $row['pvprice'];
            } else {
                $pprice = $row['price'];
            }
            $sale_price = $row['sale_price'];
            $price_html = '';
            if(isset($pvprice) && !is_null($pvprice)) {
                $sql = 'SELECT min(price), max(price) FROM product_variant WHERE pid = '.$id;
                $result2 = mysqli_query($conn, $sql);
                $row2 = $result2->fetch_assoc();
                $price_html = '<h6>$'.$row2['min(price)'].' - $'.$row2['max(price)'].'</h6>';
            } else {
                $price_html = '<h6>$'.$sale_price.'</h6><h6 class="text-muted ml-2"><del>$'.$pprice.'</del></h6>';
            }
            $output .= '
                <div class="col-lg-4 col-md-6 col-sm-12 pb-1 product_list" id='.$id.'>
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="./admin/uploads/product/'.$img_name.'" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">'.$title.'</h6>
                            <div class="d-flex justify-content-center">
                                '.$price_html.'
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        </div>
                    </div>
                </div>
            ';
        }
        return $output;
    }
?>
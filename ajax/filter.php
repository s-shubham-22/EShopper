<?php
    require './../includes/conn.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST' && ((isset($_POST['minPrice']) && isset($_POST['maxPrice'])) || isset($_POST['color']) || isset($_POST['size']))) {
        $minPrice = min($_POST['maxPrice'], $_POST['minPrice']);
        $maxPrice = max($_POST['maxPrice'], $_POST['minPrice']);
        if(isset($_POST['minPrice']) && isset($_POST['maxPrice'])) {
            $price_sql = 'AND p.sale_price BETWEEN '.$minPrice.' AND '.$maxPrice;
        } else {
            $price_sql = 'price > 0';
        }

        if(isset($_POST['color'])){
            $implode_color = implode(", ",$_POST['color']);
            $color_sql = 'AND pv.color IN ('.$implode_color.')';
        } else {
            $color_sql = '';
        }

        if(isset($_POST['size'])) {
            $implode_size = implode(", ",$_POST['size']);
            $size_sql = 'AND pv.size IN ('.$implode_size.')';
        } else {
            $size_sql = '';
        }
        
        // $sql = 'SELECT * FROM product AS p LEFT JOIN product_variant AS pv ON p.id = pv.pid WHERE p.status=1 AND p.sale_price BETWEEN 500 AND 700 AND pv.color IN (2, 3) AND pv.size IN (7, 9) GROUP BY p.id;
        $sql = 'SELECT p.id, p.title, p.price as pprice, p.sale_price, p.img_name, pv.price as pvprice FROM product AS p LEFT JOIN product_variant AS pv ON p.id = pv.pid WHERE p.status=1 '.$price_sql.' '.$color_sql.' '.$size_sql.' GROUP BY p.id';
        $result = mysqli_query($conn, $sql);
        $output = '';
        if($result && mysqli_num_rows($result) > 0) {
            while($row = $result->fetch_assoc()) {
                $id = $row['id'];
                $title = $row['title'];
                $pprice = $row['pprice'];
                $pvprice = $row['pvprice'];
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
                    $price_html = '<h6>$'.$sale_price.'</h6><h6 class="text-muted ml-2"><del>$'.$pprice.'</del></h6>';
                }
                $output .= '
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1 product_list" id='.$id.'>
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

            echo $output;
        } else {
            echo 'error';
        }

    }
?>
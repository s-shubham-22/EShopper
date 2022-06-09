<?php
    require './includes/conn.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user_id = $_POST['user_id'];
        $b_fname = $_POST['b_fname'];
        $b_lname = $_POST['b_lname'];
        $b_email = $_POST['b_email'];
        $b_mobile = $_POST['b_mobile'];
        $b_addr_1 = $_POST['b_addr_1'];
        $b_addr_2 = $_POST['b_addr_2'];
        $b_city = $_POST['b_city'];
        $b_state = $_POST['b_state'];
        $b_country = $_POST['b_country'];
        $b_zip = $_POST['b_zip'];
        $s_fname = $_POST['s_fname'];
        $s_lname = $_POST['s_lname'];
        $s_email = $_POST['s_email'];
        $s_mobile = $_POST['s_mobile'];
        $s_addr_1 = $_POST['s_addr_1'];
        $s_addr_2 = $_POST['s_addr_2'];
        $s_city = $_POST['s_city'];
        $s_state = $_POST['s_state'];
        $s_country = $_POST['s_country'];
        $s_zip = $_POST['s_zip'];
        $sql = "INSERT INTO orders (user_id, b_fname, b_lname, b_email, b_mobile, b_addr_1, b_addr_2, b_city, b_state, b_country, b_zip, s_fname, s_lname, s_email, s_mobile, s_addr_1, s_addr_2, s_city, s_state, s_country, s_zip) VALUES ('$user_id', '$b_fname', '$b_lname', '$b_email', '$b_mobile', '$b_addr_1', '$b_addr_2', '$b_city', '$b_state', '$b_country', '$b_zip', '$s_fname', '$s_lname', '$s_email', '$s_mobile', '$s_addr_1', '$s_addr_2', '$s_city', '$s_state', '$s_country', '$s_zip')";
        $result = mysqli_query($conn, $sql);
        if($result) {
            $order_id = mysqli_insert_id($conn);
            $sql = "SELECT * FROM cart WHERE id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) <= 0) {
                $sql = 'DELETE FROM orders WHERE id = '.$order_id;
                echo 'Invalid Request! No Products in Cart!';
                exit;
            }
            while($row = mysqli_fetch_assoc($result)) {
                print_r($row);
                $pid = $row['pid'];
                $sql2 = "SELECT * FROM product WHERE id = '$pid'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                $title = $row2['title'];
                $price = $row2['sale_price'];
                $qty = $row['qty'];
                $color = $row['color'];
                $size = $row['size'];
                if($color != 0 && $size != 0) {
                    $sql2 = 'SELECT * FROM product_variant WHERE pid = "'.$pid.'" AND color = "'.$color.'" AND size = "'.$size.'"';
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    $price = $row2['price'];
                }
                $total = $price * $qty;
                $sql2 = 'INSERT INTO order_details (order_id, pid, title, color, size, price, qty, total) VALUES ("'.$order_id.'", "'.$pid.'", "'.$title.'", "'.$color.'", "'.$size.'", "'.$price.'", "'.$qty.'", "'.$total.'")';
                $result2 = mysqli_query($conn, $sql2);
                if(!$result2) {
                    echo mysqli_error($conn);
                    exit;
                }
            }
            $sql = "DELETE FROM cart WHERE id = '$user_id'";
            $result = mysqli_query($conn, $sql);
            if($result) {
                header('Location: order_success.php?order_id='.$order_id);
            } else {
                echo mysqli_error($conn);
                exit;
            }
        }
    } else {
        echo 'Invalid Request';
    }
?>
<?php 
    require './../includes/conn.php';
    $id = $_POST['id'];
    $cart_id = $_POST['cart_id'];
    $sql = "DELETE FROM cart WHERE id = $id AND cart_id = $cart_id";
    $result = mysqli_query($conn, $sql);
    if($result) {
        echo 'success';
    } else {
        echo 'error';
    }
?>
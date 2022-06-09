<?php
    require './../includes/conn.php';
    $id = $_POST['id'];
    $pid = $_POST['pid'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $action = $_POST['action'];
    if($action == 'inc') {
        $sql = "UPDATE cart SET qty = qty + 1 WHERE pid = $pid AND id = $id AND color = $color AND size = $size";
    } else if($action == 'dec') {
        $sql = "UPDATE cart SET qty = qty - 1 WHERE pid = $pid AND id = $id AND color = $color AND size = $size";
    }
    $result = mysqli_query($conn, $sql);
    if($result) {
        $sql = "SELECT * FROM cart WHERE id = $id AND pid = $pid AND color = $color AND size = $size";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if($row['qty'] <= 0) {
            $sql = "DELETE FROM cart WHERE id = $id AND pid = $pid AND color = $color AND size = $size";
            $result = mysqli_query($conn, $sql);
        }
        echo 'success';
    } else {
        echo 'error';
    }
?>
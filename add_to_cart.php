<?php
    require './includes/conn.php';
    if(isset($_SESSION['username']) && isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $username = $_SESSION['username'];
        $pid = $_POST['id'];
        if(isset($_POST['color']) && isset($_POST['size'])) {
            $qty = $_POST['qty'];
            $color = $_POST['color'];
            $size = $_POST['size'];
            $sql = 'SELECT * FROM cart WHERE id = '.$id.' AND pid = '.$pid.' AND color = "'.$color.'" AND size = "'.$size.'"';
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $qty = $row['qty'] + $_POST['qty'];
                $sql = 'UPDATE cart SET qty = '.$qty.' WHERE id = '.$id.' AND pid = '.$pid.' AND color = "'.$color.'" AND size = "'.$size.'"';
                $result = mysqli_query($conn, $sql);
            } else {
                $sql = 'INSERT INTO cart (id, pid, color, size, qty) VALUES ('.$id.', '.$pid.', "'.$color.'", "'.$size.'", '.$qty.')';
                $result = mysqli_query($conn, $sql);
            }
        } else {
            $sql = 'SELECT * FROM cart WHERE id = '.$id.' AND pid = '.$pid;
            $result = mysqli_query($conn, $sql);
            $qty = $_POST['qty'];
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $qty = $row['qty'];
                $qty++;
                $sql = 'UPDATE cart SET qty = '.$qty.' WHERE id = '.$id.' AND pid = '.$pid;
                $result = mysqli_query($conn, $sql);
            } else {
                $sql = 'INSERT INTO cart (id, pid, qty) VALUES ('.$id.', '.$pid.', '.$qty.')';
                $result = mysqli_query($conn, $sql);
            }
        }
        echo 'success';
        header('Location: detail.php?id='.$pid);
        exit;
    } else {
        echo 'error-login';
        exit;
    }
?>
<?php
    require './includes/conn.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $sql = ' INSERT INTO query (name, email, subject, message) VALUES ("'.$name.'", "'.$email.'", "'.$subject.'", "'.$message.'") ';
        $result = mysqli_query($conn, $sql);
        if($result) {
            $_SESSION['success_contact'] = 1;
            echo 'Success';
            header('Location: contact.php#contact');
        } else {
            $_SESSION['error_contact'] = 1;
            header('Location: contact.php');
            echo 'Error';
        }
    } else {
        echo 'Invalid Request';
    }
?>
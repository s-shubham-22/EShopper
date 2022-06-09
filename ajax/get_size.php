<?php
    require './../includes/conn.php';
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $cid = $_POST['cid'];
        $sql = "SELECT * FROM product_variant WHERE id = '$id' AND color = '$cid'";
        $result = mysqli_query($conn, $sql);
        if($result && mysqli_num_rows($result) > 0){
            $output = '<p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>';
            $i = 0;
            while($row = mysqli_fetch_assoc($result)){
                $sql2 = 'SELECT * FROM variant_details WHERE id = "'.$row['size'].'"';
                $result2 = mysqli_query($conn, $sql2);
                if($result2 && mysqli_num_rows($result2) > 0){
                    $row2 = mysqli_fetch_assoc($result2);
                    $checked = '';
                    if($i == 0){
                        $checked = 'checked';
                    }
                    $output .= '
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="size_'.$row2['id'].'" value="'.$row2['id'].'" name="size" '.$checked.'>
                        <label class="custom-control-label" for="size_'.$row2['id'].'">'.$row2['v_value'].'</label>
                    </div>
                    ';
                }
            }
            echo $output;
        } 
    }
?>
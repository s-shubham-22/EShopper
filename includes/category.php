<nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 1;">
    <div class="navbar-nav w-100 overflow-hidden" style="height: auto">
        <?php
            $sql = 'SELECT * FROM category WHERE status=1';
            $result = mysqli_query($conn, $sql);
            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $img_name = $row['img_name'];
                    echo '<a id='.$id.' href="shop.php?cid='.$id.'" class="nav-item nav-link">'.$title.'</a>';
                }
            }
        ?>
    </div>
</nav>
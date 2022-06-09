<div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
    <div class="navbar-nav mr-auto py-0">
        <!-- Home -->
        <?php
            $proactive = '';
            if($pgname == 'home'){
                $proactive = 'active';
            }
        ?>
        <a href="index.php" class="nav-item nav-link <?php echo $proactive; ?>">Home</a>
        
        <!-- Shop -->
        <?php
            $proactive = '';
            if($pgname == 'shop' || $pgname == 'detail'){
                $proactive = 'active';
            }
        ?>
        <a href="shop.php" class="nav-item nav-link <?php echo $proactive; ?>">Shop</a>

        <!-- Contact -->
        <?php
            $proactive = '';
            if($pgname == 'contact'){
                $proactive = 'active';
            }
        ?>
        <a href="contact.php" class="nav-item nav-link <?php echo $proactive; ?>">Contact</a>
    </div>
    <?php
        if(isset($_SESSION['username'])) {
            ?>
                <div class="navbar-nav ml-auto py-0">
                    <!-- Logout -->
                    <?php
                        $proactive = '';
                        if($pgname == 'logout'){
                            $proactive = 'active';
                        }
                    ?>
                    <a href="logout.php" class="nav-item nav-link <?php echo $proactive; ?>">Log Out</a>

                    <!-- Profile -->
                    <?php
                        $proactive = '';
                        if($pgname == 'admin'){
                            $proactive = 'active';
                        }
                    ?>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle <?php echo $proactive; ?>" data-toggle="dropdown"><?php echo $_SESSION['username']; ?></a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="cart.php" class="dropdown-item">Shopping Cart</a>
                            <a href="checkout.php" class="dropdown-item">Checkout</a>
                        </div>
                    </div>
                </div>
            <?php
        } else {
            ?>
                <div class="navbar-nav ml-auto py-0">
                    <!-- Login -->
                    <?php
                        $proactive = '';
                        if($pgname == 'login'){
                            $proactive = 'active';
                        }
                    ?>
                    <a href="login.php" class="nav-item nav-link <?php echo $proactive; ?>">Login</a>

                    <!-- register -->
                    <?php
                        $proactive = '';
                        if($pgname == 'register'){
                            $proactive = 'active';
                        }
                    ?>
                    <a href="register.php" class="nav-item nav-link <?php echo $proactive; ?>">Register</a>
                </div>
            <?php
        }
    ?>
    
</div>
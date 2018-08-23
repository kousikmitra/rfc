<div class="topbar">
    <div class="logo">
        <img src="./images/logo.png" alt="logo" height=50>
    </div>
    <div class="menu">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./home.php">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./myprofile.php">My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./view_orders.php">My Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./complain.php">Any Complain?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">Logout</a>
                    </li>
                </ul>
                <?php
                if(isset($_SESSION['uid']) and $_SESSION['uid'] != ""){
                ?>
                <a href="./cart.php" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Cart</a>
                <?php
                }
                ?>
            </div>
        </nav>
    </div>
</div>
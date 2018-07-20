<?php
session_start();
include_once "./includes/dbconnection.php";
include_once "./includes/functions.php";
isLoggedIn();

$sql = "SELECT train_no, train_name, src, dest FROM train_route WHERE train_no='{$_SESSION['train']}'";
$traininfo = $conn->query($sql)->fetch_assoc();

$sql = "SELECT food.food_id as \"food_id\", food_name, cart_id, total_price, total_no
        FROM food, cart WHERE food.food_id = cart.food_id AND cart.user_id = '{$_SESSION['uid']}'";

$result = $conn->query($sql);

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php include_once "./includes/bootstrap.php"; ?>
        <link rel="stylesheet" href="./css/common.css">
        <link rel="stylesheet" href="./css/cart.css">
        <title>Cart |
            <?php echo $_SESSION['uname']; ?>
        </title>
    </head>

    <body>
        <div class="main">
            <?php include_once "./includes/topbar.php" ?>
            <div class="main-content">
                <div class="section1">
                    <div class="cart">
                        <div class="cart-left">
                                <div class="train-info">
                                    <center>
                                        <strong>Ordering Food on</strong>
                                        <p>Train :
                                            <strong><?php echo $traininfo['train_no']; ?> / <?php echo $traininfo['train_name']; ?></strong>
                                        </p>
                                        <P>From :
                                            <strong><?php echo $traininfo['src']; ?></strong> To :
                                            <strong><?php echo $traininfo['dest']; ?></strong>
                                        </P>
                                        <p>Journey Date :
                                            <strong><?php echo $_SESSION['doj']; ?></strong>
                                        </p>
                                    </center>
                                </div>
                                <div class="order-items">
                                <?php
                                $total = 0;
                                if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $total = $total + $row['total_price'];
                                ?>
                                    <div class="cart-item">
                                        <p><?php echo $row['food_name']; ?></p>
                                        <P>Rs. <?php echo $row['total_price']; ?></P>
                                        <div class="number-input">
                                            <span>
                                                <i class="fa fa-minus"></i>
                                            </span>
                                            <input type="text" name="number" id="number" value="<?php echo $row['total_no']; ?>" disabled>
                                            <span>
                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                                    ?>
                                </div>
                            </div>
                        <div class="cart-right">
                            <div class="add-more">
                                <a href="#" class="btn btn-primary">
                                    <i class="fa fa-cutlery"></i> Add More Items</a>
                            </div>
                            <div class="bill">
                                <table class="table">
                                    <tr>
                                        <td>SUBTOTAL :</td>
                                        <td>Rs. <?php echo $total; ?></td>
                                    </tr>
                                    <tr>
                                        <td>GST :</td>
                                        <td>Rs. 35</td>
                                    </tr>
                                    <tr>
                                        <td>TOTAL :</td>
                                        <td>Rs. <?php echo $total; ?></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="./checkout.php" class="btn btn-primary">Checkout</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>

    </html>
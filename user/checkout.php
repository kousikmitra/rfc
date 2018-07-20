<?php
session_start();
include_once "./includes/dbconnection.php";
include_once "./includes/functions.php";
isLoggedIn();

$sql = "SELECT train_no, train_name, src, dest FROM train_route WHERE train_no='{$_SESSION['train']}'";
$traininfo = $conn->query($sql)->fetch_assoc();

$sql = "SELECT sum(total_price) as \"total_price\", count(food_id) as \"total_food\" FROM `cart` WHERE user_id = '{$_SESSION['uid']}'";
$info = $conn->query($sql)->fetch_assoc();

$result = $conn->query($sql);

if(isset($_GET['orderfood'])){
    
    $ispnr = false;
    if(isset($_GET['pnr'])){
        $pnr = $_GET['pnr'];
        $ispnr = true;
    } else {
        $coachno = $_GET['coachno'];
        $seatno = $_GET['seatno'];
    }

    $sql = "SELECT * FROM cart WHERE user_id = '{$_SESSION['uid']}'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()){
        $sql = "";
        if($ispnr){
            $sql = "INSERT INTO order_food(train_no, user_id, food_id, total_no, price, total_price, order_date, order_time, pnr) VALUES 
                ('{$row['train_no']}','{$row['user_id']}','{$row['food_id']}','{$row['total_no']}','{$row['price']}','{$row['total_price']}',
                    CURDATE(),CURTIME(),'$pnr')";
            $conn->query($sql);
        } else {
            $sql = "INSERT INTO order_food(train_no, user_id, food_id, total_no, price, total_price, order_date, order_time, coach_no, seat_no) VALUES 
                ('{$row['train_no']}','{$row['user_id']}','{$row['food_id']}','{$row['total_no']}','{$row['price']}','{$row['total_price']}',
                    CURDATE(),CURTIME(),'$coachno','$seatno')";
            $conn->query($sql);
        }

    }

    $sql = "DELETE FROM cart WHERE user_id='{$_SESSION['uid']}'";
    $conn->query($sql);

    echo "<script>alert('Your Order Done!');</script>";

}



?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <?php include_once "./includes/bootstrap.php"; ?>
        <link rel="stylesheet" href="./css/common.css">
        <link rel="stylesheet" href="./css/checkout.css">
        <title>Checkout |
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
                                        <strong>
                                            <?php echo $traininfo['train_no']; ?> /
                                            <?php echo $traininfo['train_name']; ?>
                                        </strong>
                                    </p>
                                    <P>From :
                                        <strong>
                                            <?php echo $traininfo['src']; ?>
                                        </strong> To :
                                        <strong>
                                            <?php echo $traininfo['dest']; ?>
                                        </strong>
                                    </P>
                                    <p>Journey Date :
                                        <strong>
                                            <?php echo $_SESSION['doj']; ?>
                                        </strong>
                                    </p>
                                    <p>Total Items : <strong><?php echo $info['total_food']; ?></strong></p>
                                    <p>Total Price : <strong><?php echo $info['total_price']; ?></strong></p>
                                </center>
                            </div>
                            <div class="checkout">

                                <h4>Search & book Food in Train Online!</h4>
                                <div class="pnr">
                                    <form action="">
                                        <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <label class="sr-only" for="pnr">PNR</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">PNR</div>
                                                    </div>
                                                    <input type="text" name="pnr" class="form-control" id="pnr" placeholder="Enter 10 Digit PNR No.">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <input type="submit" class="btn btn-primary mb-2" name="orderfood" value="Order Food">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <center>OR</center><br>
                                <div class="pnr">
                                    <form action="">
                                        <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <label class="sr-only" for="coach-no">Coach No</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Coach No</div>
                                                    </div>
                                                    <input type="text" name="coachno" class="form-control" id="coach-no" placeholder="Enter Coach No">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <label class="sr-only" for="seat-no">Seat No</label>
                                                <div class="input-group mb-2">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Seat No</div>
                                                    </div>
                                                    <input type="text" name="seatno" class="form-control" id="seat-no" placeholder="Enter Seat No.">
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <input type="submit" class="btn btn-primary mb-2" name="orderfood" value="Order Food">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </body>

    </html>
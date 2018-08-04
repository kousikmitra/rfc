<?php
session_start();
include_once "./includes/dbconnection.php";
include_once "./includes/functions.php";
isLoggedIn();

if(isset($_GET['approve'])){
    $orderid = $_GET['approve'];
    $sql ="UPDATE order_food SET status=1 WHERE train_no='{$_SESSION['utrain']}' AND order_id='$orderid'";
    if($conn->query($sql)){
        echo "<script>alert('Order Approved'); window.location = './view_orders.php';</script>";
    } else {
        echo "<script>alert('Order Approved Failed'); window.location = './view_orders.php';</script>";
    }
}

if(isset($_GET['cancel'])){
    $orderid = $_GET['cancel'];
    $sql ="UPDATE order_food SET status=2 WHERE train_no='{$_SESSION['utrain']}' AND order_id='$orderid'";
    if($conn->query($sql)){
        echo "<script>alert('Order Canceled'); window.location = './view_orders.php';</script>";
    } else {
        echo "<script>alert('Order Canceled Failed'); window.location = './view_orders.php';</script>";
    }
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
    <link rel="stylesheet" href="./css/view_orders.css">
    <title>Admin Home</title>
    <style>
    #view-orders{
        background: #000000;
    }
    </style>
</head>
<body>
<div class="main">
        <?php include_once "./includes/topbar.php"; ?>
        <div class="main-content">
            <?php include_once "./includes/sidebar.php"; ?>
            <div class="content">
            <table class="table">
            <tr>
            <td>Order Id</td>
            <td>User Name</td>
            <td>Food Name</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Total Price</td>
            <td>Order Date</td>
            <td>Order Time</td>
            <td>Seat No</td>
            <td>Status</td>
            <td>Action</td>
            </tr>
            <?php
                $sql = "SELECT order_id, user.u_name AS \"u_name\", food.food_name AS \"food_name\", total_no, price, total_price, order_date, order_time, pnr, coach_no, seat_no, status FROM order_food, food, user WHERE order_food.food_id=food.food_id AND order_food.user_id=user.u_id AND order_food.train_no='{$_SESSION['utrain']}' ORDER BY order_date, order_time";
                $result = $conn->query($sql);
                // print_r($result);
                while($row = $result->fetch_assoc()){
            ?>
                    <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['u_name']; ?></td>
                    <td><?php echo $row['food_name']; ?></td>
                    <td><?php echo $row['total_no']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['total_price']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td><?php echo $row['order_time']; ?></td>
                    <td><?php echo $row['coach_no'].' - '.$row['seat_no']; ?></td>
                    <td>
                    <?php
                    switch($row['status']){
                        case 0:
                            echo "Active";
                            break;
                        case 1:
                            echo "Approved";
                            break;
                        case 2:
                            echo "Canceled by Admin";
                            break;
                        case 3:
                            echo "Canceled by User";
                            break;

                    }
                    ?>
                    </td>
                    <td>
                    <?php
                    if($row['status'] == 0){
                    ?>
                    <a href="./view_orders.php?approve=<?php echo $row['order_id']; ?>"><i style="color:green;" class="fa fa-check"></i></a> &nbsp;
                    <a href="./view_orders.php?cancel=<?php echo $row['order_id']; ?>"><i style="color:red;" class="fa fa-close"></i></a>
                    <?php
                    }
                    ?>
                    </td>
                    </tr>
            <?php
                }
            ?>
            </table>
            </div>
        </div>
    </div> 
</body>
</html>
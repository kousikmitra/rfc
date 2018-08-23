<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
isLoggedIn();


if(isset($_GET['cancel'])){
    $orderid = $_GET['cancel'];
    $sql ="UPDATE order_food SET status=3 WHERE train_no='{$_SESSION['utrain']}' AND order_id='$orderid'";
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
        <link rel="stylesheet" href="./css/home.css">
        <style>
        .main-content{
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 5%;
            padding-left: 5%;
            padding-right: 5%;
        }
        </style>
        <title>My Orders |
            <?php echo $_SESSION['uname']; ?>
        </title>
    </head>

    <body>
        <div class="main">
            <?php include_once "./includes/topbar.php" ?>
            <div class="main-content">
                <h1>My Orders</h1>
                <?php
                $sql = "SELECT order_id, user.u_name AS \"u_name\", food.food_name AS \"food_name\", total_no, price, total_price, order_date, order_time, pnr, coach_no, seat_no, status FROM order_food, food, user WHERE order_food.food_id=food.food_id AND order_food.user_id=user.u_id AND order_food.user_id='{$_SESSION['uid']}' ORDER BY order_date, order_time";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    ?>
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
            <?php
                } else {
            ?>
            <div class="alert alert-danger">
                        <strong>Not Found!</strong> No information found.
                        </div>
            <?php
                }
            ?>
            </div>
    </body>

    </html>
<?php
session_start();
include_once "./includes/dbconnection.php";
include_once "./includes/functions.php";
isLoggedIn();

if(isset($_GET['approve'])){
    $orderid = $_GET['approve'];
    $sql ="UPDATE order_food SET status=1 WHERE train_no='{$_SESSION['utrain']}' AND order_id='$orderid'";
    if($conn->query($sql)){
        echo "<script>alert('Order Approved!'); window.location = './view_orders.php';</script>";
    } else {
        echo "<script>alert('Order Approving Failed!'); window.location = './view_orders.php';</script>";
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
    .content{
        /* padding-left: 5%;
        padding-right: 5%; */
        padding-top: 2%;
        width: 80%;
    }
    .search-section{
        padding-left: 25%;
    }
    </style>
</head>
<body>
<div class="main">
        <?php include_once "./includes/topbar.php"; ?>
        <div class="main-content">
            <?php include_once "./includes/sidebar.php"; ?>
            <div class="content">
            <div>
            <center><h2>Orders of <?php echo date('d-M-Y'); ?></h2></center>
            <div class="search-section">
                        <form action="" method="get" class="form-inline">
                        <h5 class="mr-sm-4">Search Orders</h5>
                            <select name="searchby" id="search-by" class="form-control mr-sm-4">
                                <option value="all">View All</option>
                                <option value="uname">User Name</option>
                                <option value="foodname">Food Name</option>
                                <option value="foodcat">Food Category</option>
                            </select>
                            <input type="text" name="keyword" id="keyword" placeholder="Enter Search Keyword" value="<?php echo isset($_SESSION['search_key'])? $_SESSION['search_key'] : ""; ?>" class="form-control mr-sm-4" required>
                            <input type="submit" value="Search" name="search" class="btn btn-primary mr-sm-4">
                        </form>
                    </div><br>
            <?php
            $sql = "";
                if(isset($_GET['search'])) {
                    include_once "./includes/dbconnection.php";
                
                    $searchby = $_GET['searchby'];
                    $keyword = $_GET['keyword'];
                    $_SESSION['search_key'] = $_GET['keyword'];
                    $_SESSION['searchby'] = $_GET['searchby'];
                
                    if($searchby === "uname") {
                        $sql = "SELECT order_id, user.u_name AS \"u_name\", food.food_name AS \"food_name\", total_no, price, total_price, order_date, order_time, pnr, coach_no, seat_no, status FROM order_food, food, user WHERE order_food.food_id=food.food_id AND order_food.user_id=user.u_id AND order_food.train_no='{$_SESSION['utrain']}' AND user.u_name like '%$keyword%' AND order_date=CURDATE() ORDER BY order_date, order_time";
                    } elseif($searchby === "foodname") {
                        $sql = "SELECT order_id, user.u_name AS \"u_name\", food.food_name AS \"food_name\", total_no, price, total_price, order_date, order_time, pnr, coach_no, seat_no, status FROM order_food, food, user WHERE order_food.food_id=food.food_id AND order_food.user_id=user.u_id AND order_food.train_no='{$_SESSION['utrain']}' AND food.food_name like '%$keyword%' AND order_date=CURDATE() ORDER BY order_date, order_time";
                    } elseif($searchby === "foodcat") {
                        $sql = "SELECT order_id, user.u_name AS \"u_name\", food.food_name AS \"food_name\", total_no, price, total_price, order_date, order_time, pnr, coach_no, seat_no, status FROM order_food, food, user WHERE order_food.food_id=food.food_id AND order_food.user_id=user.u_id AND order_food.train_no='{$_SESSION['utrain']}' AND food.food_category like '%$keyword%' AND order_date=CURDATE() ORDER BY order_date, order_time";
                    } else {
                        $sql = "SELECT order_id, user.u_name AS \"u_name\", food.food_name AS \"food_name\", total_no, price, total_price, order_date, order_time, pnr, coach_no, seat_no, status FROM order_food, food, user WHERE order_food.food_id=food.food_id AND order_food.user_id=user.u_id AND order_food.train_no='{$_SESSION['utrain']}' AND order_date=CURDATE() ORDER BY order_date, order_time";
                    }
                } else {
                    $sql = "SELECT order_id, user.u_name AS \"u_name\", food.food_name AS \"food_name\", total_no, price, total_price, order_date, order_time, pnr, coach_no, seat_no, status FROM order_food, food, user WHERE order_food.food_id=food.food_id AND order_food.user_id=user.u_id AND order_food.train_no='{$_SESSION['utrain']}' AND order_date=CURDATE() ORDER BY order_date, order_time";
                }
                
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
            </div>
        </div>
    </div> 
</body>
</html>
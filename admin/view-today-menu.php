<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
isLoggedIn();

if(isset($_GET['delete'])){
    $sql = "DELETE FROM todaymenu WHERE id='{$_GET['delete']}'";
    if($conn->query($sql)){
        echo "<script>alert('Item Deleted!'); window.location = './view-today-menu.php';</script>";
    } else {
        echo "<script>alert('Item Deletetion Failed!'); window.location = './view-today-menu.php';</script>";
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
    <link rel="stylesheet" href="./css/admin_home.css">
    <link rel="stylesheet" href="./css/common.css">
    <title>View Today Menu</title>
    <style>
    #view-today-menu{
        background: #000000;
    }
    .content{
        padding-left: 1%;
        padding-right: 1%;
        padding-top: 1%;
        width: 80%;
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
            <?php include "./includes/manage-daily-menu-topbar.php"; ?>
            <div>
            <center><h2>View Today Menu</h2></center>
            <div class="search-section" style="padding-left:20%;">
                        <form action="" method="get" class="form-inline">
                        <h5 class="mr-sm-4">Search Orders</h5>
                            <select name="searchby" id="search-by" class="form-control mr-sm-4">
                                <option value="all">View All</option>
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
            
                if($searchby === "foodname") {
                    $sql = "SELECT id, food_name, food_desc, food_price,food_image, today FROM food,todaymenu  WHERE food.food_id=todaymenu.food_id AND food.food_name like '%$keyword%' AND today=CURDATE() AND todaymenu.train_no='{$_SESSION['utrain']}'";
                } elseif($searchby === "foodcat") {
                    $sql = "SELECT id, food_name, food_desc, food_price,food_image, today FROM food,todaymenu  WHERE food.food_id=todaymenu.food_id AND food.food_category like '%$keyword%' AND today=CURDATE() AND todaymenu.train_no='{$_SESSION['utrain']}'";
                } else {
                    $sql = "SELECT id, food_name, food_desc, food_price,food_image, today FROM food,todaymenu  WHERE food.food_id=todaymenu.food_id AND today=CURDATE() AND todaymenu.train_no='{$_SESSION['utrain']}'";
                }
            } else {
                $sql = "SELECT id, food_name, food_desc, food_price,food_image, today FROM food,todaymenu  WHERE food.food_id=todaymenu.food_id AND today=CURDATE() AND todaymenu.train_no='{$_SESSION['utrain']}'";
            }
                
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                $sr = 0;
                ?>

                <table class="table">
            <tr>
            <td>Sr. No</td>
            <td>Food Name</td>
            <td>Food Desc</td>
            <td>Food Price</td>
            <td>Food Image</td>
            <td>Today</td>
            <td>Action</td>
            </tr>
            <?php
                while($row = $result->fetch_assoc()){
                    $sr++;
            ?>
                    <tr>
                    <td><?php echo $sr; ?></td>
                    <td><?php echo $row['food_name']; ?></td>
                    <td><?php echo $row['food_desc']; ?></td>
                    <td><?php echo $row['food_price']; ?></td>
                    <td><img src="<?php echo $row['food_image']; ?>" alt="" width=40 height=40></td>
                    <td><?php echo $row['today']; ?></td>
                    <td>
                    <a href="./view-today-menu.php?delete=<?php echo $row['id']; ?>"><i style="color:red;" class="fa fa-close"></i></a>
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
    </div>
</body>
</html>
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
                $sql = "SELECT id, food_name, food_desc, food_price,food_image, today FROM food,todaymenu  WHERE food.food_id=todaymenu.food_id AND today=CURDATE() AND todaymenu.train_no='{$_SESSION['utrain']}'";
                $result = $conn->query($sql);
                $sr = 0;
                // print_r($result);
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
            </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
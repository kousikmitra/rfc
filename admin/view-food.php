<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
isLoggedIn();

if(isset($_GET['delete'])){
    $sql = "DELETE FROM food WHERE food_id='{$_GET['delete']}'";
    if($conn->query($sql)){
        echo "<script>alert('Food Deleted!'); window.location = './view-food.php';</script>";
    } else {
        echo "<script>alert('Food Deletetion Failed!'); window.location = './view-food.php';</script>";
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
    <title>View All Food</title>
    <style>
    #view-food{
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
            <?php include "./includes/manage-food-topbar.php"; ?>
            
            <center><h2>View All Food</h2></center>
            <table class="table">
            <tr>
            <td>Food ID</td>
            <td>Food Name</td>
            <td>Food Desc</td>
            <td>Food Category</td>
            <td>Food Price</td>
            <td>Food Image</td>
            <td>Action</td>
            </tr>
            <?php
                $sql = "SELECT * FROM food  WHERE train_no='{$_SESSION['utrain']}'";
                $result = $conn->query($sql);
                // print_r($result);
                while($row = $result->fetch_assoc()){
            ?>
                    <tr>
                    <td><?php echo $row['food_id']; ?></td>
                    <td><?php echo $row['food_name']; ?></td>
                    <td><?php echo $row['food_desc']; ?></td>
                    <td><?php echo $row['food_category']; ?></td>
                    <td><?php echo $row['food_price']; ?></td>
                    <td><img src="<?php echo $row['food_image']; ?>" alt="" width=40 height=40></td>
                    <td>
                    <a href="./update-food.php?update=<?php echo $row['food_id']; ?>"><i style="color:green;" class="fa fa-edit"></i></a> &nbsp;
                    <a href="./view-food.php?delete=<?php echo $row['food_id']; ?>"><i style="color:red;" class="fa fa-close"></i></a>
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
</body>
</html>
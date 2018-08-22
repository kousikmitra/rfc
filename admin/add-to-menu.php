<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
isLoggedIn();

if(isset($_GET['addtomenu'])){
    $sql = "INSERT INTO todaymenu (train_no,food_id,today) VALUES ('{$_SESSION['utrain']}', '{$_GET['addtomenu']}', CURDATE())";
    if($conn->query($sql)){
        echo "<script>alert('Item Added To Menu!'); window.location = './add-to-menu.php';</script>";
    } else {
        echo "<script>alert('Item Not Added!'); window.location = './add-to-menu.php';</script>";
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
    <title>Add To Menu</title>
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
            <center><h2>Add To Menu</h2></center>
            <table class="table">
            <tr>
            <td>Sr. No</td>
            <td>Food Name</td>
            <td>Food Desc</td>
            <td>Food Category</td>
            <td>Food Price</td>
            <td>Food Image</td>
            <td></td>
            <td>Action</td>
            </tr>
            <?php
                $sql = "SELECT food_id, food_name, food_desc,food_category, food_price,food_image FROM food WHERE train_no='{$_SESSION['utrain']}'";
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
                    <td><?php echo $row['food_category']; ?></td>
                    <td><?php echo $row['food_price']; ?></td>
                    <td><img src="<?php echo $row['food_image']; ?>" alt="" width=40 height=40></td>
                    <td>
                    <?php
                        $sql = "SELECT * FROM todaymenu WHERE food_id='{$row['food_id']}' AND train_no='{$_SESSION['utrain']}' AND today=CURDATE()";
                        $res = $conn->query($sql);
                        if($res->num_rows == 0){
                            ?>
                            </td>
                            <td>
                            <a href="./add-to-menu.php?addtomenu=<?php echo $row['food_id']; ?>">Add To Menu <i style="color:blue;" class="fa fa-check"></i></a>
                            <?php
                        } else {
                            ?>

                            <a href="#">Already Added <i style="color:blue;" class="fa fa-info"></i></a>
                            </td>
                            <td>
                            <a href="./add-to-menu.php?remove=<?php echo $row['food_id']; ?>" style="color:red;">Remove <i style="color:red;" class="fa fa-close"></i></a>
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
        </div>
    </div>
</body>
</html>
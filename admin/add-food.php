<?php
session_start();
include_once "./includes/functions.php";
isLoggedIn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/admin_home.css">
    <link rel="stylesheet" href="./css/common.css">
    <?php include_once "./includes/bootstrap.php"; ?>
    <title>Add Food</title>
    <style>
    #add-food{
        background: #000000;
    }
    .content{
        padding-left: 15%;
        padding-right: 15%;
        padding-top: 2%;
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
            <form action="" method="post">
                <center><h2>Add New Food</h2></center>
                <table class="table">
                <tr>
                <td><label for="f-name">Food Name</label></td>
                <td><input type="text" name="f_name" id="f-name" class="form-control"></td>
                </tr>
                <tr>
                <td><label for="f-desc">Food Description</label></td>
                <td><textarea type="text" name="f_desc" id="f-desc" class="form-control"></textarea></td>
                </tr>
                <tr>
                <td><label for="f-cat">Food Categories</label></td>
                <td><input type="text" name="f_cat" id="f-cat" class="form-control"></td>
                </tr>
                <tr>
                <td><label for="f-price">Food Price</label></td>
                <td><input type="text" name="f_price" id="f-price" class="form-control"></td>
                </tr>
                <tr>
                <td><label for="f-image">Food Image</label></td>
                <td><input type="text" name="f_image" id="f-image" class="form-control"></td>
                </tr>
                <tr>
                <td></td>
                <td><input type="submit" name="add_food" id="add_food" class="btn btn-primary" value="Add Food">
                <input type="reset" name="reset_form" id="reset-form" class="btn btn-primary" value="Clear">
                </td>
                </tr>
                </table>
            </form>
            </div>
        </div>
    </div>
</body>
</html>
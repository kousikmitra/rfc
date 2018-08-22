<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
isLoggedIn();



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
    <title>View New Complains</title>
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
            <?php include "./includes/manage-complains-topbar.php"; ?>
            
            <center><h2>Complain Details</h2></center>
            
            
            </div>
            </div>
        </div>
    </div>
</body>
</html>
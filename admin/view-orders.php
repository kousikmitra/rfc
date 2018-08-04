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
    <title>View Orders</title>
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
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Impedit numquam unde veniam optio nobis magnam, dignissimos repellendus qui beatae hic quaerat laudantium in modi dicta, animi consequatur, non quisquam at?
            </div>
        </div>
    </div>
</body>
</html>
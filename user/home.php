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
    <title>Home | <?php echo $_SESSION['uname']; ?></title>
</head>
<body>
    <a href="./logout.php">Logout</a>
</body>
</html>
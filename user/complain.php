<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
isLoggedIn();

if(isset($_POST['complain_submit'])){
    $sql = "INSERT INTO `complain`(`user_id`, `train_no`, `complain_name`, `complain_text`, `complain_date`, `complain_time`) 
                VALUES ('{$_SESSION['uid']}','{$_POST['train_no']}','{$_POST['complain_name']}','{$_POST['complain_details']}',CURDATE(),CURTIME())";

    if($conn->query($sql)){
        echo "<script>alert('Complain Register!');</script>";
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
        }
        </style>
        <title>Complains |
            <?php echo $_SESSION['uname']; ?>
        </title>
    </head>

    <body>
        <div class="main">
            <?php include_once "./includes/topbar.php" ?>
            <div class="main-content">
                <h1>Register your Complain</h1>
                <form action="" method="post">
                    <table class="table">
                        <tr>
                        <td><label for="train-no">Train No : </label></td><td></td>
                        <td><input type="text" name="train_no" id="train-no" class="form-control"></td>
                        </tr>
                        <tr>
                        <td><label for="complain-name">Complain Name : </label></td><td></td>
                        <td><input type="text" name="complain_name" id="complain-name" class="form-control"></td>
                        </tr>
                        <tr>
                        <td><label for="complain-details">Complain Details : </label></td><td></td>
                        <td><textarea name="complain_details" id="complain-details" cols="60" rows="10"></textarea></td>
                        </tr>
                        <tr>
                        <td></td><td></td>
                        <td><input type="submit" value="Submit" name="complain_submit" class="btn btn-primary" style="float:right;"></td>
                        </tr>
                    </table>
                </form>
            </div>
    </body>

    </html>
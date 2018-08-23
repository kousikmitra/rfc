<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
isLoggedIn();


    $sql = "SELECT * FROM user WHERE u_id='{$_SESSION['uid']}'";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if(isset($_POST['update'])){
        $sql = "UPDATE `user` SET `u_name`='{$_POST['name']}',`u_email`='{$_POST['email']}',`u_phone`='{$_POST['phone']}',`u_address`='{$_POST['addrs']}' WHERE u_id='{$_SESSION['uid']}'";
        if($conn->query($sql)){
            echo "<script>alert('Profile Updated'); window.location = './myprofile.php';</script>";
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
        table{
            width: 2000px;
        }
        </style>
        <title>My Profile |
            <?php echo $_SESSION['uname']; ?>
        </title>
    </head>

    <body>
        <div class="main">
            <?php include_once "./includes/topbar.php" ?>
            <div class="main-content">
                <h1>My Profile</h1>
                <form action="" method="post">
                    <table class="table">
                        <tr>
                        <td><label for="name"><h6>Name : </h6></label></td><td></td>
                        <td><input type="text" name="name" id="name" class="form-control" value="<?php echo $row['u_name']; ?>"></td>
                        </tr>
                        <tr>
                        <td><label for="email"><h6>Email : </h6></label></td><td></td>
                        <td><input type="text" name="email" id="email" class="form-control" value="<?php echo $row['u_email']; ?>"></td>
                        </tr>
                        <tr>
                        <td><label for="phone"><h6>Phone : </h6></label></td><td></td>
                        <td><input type="text" name="phone" id="phone" class="form-control" value="<?php echo $row['u_phone']; ?>"></td>
                        </tr>
                        <tr>
                        <td><label for="addrs"><h6>Address : </h6></label></td><td></td>
                        <td><textarea name="addrs" id="addrs" class="form-control"><?php echo $row['u_address']; ?></textarea></td>
                        </tr>
                        <tr>
                        <td></td><td></td>
                        <td><input type="submit" value="Update Profile" name="update" class="btn btn-primary" style="float:right;"></td>
                        </tr>
                        <tr>
                        <td></td><td></td>
                        <td><a href="#" style="float:right; color:orange;">Change Password</a></td>
                        </tr>
                    </table>
                </form>
            </div>
    </body>

    </html>
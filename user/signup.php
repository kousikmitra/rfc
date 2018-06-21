<?php
session_start();
$_SESSION['err_msg'] = "";

if(isset($_POST['signup'])){
    include_once "./includes/dbconnection.php";

    $uname = $_POST['name'];
    $uemail = $_POST['email'];
    $uphone = $_POST['phone'];
    $uaddress = $_POST['address'];
    $upass = md5($_POST['password']);

    $sql = "INSERT INTO user (u_name, u_email, u_password, u_phone, u_address) VALUES ('$uname',
                '$uemail', '$upass', '$uphone', '$uaddress')";

    if($conn->query($sql)){
        echo "<script>alert('Sign Up Complete! You can login');</script>";
    } else {
        $_SESSION['err_msg'] = $conn->error;
        echo "<script>alert('Sign Up Failed! Try Again');</script>";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/signup.css">
    <link rel="stylesheet" href="../vendor/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="main">
        <div class="topbar">
            <div class="header">
            <img src="./images/logo.png" alt="">
            </div>
        </div>
        <div class="signup-div">
             <div class="signup">
             <form action="" method="post">
        <fieldset>
                   <legend>Sign Up</legend>
                   <?php
                   if($_SESSION['err_msg'] != ""){
                   ?>
                   <div class="alert alert-danger">
                    <strong>Failed!</strong> <?php echo $_SESSION['err_msg']; ?>
                    </div>
                    <?php
                   }
                   ?>
                   <div class="form-group">
                    <label for="name">Name :</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                   <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label for="phone">Phone :</label>
                    <input type="phone" name="phone" id="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label for="address">Address :</label>
                    <textarea name="address" id="address" cols="30" rows="5" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label for="password">Confirm Password :</label>
                    <input type="password" name="confirm_password" id="confirm-password" class="form-control" required>
                    </div>
                    <input type="submit" value="Sign Up" name="signup" id="signup" class="btn btn-primary">
                   </fieldset>
        </form>
            </div>
        </div>
       
    </div>
    
    <script src="../vendor/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
</body>
</html>
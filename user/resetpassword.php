<?php
include_once "./includes/dbconnection.php";
include_once "./includes/functions.php";

session_start();
$_SESSION['err_msg'] = "";

if(!isset($_SESSION['resetemail'])
    and !isset($_SESSION['resetotp'])){
        if($_SESSION['resetotp'] == ""
            and $_SESSION['resetemail'] == ""){
                header('location:./forgotpassword.php');
            }
    } else if(isset($_POST['resetpassword'])){
        if(isset($_SESSION['resetemail'])
            and isset($_SESSION['resetotp'])){
             if($_SESSION['resetotp'] != ""
                 and $_SESSION['resetemail'] != ""){
                    $sql = "SELECT email FROM forgotpass WHERE email='{$_SESSION['resetemail']}' AND otp='{$_SESSION['resetotp']}'";
                    $result = $conn->query($sql);
                    if($result->num_rows == 1){
                        $row = $result->fetch_assoc();
                        $newpass = md5($_POST['password']);
                        $sql = "UPDATE user SET u_password = '$newpass' WHERE u_email='{$row['email']}'";
                        if($conn->query($sql)){
                            $conn->query("DELETE FROM forgotpass WHERE email='{$row['email']}'");
                            echo "<script>alert('Password Reset Successful');window.location = './index.php';</script>";
                            $_SESSION['resetemail'] = "";
                            $_SESSION['resetotp'] = "";
                        } else{
                            $_SESSION['err_msg'] = "Try Again";
                        }                        
                    } else {
                        header('location:./forgotpassword.php');
                    }
            }
        
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
        <link rel="stylesheet" href="./css/index.css">
        <style>
            .main-content {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding-top: 10%;
            }
        </style>
        <title>Reset Password</title>
    </head>

    <body>
        <div class="main">
            <div class="top-bar">
                <div class="logo">
                    <img src="./images/logo.png" alt="">
                </div>
                <div class="menu">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Home
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Link</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Disabled</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Disabled</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Disabled</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Disabled</a>
                                </li>
                            </ul>

                        </div>
                    </nav>
                </div>
            </div>
            <div class="main-content">
                <div>
                    <a href="./index.php" class="arrow">
                        <i class="fa fa-arrow-left"></i> Back to Login</a>
                    <form action="resetpassword.php" method="post">
                        <fieldset>
                            <legend>Reset Your Password</legend>
                            <?php
                      if($_SESSION['err_msg'] != "")
                      {
                      ?>
                                <div class="alert alert-danger">
                                    <strong>
                                        <?php echo $_SESSION['err_msg']; $_SESSION['err_msg'] = ""; ?>
                                    </strong>
                                </div>
                                <?php
                      }
                      ?>
                                    <div class="form-group">
                                        <label for="password">Password :</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirmpassword">Confirm Password :</label>
                                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="resetpassword" value="Reset Password" class="form-control btn btn-primary">
                                    </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </body>

    </html>
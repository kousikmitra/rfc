<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
include_once "./includes/dbconnection.php";
include_once "./includes/functions.php";

$_SESSION['err_msg'] = "";
$flag = false;

if(isset($_POST['reset'])) {
        
    $email = $_POST['email'];
    
    if($email != "") {

            $sql = "SELECT u_email FROM user WHERE u_email='$email'";
            $result = $conn->query($sql);
            if($result->num_rows == 1){
                $row = $result->fetch_assoc();

                $otp = randomNumber(5);


                $sql = "INSERT INTO forgotpass (email, otp) VALUES ('$email', '$otp') ON DUPLICATE KEY UPDATE otp='$otp'";
                if($conn->query($sql)){
                    $_SESSION['resetemail'] = $email;
                    $flag = true;
                    sendResetMail($email, $otp);
                } else {
                    $_SESSION['resetemail'] = "";
                    $_SESSION['err_msg'] = $conn->error;
                    $flag = false;
                }
            } else {
                echo "<script>alert('Email doesn't Exist !');</script>";
                $_SESSION['err_msg'] = $conn->error;
            }

        } else {
            $_SESSION['err_msg'] = "Please Enter Email or Password!";

        }
} else if(isset($_POST['resetbyotp'])) {
    if($_POST['otp'] != ""){
        $otp = $_POST['otp'];
        $sql = "SELECT email, otp FROM forgotpass WHERE email='{$_SESSION['resetemail']}' AND otp='$otp'";
            $result = $conn->query($sql);
            if($result->num_rows == 1){
                $row = $result->fetch_assoc();

                $_SESSION['resetemail'] = $row['email'];
                $_SESSION['resetotp'] = $row['otp'];
                header('location:./resetpassword.php');
            } else {
                $_SESSION['err_msg'] = "Wrong OTP";
                $flag = true;
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
        .main-content{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding-top: 10%;
        }
        </style>
        <title>Forgot Password</title>
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
                <a href="./index.php" class="arrow"><i class="fa fa-arrow-left"></i> Back to Login</a>
              <?php
              if($flag == false){
              ?>
                <form action="forgotpassword.php" method="post">
                  <fieldset>
                      <legend>Reset Password</legend>
                      <?php
                      if($_SESSION['err_msg'] != "")
                      {
                      ?>
                      <div class="alert alert-danger">
                          <strong><?php echo $_SESSION['err_msg']; $_SESSION['err_msg'] = ""; ?></strong>    
                      </div>
                      <?php
                      }
                      ?>
                  <div class="form-group">
                      <label for="email">Email :</label>
                      <input type="email" name="email" id="email" class="form-control">
                  </div>
                  <div class="form-group">
                      <input type="submit" name="reset" value="Reset Password" class="form-control btn btn-primary">
                  </div>
                  </fieldset>
              </form>
              <?php
              } else {
              ?>
                <form action="forgotpassword.php" method="post">
                  <fieldset>
                      <legend>Reset Password</legend>
                      <?php
                      if($_SESSION['err_msg'] != "")
                      {
                      ?>
                      <div class="alert alert-danger">
                          <strong><?php echo $_SESSION['err_msg']; $_SESSION['err_msg'] = ""; ?></strong>    
                      </div>
                      <?php
                      }
                      ?>
                  <div class="form-group">
                      <label for="otp">OTP :</label>
                      <input type="text" name="otp" id="otp" class="form-control">
                  </div>
                  <div class="form-group">
                      <input type="submit" name="resetbyotp" value="Reset Password" class="form-control btn btn-primary">
                  </div>
                  </fieldset>
              </form>
              <?php
              }
              ?>
          </div>
            </div>
    </body>

    </html>
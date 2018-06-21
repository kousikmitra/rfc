<?php
session_start();
$_SESSION['err_msg'] = "";

if(isset($_POST['login'])){
    include_once "./includes/dbconnection.php";

    
    $uemail = $_POST['email'];
    $upass = md5($_POST['password']);

    $sql = "SELECT u_id, u_name, u_email FROM user WHERE u_email='$uemail' AND u_password='$upass'";

    $result = $conn->query($sql);

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $_SESSION['uid'] = $row['u_id'];
        $_SESSION['uname'] = $row['u_name'];
        $_SESSION['uemail'] = $row['u_email'];
        header('location:./home.php');
    } else {
        $_SESSION['err_msg'] = "Wrong Email Id or Password";
        
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="../vendor/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <title>Rail Food Login</title>
</head>
<body>
    <div class="main">
        <div class="top-bar">
            
     <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
     <a class="navbar-brand" href="#">
     <div class="title">
                <img src="./images/logo.png" alt="">
            </div>
    </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
          </ul>
          
        </div>
      </nav>
        </div>
        
        <div class="main-content">
            <div class="login-section">
                <div class="head-text">
                    <h1>Get food delivered on train berth</h1>
                </div>
            <div class="login">
                <form action="" method="post" class="login-form">
                   <fieldset>
                   <legend>Login</legend>
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
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <input type="submit" value="login" name="login" id="login" class="btn btn-primary"><br><br>
                    <a href="#">forgot password?</a><br>
                    <a href="./signup.php">Sign Up!</a>
                   </fieldset>
                </form>
            </div>
            </div>

        </div>
    </div>
    <script src="../vendor/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
</body>
</html>
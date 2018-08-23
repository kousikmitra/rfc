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
        <?php include_once "./includes/bootstrap.php"; ?>
        <link rel="stylesheet" href="./css/index.css">
        <title>Rail Food Login</title>
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
                                        <strong>Failed!</strong>
                                        <?php echo $_SESSION['err_msg']; ?>
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
                                        <input type="submit" value="login" name="login" id="login" class="btn btn-primary">
                                        <br>
                                        <br>
                                        <a href="./forgotpassword.php">forgot password?</a>
                                        <br>
                                        <a href="./signup.php">Sign Up!</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="mid">
                    <h1>Order Food In Simple Steps</h1>
                    <div class="order-step">
                        <div>
                            <img src="https://www.railrestro.com/img/step1.gif " class="stepimages" title="#" alt="Favorite Food - Rail restro" rel="nofollow">
                            <p class="step">
                                <b>Enter PNR or Train Number.</b>
                            </p>
                        </div>
                        <div>
                            <img src="https://www.railrestro.com/img/step2.png " class="stepimages" title="#" alt="Favorite Food - Rail restro" rel="nofollow">
                            <p class="step">
                                <b>Choose your favourite food.</b>
                            </p>
                        </div>
                        <div>
                            <img src="https://www.railrestro.com/img/step3.png " class="stepimages" title="#" alt="Favorite Food - Rail restro" rel="nofollow">
                            <p class="step">
                                <b>Pay cash on delivery.</b>
                            </p>
                        </div>
                        <div>
                            <img src="https://www.railrestro.com/img/step4.jpg " class="stepimages" title="#" alt="Favorite Food - Rail restro" rel="nofollow">
                            <p class="step">
                                <b>Enjoy your food at your Seat.</b>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mid2">
                    <div class="slide-show" style="height:350px; width: 600px; margin-top:50px;">
                        <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="./images/food 1.jpg" style="height:350px; width: 400px;" alt="First slide">

                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="./images/food 2.jpg" style="height:350px; width: 400px;" alt="Second slide">

                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="./images/food 3.jpg" style="height:350px; width: 400px;" alt="Third slide">

                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="./images/food 4.jpg" style="height:350px; width: 400px;" alt="Third slide">

                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="./images/logo 6.jpg" style="height:350px; width: 400px;" alt="Third slide">

                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>
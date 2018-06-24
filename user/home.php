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
        <?php include_once "./includes/bootstrap.php"; ?>
        <link rel="stylesheet" href="./css/common.css">
        <link rel="stylesheet" href="./css/home.css">
        <title>Home |
            <?php echo $_SESSION['uname']; ?>
        </title>
    </head>

    <body>
        <div class="main">
            <?php include_once "./includes/topbar.php" ?>
            <div class="main-content">
                <div class="section1">
                    <div class="panel1">
                        <h4>Search & book Food in Train Online!</h4>
                        <div class="pnr">
                            <form>
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label class="sr-only" for="pnr">PNR</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">PNR</div>
                                            </div>
                                            <input type="text" name="pnr" class="form-control" id="pnr" placeholder="Enter 10 Digit PNR No.">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-2" name="searchbypnr">Search Food</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <hr>
                        <center>OR</center>
                        <div class="train-no">
                            <form action="" class="form-horizontal">
                                <div class="align-items-center">
                                    <div class="col-auto">
                                        <label class="sr-only" for="train-no">Train No.</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Train No.</div>
                                            </div>
                                            <input type="text" name="trainno" class="form-control" id="train-no" placeholder="Enter Train No.">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <label class="sr-only" for="date">Date</label>
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Date</div>
                                            </div>
                                            <input type="date" class="form-control" id="date" placeholder="Date of Journey" name="doj" value="">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-2" name="searchbytrain" style="float:right;">Search Food</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="panel2">
                        <div class="slide-show" style="height:350px; width: 600px; border-radius:10px;">
                            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="./images/logo 1.jpg" style="height:350px; width: 400px;" alt="First slide">

                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="./images/logo 2.jpg" style="height:350px; width: 400px;" alt="Second slide">

                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="./images/logo 3.jpg" style="height:350px; width: 400px;" alt="Third slide">

                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="./images/logo 5.jpg" style="height:350px; width: 400px;" alt="Fourth slide">

                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="./images/logo6.jpg" style="height:350px; width: 400px;" alt="Fifth slide">

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
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
        <link rel="stylesheet" href="./css/food.css">
        <title>Home |
            <?php echo $_SESSION['uname']; ?>
        </title>
    </head>

    <body>
        <div class="main">
            <?php include_once "./includes/topbar.php" ?>
            <div class="main-content">
                <div class="section1">
                    <div>
                        <h5>Ordering Food in:
                            <strong>12311 / HWH DLIKLK MAIL</strong>
                        </h5>
                        <h5>Boarding:
                            <strong>HWH</strong> To
                            <strong>KLK</strong>
                        </h5>
                    </div>
                    <div>
                        <p>
                            <strong>DOJ: 25-06-2018</strong>
                        </p>
                        <a href="/" class="btn btn-sm btn-danger" style="margin-top:0px;">
                            <i class="fa fa-chevron-left"></i> &nbspCHANGE JOURNEY DETAILS</a>
                    </div>
                </div>
                <div class="filters">
                    <form>
                        <div class="form-row align-items-center">
                            <div class="col-auto mr-5">
                                <label class="sr-only" for="mealtime">Meal Time</label>
                                <div class="input-group mr-5">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Meal Time</div>
                                    </div>
                                    <select name="mealtime" id="mealtime" class="form-control">
                                        <option value="all">All</option>
                                        <option value="snacks">Snacks</option>
                                        <option value="breakfast">Breakfast</option>
                                        <option value="lunch">Lunch</option>
                                        <option value="dinner">Dinner</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto mr-5">
                                <label class="sr-only" for="mealtype">Meal Type</label>
                                <div class="input-group mr-5">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Meal Type</div>
                                    </div>
                                    <select name="mealtype" id="mealtype" class="form-control">
                                        <option value="any" selected>Any</option>
                                        <option value="veg">Veg Meal</option>
                                        <option value="nonveg">Non Veg Meal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto">
                                <input type="submit" class="btn btn-primary" name="applyfilter" value="Apply Filter">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="items">
                    <?php 
                    for($i=0; $i<10; $i++)
                    include "./includes/item.php"; 
                    ?>
                </div>
            </div>
    </body>

    </html>
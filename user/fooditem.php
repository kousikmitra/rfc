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
        <link rel="stylesheet" href="./css/fooditem.css">
        <title>Home |
            <?php echo $_SESSION['uname']; ?>
        </title>
    </head>

    <body>
        <div class="main">
            <?php include_once "./includes/topbar.php" ?>
            <div class="main-content">
                <div class="section1">
                    <div class="food">
                        <div class="food-image">
                            <img src="./images/food 2.jpg" alt="Food" width=500 height=300>
                        </div>
                        <div class="food-detail">
                            <div class="food-name">
                                <h1>Butter Paneer Masala</h1>
                            </div>
                            <div class="category">
                                <p>Dinner, Lunch | Non-Veg</p>
                            </div>
                            <div class="price">
                                <h5>
                                    <i class="fa fa-rupee"></i> 135.00</h5>
                            </div>
                            <div class="rating">
                                <table>
                                    <tr>
                                        <td>
                                            <div>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star checked"></span>
                                                <span class="fa fa-star-o"></span>
                                                <span class="fa fa-star-o"></span>
                                            </div>
                                        </td>
                                        <td>
                                            <small style="font-size:16px;"> &nbsp;&nbsp;Rating 2.81 / 5 | Reviews 449</small>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="icons">
                                <img src="https://www.railrestro.com/img/icons/1.png" title="Veg Food">
                                <img src="https://www.railrestro.com/img/icons/2.png" title="Veg Food">
                                <img src="https://www.railrestro.com/img/icons/3.jpg" title="Veg Food">
                                <img src="https://www.railrestro.com/img/icons/5.png" title="Veg Food">
                            </div>
                            <div class="order">
                                <form>
                                    <div class="form-row">
                                        <div class="col-5 mr-5">
                                            <label class="sr-only" for="ordertotal">How much?</label>
                                            <div class="input-group mr-5">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">How much?</div>
                                                </div>
                                                <select name="ordertotal" class="form-control" id="ordertotal">
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                    <option value="4">Four</option>
                                                    <option value="5">Five</option>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <input type="submit" class="btn btn-primary" name="addtocart" value="Add to List">
                                        </div>
                                        <div class="col-auto">
                                            <input type="submit" class="btn btn-primary" name="order" value="Order Now">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>

    </html>
    r-jio@india.com
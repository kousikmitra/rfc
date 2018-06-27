<?php
session_start();
include_once "./includes/dbconnection.php";
include_once "./includes/functions.php";
isLoggedIn();

if(isset($_GET['searchbytrain'])){
    $trainno = $_GET['trainno'];
    $date = $_GET['doj'];

    $trainq = "SELECT * FROM train_route WHERE train_no='$trainno'";
    $traininfo = $conn->query($trainq)->fetch_assoc();
    
    $sql = "SELECT food.food_id as \"food_id\", food_name, food_category, food_price, food_image FROM todaymenu, food WHERE todaymenu.food_id=food.food_id AND train_no='$trainno' AND today=CURDATE()";
    $result = $conn->query($sql);
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
        <link rel="stylesheet" href="./css/food.css">
        <title>Search Foods |
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
                            <strong><?php echo $traininfo['train_no']." / ".$traininfo['train_name']; ?></strong>
                        </h5>
                        <h5>Boarding:
                            <strong><?php echo $traininfo['src']; ?></strong> To
                            <strong><?php echo $traininfo['dest']; ?></strong>
                        </h5>
                    </div>
                    <div>
                        <p>
                            <strong>DOJ: <?php echo $date; ?></strong>
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
                    while($row = $result->fetch_assoc())
                    include "./includes/item.php"; 
                    ?>
                </div>
            </div>
    </body>

    </html>
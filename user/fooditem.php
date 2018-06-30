<?php
session_start();
include_once "./includes/dbconnection.php";
include_once "./includes/functions.php";
isLoggedIn();

if(isset($_GET['trainno']) and isset($_GET['food_id']) and $_GET['trainno'] != "" and $_GET['food_id'] != ""){
    $trainno = $_GET['trainno'];
    $foodid = $_GET['food_id'];
    $sql = "SELECT food.food_id as \"food_id\", food_name, food_category, food_price, food_image FROM todaymenu, food WHERE todaymenu.food_id=food.food_id AND train_no='$trainno' AND today=CURDATE() AND food.food_id='$foodid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if(isset($_GET['addtocart'])){
    $trainno = $_GET['train_no'];
    $foodid = $_GET['food_id'];
    $totalno = $_GET['ordertotal'];
    $price = $_GET['price'];
    $totalprice = $totalno * $price;

    $sql = "INSERT INTO cart (train_no, user_id, food_id, total_no, price, total_price, order_date) 
            VALUES ('$trainno', '{$_SESSION['uid']}', '$foodid', '$totalno', '$price', '$totalprice', CURDATE())
            ON DUPLICATE KEY UPDATE total_no='$totalno', price='$price', total_price='$totalprice'";
    
    if($conn->query($sql)){
        echo "<script>alert('Item Added into Cart !'); window.location = './fooditem.php?trainno=$trainno&food_id=$foodid';</script>";
    } else {
        echo "<script>alert('Item Failed to Add into Cart !'); window.location = './fooditem.php?trainno=$trainno&food_id=$foodid';</script>";
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
        <link rel="stylesheet" href="./css/fooditem.css">
        <title><?php echo $row['food_name']; ?> |
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
                            <img src="./images/food/<?php echo $row['food_image']; ?>" alt="Food" width=500 height=300>
                        </div>
                        <div class="food-detail">
                            <div class="food-name">
                                <h1><?php echo $row['food_name']; ?></h1>
                            </div>
                            <div class="category">
                                <p><?php echo strtoupper($row['food_category']); ?></p>
                            </div>
                            <div class="price">
                                <h5>
                                    <i class="fa fa-rupee"></i> <?php echo $row['food_price']; ?></h5>
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
                                <form action="">
                                    <input type="hidden" name="train_no" value="<?php echo $trainno; ?>">
                                    <input type="hidden" name="food_id" value="<?php echo $row['food_id']; ?>">
                                    <input type="hidden" name="price" value="<?php echo $row['food_price']; ?>">
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
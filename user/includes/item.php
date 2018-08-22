<div class="col-md-5 col-xs-12">
    <div class="item">
        <div class="head"></div>
        <div class="main-item">
            <div class="food-image">
                <div style="padding:4px;border:0.5px #b1adadaf solid; border-radius:2%; width: auto;">
                    <img src="<?php echo $row['food_image']; ?>" alt="" height=150 width=150>
                </div>
            </div>
            <div class="food-detail">
                <h4 class="food-name"><?php echo $row['food_name']; ?></h4>
                <div class="price">
                    <p>
                        <i class="fa fa-rupee"></i> <?php echo $row['food_price']; ?></p>
                </div>
                <table class="rating">
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
                            <small style="font-size:12px;"> &nbsp;&nbsp;Rating 2.81 / 5 | Reviews 449</small>
                        </td>
                    </tr>
                </table>
                <p>
                    <small> MIN-ORDER
                        <strong>199</strong>
                        <span class="text-danger">
                            <span class="fa fa-clock-o" title="Order Before Minutes"></span> 60 MINUTES</span>
                    </small>
                </p>
                <div>
                <div class="icons">
                <img src="https://www.railrestro.com/img/icons/1.png" title="Veg Food">
                <img src="https://www.railrestro.com/img/icons/2.png" title="Veg Food">
                <img src="https://www.railrestro.com/img/icons/3.jpg" title="Veg Food">
                <img src="https://www.railrestro.com/img/icons/5.png" title="Veg Food">
                </div>
                <div class="order">
                <a href="./fooditem.php?trainno=<?php echo $trainno ?>&food_id=<?php echo $row['food_id']; ?>" class="btn btn-success"><span class="fa fa-cutlery"></span> Order Food</a>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
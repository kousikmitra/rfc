<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
isLoggedIn();

if(isset($_POST['update_food'])){
    $foodid = $_POST['f_id'];
    $foodname = $_POST['f_name'];
    if(!($_FILES['f_image']['error'] > 0)){
        $target_dir = "../food/";
        $image = $target_dir.$foodname.".jpg";
        $target_file = $target_dir . $foodname.".jpg";
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["f_image"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        if ($_FILES["f_image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["f_image"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["f_image"]["name"]). " has been uploaded.";
                
                
                $sql = "UPDATE food SET food_name='{$_POST['f_name']}',food_desc='{$_POST['f_desc']}',food_category='{$_POST['f_cat']}',food_price='{$_POST['f_price']}',food_image='$image' WHERE food_id='$foodid'";
                $conn->query($sql);

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        } else {
            $sql = "UPDATE food SET food_name='{$_POST['f_name']}',food_desc='{$_POST['f_desc']}',food_category='{$_POST['f_cat']}',food_price='{$_POST['f_price']}' WHERE food_id='$foodid'";
            $conn->query($sql);
        }   
}

$sql = "SELECT * FROM food WHERE food_id='{$_GET['update']}'";
$result = $conn->query($sql);
$food = $result->fetch_assoc();

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="./css/admin_home.css">
        <link rel="stylesheet" href="./css/common.css">
        <?php include_once "./includes/bootstrap.php"; ?>
        <title>Update Food Details</title>
        <style>
            #add-food {
                background: #000000;
            }

            .content {
                padding-left: 15%;
                padding-right: 15%;
                padding-top: 2%;
                width: 80%;
            }
        </style>
    </head>

    <body>
        <div class="main">
            <?php include_once "./includes/topbar.php"; ?>
            <div class="main-content">
                <?php include_once "./includes/sidebar.php"; ?>
                <div class="content">
                <div>
                <?php include "./includes/manage-food-topbar.php"; ?>
                <form action="" method="post" enctype="multipart/form-data">
                        <center>
                            <h2>Update Food Details</h2>
                        </center>
                        <table class="table">
                            <tr>
                                <td>
                                    <label for="f-name">Food Name</label>
                                </td>
                                <td>
                                    <input type="text" name="f_name" id="f-name" class="form-control" value="<?php echo $food['food_name']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="f-desc">Food Description</label>
                                </td>
                                <td>
                                    <textarea type="text" name="f_desc" id="f-desc" class="form-control"><?php echo $food['food_desc']; ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="f-cat">Food Categories</label>
                                </td>
                                <td>
                                    <input type="text" name="f_cat" id="f-cat" class="form-control" value="<?php echo $food['food_category']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="f-price">Food Price</label>
                                </td>
                                <td>
                                    <input type="text" name="f_price" id="f-price" class="form-control" value="<?php echo $food['food_price']; ?>">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><img src="<?php echo $food['food_image']; ?>" alt="" width=150 height=100></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="f-image">Food Image</label>
                                </td>
                                <td>
                                    <input type="file" name="f_image" id="f-image" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="hidden" name="f_id" id="f-id" class="form-control" value="<?php echo $food['food_id']; ?>">
                                </td>
                                <td>
                                    <input type="submit" name="update_food" id="update_food" class="btn btn-primary" value="Update Food Details">
                                    <input type="reset" name="reset_form" id="reset-form" class="btn btn-primary" value="Clear">
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </body>

    </html>
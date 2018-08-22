<?php
session_start();
include_once "./includes/functions.php";
include_once "./includes/dbconnection.php";
isLoggedIn();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once "./includes/bootstrap.php"; ?>
    <link rel="stylesheet" href="./css/admin_home.css">
    <link rel="stylesheet" href="./css/common.css">
    <title>View Old Complains</title>
    <style>
    #view-food{
        background: #000000;
    }
    .content{
        padding-left: 1%;
        padding-right: 1%;
        padding-top: 1%;
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
            <?php include "./includes/manage-complains-topbar.php"; ?>
            
            <center><h2>View Old Complains</h2></center>
            
            <?php
                $sql = "SELECT id, user_id, u_name, complain_name, complain_text, complain_date, status, response FROM complain, user WHERE user.u_id=complain.user_id AND status!=0 AND train_no='{$_SESSION['utrain']}' ORDER BY complain_date DESC";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    ?>
                    <table class="table">
                        <tr>
                        <td>Complain ID</td>
                        <td>User Id</td>
                        <td>User Name</td>
                        <td>Complain Name</td>
                        <td>Compain Desc</td>
                        <td>Coomplain Date</td>
                        <td>Status</td>
                        <td>Response</td>
                        <td>Action</td>
                        </tr>
                    <?php
                    while($row = $result->fetch_assoc()){
            ?>
                    <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['u_name']; ?></td>
                    <td><?php echo $row['complain_name']; ?></td>
                    <td><?php echo substr($row['complain_text'], 0, 15); ?></td>
                    <td><?php echo $row['complain_date']; ?></td>
                    <td>
                    <?php
                    if($row['status'] == 1){
                        ?>
                        Action Taken
                        <?php
                    } else if($row['status'] == 1){
                        ?>
                        Rejected
                        <?php
                    }
                    ?>
                    </td>
                    <td><?php echo substr($row['response'], 0, 15); ?></td>
                    <td>
                    <a href="./update-food.php?update=<?php echo $row['id']; ?>"><i style="color:green;" class="fa fa-edit"></i></a> &nbsp;
                    <a href="./view-food.php?delete=<?php echo $row['id']; ?>"><i style="color:red;" class="fa fa-close"></i></a>
                    </td>
                    </tr>
            <?php
                }
            ?>
            </table>
            <?php
                } else {
            ?>
            <div class="alert alert-danger">
                        <strong>Not Found!</strong> No information found.
                        </div>
            <?php
                }
            ?>
            </div>
            </div>
        </div>
    </div>
</body>
</html>
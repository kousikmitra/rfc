<?php
session_start();
$_SESSION['err_msg'] = "";

if(isset($_POST['login'])){
    include_once "./includes/dbconnection.php";

    
    $userid = $_POST['userid'];
    $upass = $_POST['password'];

    $sql = "SELECT u_id, train_no, name FROM admin WHERE u_id='$userid' AND password='$upass'";

    $result = $conn->query($sql);

    if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $_SESSION['uid'] = $row['u_id'];
        $_SESSION['utrain'] = $row['train_no'];
        $_SESSION['uname'] = $row['name'];
        header('location:./admin_home.php');
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
    <?php include_once "./includes/bootstrap.php"; ?>
    <title>Admin Login</title>
</head>

<body>
    <div class="main">
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
                                <label for="userid">User ID :</label>
                                <input type="userid" name="userid" id="userid" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <input type="submit" value="login" name="login" id="login" class="btn btn-primary">
                            <br>
                            <br>
                            <a href="#">forgot password?</a>
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>
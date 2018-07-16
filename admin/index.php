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
                            <a href="#">forgot password?</a>
                </fieldset>
            </form>
        </div>
    </div>
</body>

</html>
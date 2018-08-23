<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

function isLoggedIn()
{
    if(isset($_SESSION['uid'])){
        if($_SESSION['uid'] != ""){
            return true;
        }
    }

    header('location:./index.php');
}

function randomNumber($length) {
    $result = '';

    for($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}

function sendResetMail($email, $otp) {
    $mail = new PHPMailer();

    // ---------- adjust these lines ---------------------------------------
    $mail->Username = "arumoy04@gmail.com"; // your GMail user name
    $mail->Password = "library@123"; 
    $mail->AddAddress($email); // recipients email
    $mail->FromName = "Railway Food Service"; // readable name

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Reset Your Password';
    $mail->Body    = "
                        <p><b>Password Reset OTP is</b></p>
                        <p>$otp</p>
                        ";
    $mail->AltBody = "Reset OTP is $otp";
    //-----------------------------------------------------------------------
                               // Enable verbose debug output
    $mail->isSMTP();
    $mail->Host = "ssl://smtp.gmail.com"; // GMail
    $mail->Port = 465;
    $mail->IsSMTP(); // use SMTP
    $mail->SMTPAuth = true; // turn on SMTP authentication
    // $mail->SMTPSecure = 'tls';  
    $mail->From = $mail->Username;
    if(!$mail->Send())
        echo "Mailer Error: " . $mail->ErrorInfo;
    else
        echo "Message has been sent";
}

?>
<?php

function isLoggedIn()
{
    if(isset($_SESSION['uid'])){
        if($_SESSION['uid'] != ""){
            return true;
        }
    }

    header('location:./index.php');
}

?>
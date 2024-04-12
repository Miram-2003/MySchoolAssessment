<?php
session_start();
function  isLogin(){
    if (isset($_SESSION["user_id"])){
        return true;
    }else{
        header("Location:../login/login.php");

    }
};

?>
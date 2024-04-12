<?php
session_start();
function  isLogin(){
    if (!isset($_SESSION["user_id"])){
        header("Location:../login/login.php");
        exit();
    }else{
        return $_SESSION["user_id"] && $_SESSION["name"];
    }}

?>
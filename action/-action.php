<?php
include_once "../settings/connection.php";


session_start();
$fname = $lname = $contact = $email = $password = $comfirmPassword = $nerror = $eerror = $paserror = $cerror = "";

if (isset ($_POST["register"])) {
    if (empty ($_POST["fname"])) {
        header("Location:../login/register.php? nerror=Name is required");
        exit();

    } else {
        $fname = mysqli_real_escape_string($con, $_POST["fname"]);
        if (!preg_match("/^[a-zA-Z]*$/", $fname)) {
            header("Location:../login/register.php? nerror=please provide a valid name");
            exit();

        } else {
            $fname = "$fname";

        }
    }


    if (empty ($_POST["lname"])) {
        header("Location:../login/register.php");
        exit();


    } else {
        $fname = mysqli_real_escape_string($con, $_POST["lname"]);
        if (!preg_match("/^[a-zA-Z]*$/", $fname)) {
            header("Location:../login/register.php");
            exit();

        } else {
            $lname = "$lname";

        }
    }


    if (empty ($_POST["contact"])) {
        header("Location:../login/register.php");
        exit();


    } else {
        $contact = mysqli_real_escape_string($con, $_POST["contact"]);
        if (!preg_match("/^[0-9 ()+-]{10,}$/", $contact)) {
            header("Location:../login/register.php");
            exit();

        } else {
            $contact = "$contact";

        }
    }

    if (empty ($_POST["email"])) {
        header("Location:../login/register.php");
        exit();
    } else {
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        if (!preg_match("/^[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}$/i", $email)) {
            header("Location:../login/register.php");
            exit();

        } else {
            $email = "$email";

        }
    }



    if (empty ($_POST["password"])) {
        $_SESSION["paserror"] = "password required";
        header("Location:../login/register.php");
        exit();
    } else {
        $password = mysqli_real_escape_string($con, $_POST["password"]);
        if (!preg_match("/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$/", $password)) {
            header("Location:../login/register.php");
            exit();

        } else {
            $password = "$password";

        }
    }
    if (empty ($_POST["confirmPassword"])) {
        header("Location:../login/register.php");
        exit();
    } else {
        $confirmPassword = mysqli_real_escape_string($con, $_POST["confirmPassword"]);
        if ($confirmPassword !== $password) {

            header("Location:../login/register.php");
            exit();
        } else {
            $comfirmPassword = "$confirmPassword";

        }

    }







}



?>
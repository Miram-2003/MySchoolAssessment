<?php
include "../settings/connection.php";
#start a session
session_start();
$email = $password = "";

#check if the login button is clicked then collect the data
if (!isset ($_POST["login"])) {
    header("Location:../login/login.php");
} else {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);

    #write a select query and execute it
    $login_query = "SELECT * FROM `Teacher` WHERE `teacherEmail` = ?";
    $query = $con->prepare($login_query);
    if ($query) {
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
        if($result->num_rows){
            $row=$result->fetch_assoc();
            if (!password_verify($password, $row["teacherPwd"])) {
                echo "Incorrect password or username";
                
            } else {
    
                $_SESSION["user_id"] = $row["teacherID"];
                $_SESSION["name"] = $row["teacherName"];
                header("Location:../view/home.php");
            }
           
    }
}}


?>
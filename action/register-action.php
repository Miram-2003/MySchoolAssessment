<?php
include_once "../settings/connection.php";


session_start();
$fname = $lname = $contact = $email = $password = $confirmPassword = $nerror = $eerror = $paserror = $cerror = "";

if (isset ($_POST["register"])) {
    $fname = mysqli_real_escape_string($con, $_POST["fname"]);
    $lname = mysqli_real_escape_string($con, $_POST["lname"]);
    $contact = mysqli_real_escape_string($con, $_POST["contact"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $confirmPassword = mysqli_real_escape_string($con, $_POST["confirmPassword"]);
} else {
    header("Location:../login/register.php");
}

# encrypting the password 
$hash_password = password_hash($password, PASSWORD_DEFAULT);
$name = "$fname "."$lname";


#write an insert query
$teacher_query = "INSERT INTO `teacher`(`teacherID`, `teacherName`, `teacherContact`, `teacherEmail`, `teacherPwd`) 
                VALUES ('','$name','$contact','$email','$hash_password')";

#execute the query
$query_excuted = $con->query($teacher_query);

#check if the query was excuted and redirect to login
if ($query_excuted){
    header("Location:../login/login.php");
}else{
    echo "sorry something went wrong";
}



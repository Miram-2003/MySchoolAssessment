<?php
include_once "../settings/connection.php";
session_start();
$fname = $lname = $contact = $email = $password = $confirmPassword = $nerror = $eerror = $paserror = $cerror = "";


$fname = mysqli_real_escape_string($con, $_POST["fname"]);
$lname = mysqli_real_escape_string($con, $_POST["lname"]);
$contact = mysqli_real_escape_string($con, $_POST["contact"]);
$email = mysqli_real_escape_string($con, $_POST["email"]);
$password = mysqli_real_escape_string($con, $_POST["password"]);
$confirmPassword = mysqli_real_escape_string($con, $_POST["confirmPassword"]);
# encrypting the password 
$hash_password = password_hash($password, PASSWORD_DEFAULT);
$name = "$fname " . "$lname";

# write an insert query
$teacher_query = "INSERT INTO `Teacher`(`teacherName`, `teacherContact`, `teacherEmail`, `teacherPwd`) 
                    VALUES ( '$name', '$contact', '$email', '$hash_password')";

# execute the query
$query_excuted = $con->query($teacher_query);

# check if the query was executed successfully
if ($query_excuted) {
    // If registration is successful, send success response
    echo json_encode(['success' => true, 'message' => 'Registration successful!']);
} else {
    // If registration fails, send error response
    echo json_encode(['success' => false, 'message' => 'Registration failed! Please try again.']);
}

?>
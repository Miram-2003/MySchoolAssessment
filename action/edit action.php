<?php
include "../settings/connection.php";
include "../functions/students.php";

    $studentID = $_POST["studentID"];
    $newName =$_POST["StudentName"];
    $result = change_student($studentID, $newName);
    if($result){
        echo json_encode(['success' => true, 'message' => 'Student name changes successfully']);
    }else{
        echo "Sorry something went wrong";
    }
    





    // $studentID = $_POST["studentID"];
    // $newclass =$_POST["student_class"];

    // $result = change_student_class($studentID, $newclass);
    // if($result){
    //     header("Location:../view/class_view.php");
    // }else{
    //     echo "Sorry something went wrong";
    // }





?>
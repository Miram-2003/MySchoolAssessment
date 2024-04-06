<?php
include "../settings/connection.php";

function get_all_student_class($number){
    global $con;

    $student_query="SELECT * FROM `Student` WHERE `classID` = ?";
    $student_query = $con->prepare($student_query);
    $student_query->bind_param("i", $number);
    $student_query->execute();
    $result = $student_query->get_result(); 
    return $result;
}


function get_a_student($number){
    global $con;

    $student_query="SELECT * FROM `Student` WHERE `studentID` = ?";
    $student_query = $con->prepare($student_query);
    $student_query->bind_param("i", $number);
    $student_query->execute();
    $result = $student_query->get_result(); 
    return $result;
}

function get_change_class($number){
    global $con;

    $student_query="SELECT * FROM `Student` WHERE `studentID` = ?";
    $student_query = $con->prepare($student_query);
    $student_query->bind_param("i", $number);
    $student_query->execute();
    $result = $student_query->get_result(); 
    if($result){
        $row=$result->fetch_assoc();
        $classid = $row['classID'];
       $class= get_a_classname($classid);
       return $class;

    }}



function change_student($number, $name){
    global $con;

    $student_query="UPDATE `student` SET `StudentName`=? WHERE `studentID`= ?";
    $student_query = $con->prepare($student_query);
    $student_query->bind_param("si", $name, $number);
    $result =$student_query->execute();
    return $result;
}


function change_student_class($number, $name){
    global $con;

    $student_query="UPDATE `Student` SET `classID`=? WHERE `studentID`= ?";
    $student_query = $con->prepare($student_query);
    $student_query->bind_param("ii", $name, $number);
    $result =$student_query->execute();
    return $result;
}





    
?>
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

    $student_query="UPDATE `student` SET `classID`=? WHERE `studentID`= ?";
    $student_query = $con->prepare($student_query);
    $student_query->bind_param("ii", $name, $number);
    $result =$student_query->execute();
    return $result;
}




function get_all_subject($con){
    $class_query = "SELECT * FROM `subjects`";
    $class_execute = $con->query($class_query);
    if ($class_execute) {
        $result = $class_execute->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}
 


function get_a_subjectname($number){
    global $con;

    $subject_query="SELECT `subjectName` FROM `subjects` WHERE `subjectID` = ?";
    $subject_query = $con->prepare($subject_query);
    $subject_query->bind_param("i", $number);
    $subject_query->execute();
    $result = $subject_query->get_result(); 
    if($result){
        $row=$result->fetch_assoc();
        $classname = $row['subjectName'];
       return $classname;
    }

}
?>
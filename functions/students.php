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
    $subject_query = "SELECT * FROM `subjects`";
    $subject_execute = $con->query($subject_query);
    if ($subject_execute) {
        $result = $subject_execute->fetch_all(MYSQLI_ASSOC);
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
        $subjectname = $row['subjectName'];
       return $subjectname;
    }

}




function get_all_assessment($con){
    $assess_query = "SELECT * FROM `assessment`";
    $assess_execute = $con->query($assess_query);
    if ($assess_execute) {
        $result = $assess_execute->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}


function get_an_assessmentname($number){
    global $con;

    $assess_query="SELECT `assessmentName` FROM `assessment` WHERE `assessmentID` = ?";
    $assess_query = $con->prepare($assess_query);
    $assess_query->bind_param("i", $number);
    $assess_query->execute();
    $result = $assess_query->get_result(); 
    if($result){
        $row=$result->fetch_assoc();
        $assessname = $row['assessmentName'];
       return $assessname;
    }

}

function get_an_studendentname($number){
    global $con;

    $student_query="SELECT `studentName` FROM `student` WHERE `studentID` = ?";
    $student_query = $con->prepare($student_query);
    $student_query->bind_param("i", $number);
    $student_query->execute();
    $result = $student_query->get_result(); 
    if($result){
        $row=$result->fetch_assoc();
        $studentname = $row['studentName'];
       return $studentname;
    }

}


?>
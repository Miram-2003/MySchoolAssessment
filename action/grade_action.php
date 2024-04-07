<?php
include "../settings/connection.php";

session_start();


if (!isset($_POST["grade"])) {
    header("Location:../view/assign grade.php");
} else {

    $term = $_SESSION["term"];
    $class = $_SESSION["class"];
    $subject = $_SESSION["subject"];
    $assessment = $_SESSION["assessment"];
    

    $students = $_POST["student"];
    $grades = $_POST["marks"];

    // Initialize an empty associative array to store student grades

    $studentGrades = array();


    foreach ($students as $index => $studentName) {

        if (isset($grades[$index])) {

            $grade = $grades[$index];

            $studentGrades[$studentName] = $grade;
        }
    }
  
    foreach($studentGrades as $studentName => $grade){
        $grade_query = "INSERT INTO `assessment`(`assessmentID`, `studentID`, `subjectID`, `termID`, `score`, `teacherID`)
         VALUES ('',$studentName, 1, $term, $grade,1)";
        $grade_exe = $con->query($grade_query);
        if($grade_exe){
            header("Location:../view/assign grade.php");
        }else{
            echo "sorry something when wrong";
        }
    }
    
}
?>
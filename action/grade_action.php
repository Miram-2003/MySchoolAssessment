<?php
include "../settings/connection.php";

session_start();

$term = $_SESSION["term"];
$class = $_SESSION["class"];
$subject = $_SESSION["subject"];
$assessment = $_SESSION["assessment"];
$user = $_SESSION["user_id"];

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

foreach ($studentGrades as $studentName => $grade) {
    $grade_query = "INSERT INTO `assessment`(`assessmentName`, `studentID`, `subjectID`, `termID`, `score`, `teacherID`) 
    VALUES ('$assessment', '$studentName', '$subject', '$term', '$grade', '$user')";
    $grade_exe = $con->query($grade_query);
}
if ($grade_exe) {
    echo json_encode(['success' => true, 'message' => 'Grades recorded successful!']);
} else {
    echo json_encode(['success' => false, 'message' => 'sorry something went wrong']);
}



?>
<?php
include "../settings/connection.php";
include "../functions/students.php";

$action = $newName= $studentID= $newclass="";
if ($_POST["action"]==='editname') {
   
   
        $studentID = $_POST["studentID"];
        $newName = $_POST["StudentName"];
        $result = change_student($studentID, $newName);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Student name changes successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'sorry, could not change student name']);
        }

    } elseif($_POST["action"]==='editclass'){
        $studentID = $_POST["studentID"];
        $newclass = $_POST["student_class"];

        $result = change_student_class($studentID, $newclass);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Class name changes successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'sorry, could not change class']);
        }
    }




?>
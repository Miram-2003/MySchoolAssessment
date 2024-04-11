<?php
include "../settings/connection.php";
include "../functions/student_index.php";

$gradid = $newscore="";
if (isset($_POST["gradeID"])) {

   $gradid =$_POST["gradeID"];
   $newscore = $_POST["score"];
        $result = change_grade($gradid, $newscore);
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Student grade changed successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'sorry, could not change student grade']);
        }

    } 
?>
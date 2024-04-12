<?php
include "../settings/connection.php";
$gradeid="";
if(isset($_GET["id"])){
    $studentid = $_GET["id"];
    $query ="DELETE FROM `Grade` WHERE `gradeID` = ?";
    $delete =$con->prepare($query);
    $delete->bind_param("i", $gradeid);
    $result=$delete->execute();
    if ($result){
        echo json_encode(['success' => true, 'message' => "Student's score removed successful"]);
    }else{
        echo json_encode(['success' => false, "message' => 'Sorry, could not remove student's score"]);
    }
}

?>
<?php
include "../settings/connection.php";
$studentid="";
if(isset($_GET["id"])){
    $studentid = $_GET["id"];
    $query ="DELETE FROM `Student` WHERE `studentID` = ?";
    $delete =$con->prepare($query);
    $delete->bind_param("i", $studentid);
    $result=$delete->execute();
    if ($result){
        echo json_encode(['success' => true, 'message' => 'Student removed successful']);
    }else{
        echo json_encode(['success' => false, 'message' => 'Sorry, could not remove student']);
    }
}

?>


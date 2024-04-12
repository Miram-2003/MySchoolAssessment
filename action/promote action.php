<?php
include "../functions/class.php";
include "../settings/connection.php";
if ($_GET["id"]){
    $studentid =($_GET["id"]);
    $sql = "SELECT `classID` FROM `student` WHERE `studentID`='$studentid'";
    $sql_exe=$con->query($sql);
    if($sql_exe){
        $result = $sql_exe->fetch_assoc();
        $class = $result["classID"];
        $class = $class+1;
        $classname = get_a_classname($class);
        $change="UPDATE `student` SET `classID`='$class' WHERE `studentID`= $studentid";
        $change_exe =$con->query($change);
        if($change_exe){
            echo json_encode(['success' => true, 'message' => 'Student Promoted successful to class' .$class]);
        }else{
            echo json_encode(['success' => false, 'message' => 'Sorry, could not promot student to class'.$class]);
        }
        }
}


?>
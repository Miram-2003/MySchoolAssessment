<?php
include "../settings/connection.php";
include "../functions/students.php";

if (!isset ($_POST["nameSubmit"]) && !isset ($_POST["classSubmit"])) {
    header("Location:../view/edit_Name_view.php");

}elseif(isset ($_POST["nameSubmit"])){
    $studentID = $_POST["studentID"];
    $newName =$_POST["StudentName"];
    $result = change_student($studentID, $newName);
    if($result){
        header("Location:../view/class_view.php");
    }else{
        echo "Sorry something went wrong";
    }
    
}else{
    $studentID = $_POST["studentID"];
    $newclass =$_POST["student_class"];

    $result = change_student_class($studentID, $newclass);
    if($result){
        header("Location:../view/class_view.php");
    }else{
        echo "Sorry something went wrong";
    }

}



?>
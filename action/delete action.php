<?php
include "../settings/connection.php";

if(!isset($_GET["id"])){
    header("Location:../view/class_view.php");
}else{
    $classid = $_GET["id"];
    $query ="DELETE FROM `student` WHERE `studentID` = ?";
    $delete =$con->prepare($query);
    $delete->bind_param("i", $classid);
    $result=$delete->execute();
    if ($result){
        header("Location:../view/class_view.php");
    }else{
        echo "sorry something went wrong";
    }
}

?>


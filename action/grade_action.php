<?php
include "../settings/connection.php";
if (!isset($_POST["grade"])){
    header("Location:../view/assign grade.php");
    exit();
}else{
    $students = $_POST["student"];
    $grades = $_POST["marks"];
    var_dump($students);
    var_dump($grades);
}
?>
<?php
include "../settings/connection.php";
$act = $name = "";
if(isset($_POST["action"])){
    $act = $_POST['action'];
    $name =$_POST['name'];
    if($act=='Class Name'){
        $class= "INSERT INTO `Class`( `className`) VALUES ('$name')";
        $class_exe= $con->query($class);
        if($class_exe){
            echo json_encode(['success' => true, 'message' => 'added successfully!']);
        }else{
            echo json_encode(['success' => false, 'message' =>  'Class could not be added!']);
        }
    }elseif($act=='Subject Name'){
        $subject  = "INSERT INTO `Subjects`(`subjectName`) VALUES ('$name')";
        $subject_exe= $con->query($subject);
        if($subject_exe){
            echo json_encode(['success' => true, 'message' =>'Subject added successfully!']);
        }else{
            echo json_encode(['success' => false, 'message' =>  'Suject could not be added!']);
        } 
        

    }else{
        $assess= "INSERT INTO `Assessment`(`assessmentName`) VALUES ('$name')";
        $asess_exe =$con->query($assess);
        if($asess_exe){
            echo json_encode(['success' => true, 'message' =>  ' Assessment name added successfully!']);
        }else{
            echo json_encode(['success' => false, 'message' =>  'Assessment name could not be added!']);
        } 
    }
   
}else{
    exit();
}
?>
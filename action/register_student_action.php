<?php
include_once "../settings/connection.php";
include_once "../functions/class.php";
include_once "../functions/student_index.php";
session_start();



$stage = $_POST["stage"]; 
$classid = get_class_id($stage);

$studentNames = array_filter($_POST['input']);

if (empty($studentNames)) {
    echo json_encode(['success' => false, 'message' => 'input fills can not be empty']);

} else {

    foreach ($studentNames as $student) {
        $index = generate_index();
        $query = "INSERT INTO `Student`( `studentIndex`, `studentName`, `classID`)
         VALUES (?,?,?)";

        $query_excuted = $con->prepare($query);
        $query_excuted->bind_param("isi", $index, $student, $classid);
        $query_excuted->execute();

    }
        if ($query_excuted) {
            echo json_encode(['success' => true, 'message' => 'Student registered successful!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'sorry! unable to register students!']);
        }

    }



?>
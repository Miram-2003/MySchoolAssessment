<?php
include_once "../settings/connection.php";
include_once "../functions/class.php";
include_once "../functions/student_index.php";
session_start();

$studentNames = $stage = "";

if (!isset ($_POST["registerStudent"]) && !isset ($_POST["registerPreview"])) {
    header("Location:../view/register student view.php");
    exit();

} elseif (isset ($_POST["registerStudent"])) {
    $classname = $_POST["stage"];
    $classid = get_class_id($classname);
    


    $studentNames = array_filter($_POST["input"]);
    if (empty ($studentNames)) {
        header("Location:../view/register student view.php");
        exit();

    } else {

        foreach ($studentNames as $student) {
            $index = generate_index();
            $query = "INSERT INTO `student`( `studentIndex`, `studentName`, `classID`)
         VALUES (?,?,?)";

            $query_excuted = $con->prepare($query);
            $query_excuted->bind_param("isi", $index, $student, $classid);
            $query_excuted->execute();
            if ($query_excuted) {
                header("Location:../view/class_view.php");
            } else {
                echo "sorry something went wrong";
            }

        }
    }

} else {

    $classname = $_POST["stage"];
    $$classid= get_class_id($stage);

    $_SESSION["classid"] = $classid;
    $_SESSION["classname"] = $classname;
    $_SESSION["student"] = array_filter($_POST["input"]);
   header("Location:../view/preview.php");

}
?>
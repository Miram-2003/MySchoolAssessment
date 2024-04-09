<?php
session_start();

include "../functions/class.php";
include "../settings/connection.php";
include "../functions/students.php";

$term = $_POST["termname"];
$class = $_POST["classname"];
$subject = $_POST["subject"];
$assessment = $_POST["assessment"];
$classname = get_a_classname($class);
$termname = get_a_termname($term);
$subjectname = get_a_subjectname($subject);

$query = "SELECT * FROM `student` WHERE `classID` = ?";
$query_prepare = $con->prepare($query);
$query_prepare->bind_param("i", $class);
$query_prepare->execute();
$query_excuted = $query_prepare->get_result();
if ($query_excuted->num_rows > 0) {
    $data = $query_excuted->fetch_all(MYSQLI_ASSOC);

    $stu_form = "<form action='../action/grade_action.php' method ='post' id='gradeForm'>";
    $stu_form .= "<div class='container'>";
    $stu_form .= "<div class='row'>";
    $stu_form .= "<div class='col'>";
    $stu_form .= "<table class='table table-primary table-striped-columns table-borderless'>";
    $stu_form .= "<tr><th>Class:</th><th>" . $classname . "</th></tr>";
    $stu_form .= "<tr><th>Term:</th><th>" . $termname . "</th></tr>";
    $stu_form .= "<tr><th>Subject:</th><th>" . $subjectname . "</th></tr>";
    $stu_form .= "<tr><th>Assessment Name:</th><th>" . $assessment . "</th></tr>";
    $stu_form .= "</table>";
    $stu_form .= "</div></div>";

    $stu_form .= "<div class='row'>";
    $stu_form .= "<div class='col'>";
    $stu_form .= "<table class='table table-light table-borderless'>";
    $stu_form .= "<tr><th>Student Name</th><th>Score/Marks</th></th>";
    foreach ($data as $row) {
        $stu_form .= "<tr>";
        $stu_form .= "<td><input type='hidden' name='student[]' value='" . $row["studentID"] . "'>" . $row["studentName"] . "</td>";
        $stu_form .= "<td><input type='text' class='form-control' name='marks[]'></td>";
        $stu_form .= "</tr>";
    }
    $stu_form .= "</table>";
    $stu_form .= "</div></div>";

    $stu_form .= "<button type='submit' class='register btn btn-info' name='grade'>Submit grades</button>";
    $stu_form .= "</form>";
    echo $stu_form;
} else {
    $stu_form = "<div class='container'>";
    $stu_form .= "<div class='row'>";
    $stu_form .= "<div class='col'>";
    $stu_form .= "<table class='table table-primary table-striped-columns table-borderless'>";
    $stu_form .= "<tr><th>Class:</th><th>" . $classname . "</th></tr>";
    $stu_form .= "<tr><th>Term:</th><th>" . $termname . "</th></tr>";
    $stu_form .= "<tr><th>Subject:</th><th>" . $subjectname . "</th></tr>";
    $stu_form .= "<tr><th>Assessment Name:</th><th>" . $assessment . "</th></tr>";
    $stu_form .= "</table>";
    $stu_form .= "</div></div>";

    $stu_form .= "<div class='text-center'>";
    $stu_form .= "<p><span style='color:red; font-size:x-large; font-weight:bold;'>!!!!! No student is registered in this class</p>";
    $stu_form .= "<button><strong><a class='text-decoration-none' href = '../view/register student view.php'>Register Student</a></strong></button>";
    $stu_form .= "</div>";
    echo $stu_form;
}

$_SESSION["term"]=$term;
$_SESSION["class"]=$class;
$_SESSION["subject"]=$subject;
$_SESSION["assessment"]=$assessment;

?>
<?php
// Function to generate a unique index number
function generate_index()
{
    // Generate a random number within a specific range
    return rand(1000, 9999);
}

include "../settings/connection.php";
include "../functions/students.php";

function grade($classid, $assessmentid, $termid, $subjectid, $year)
{
    global $con;

    $students = get_all_student_class($classid);
    $grades = []; // Initialize an empty array to store grades

    if ($students->num_rows === 0) {
        return "there is no student in the class";
    } else {
        $result = $students->fetch_all(MYSQLI_ASSOC);
        foreach ($result as $row) {
            $student = $row["studentID"];
            $grade = "SELECT * FROM `grade` WHERE `assessmentID` = ? AND `termID` =? AND `subjectID` =? AND `studentID`= ? AND `year` =?";
            $grade_exe = $con->prepare($grade);
            $grade_exe->bind_param("iiiii", $assessmentid, $termid, $subjectid, $student, $year);
            $grade_exe->execute();
            $results = $grade_exe->get_result();
            if ($results->num_rows > 0) {
                $grades[] = $results->fetch_all(MYSQLI_ASSOC);
            }



        }
        return $grades;
    }

}


?>
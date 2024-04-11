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
        return "There is no student registered in this class";
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




function get_grade($id){
    global $con;
    $sql ="SELECT `score` FROM `grade` WHERE `gradeID` = $id";
    $sql_exe = $con->query($sql);
    return $sql_exe;
}


function change_grade($id, $newscore){
    global $con;
    
    $grade_query="UPDATE `grade` SET `score`=? WHERE `gradeID`= ?";
    $grade_query = $con->prepare($grade_query);
    $grade_query->bind_param("ii", $newscore, $id);
    $result =$grade_query->execute();
    return $result;

}




?>
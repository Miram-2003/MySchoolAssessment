<?php
include "../functions/student_index.php";
include "../functions/class.php";
// include "../functions/students.php";

$classid = $termid = $subjectid = $assessmentid = "";

if (isset($_POST["termname"]) && isset($_POST["classname"]) && isset($_POST["subject"]) && isset($_POST["assessment"])) {


    $termid = $_POST["termname"];
    $classid = $_POST["classname"];
    $subjectid = $_POST["subject"];
    $assessmentid = $_POST["assessment"];
    $classname = get_a_classname($classid);
    $termname = get_a_termname($termid);
    $subjectname = get_a_subjectname($subjectid);
    $assessmentname = get_an_assessmentname($assessmentid);
    $academicyear = $_POST["year"];


    if ($assessmentid != 6) {
        $class_assessment = grade($classid, $assessmentid, $termid, $subjectid,$academicyear);
            $stu_form = "<div class='container'>";
            $stu_form .= "<div class='row'>";
            $stu_form .= "<div class='col'>";
            $stu_form .= "<table class='table table-primary table-striped-columns table-borderless'>";
            $stu_form .= "<tr><th>Class:</th><th>" . $classname . "</th></tr>";
            $stu_form .= "<tr><th>Term:</th><th>" . $termname . "</th></tr>";
            $stu_form .= "<tr><th>Subject:</th><th>" . $subjectname . "</th></tr>";
            $stu_form .= "<tr><th>Assessment Name:</th><th>" . $assessmentname . "</th></tr>";
            $stu_form .= "<tr><th>Academic Year:</th><th>" . $academicyear . "</th></tr>";
            $stu_form .= "</table>";
            $stu_form .= "</div></div>";
            if (is_string($class_assessment)) {
                $stu_form.="<div class='text-center'>";
                $stu_form .= "<h5  style='color:red; font-size:x-large; font-weight:bold;'>!!!".$class_assessment."<h5>";
               $stu_form.="<button><strong><a class='text-decoration-none' href = '../view/register student view.php'>Register Student</a></strong></button></div>";
                echo $stu_form;
            }elseif(is_array($class_assessment) && empty($class_assessment)){
                $stu_form.= "<div class='text-center'>";
                $stu_form .= "<h3  style='color:red; font-size:x-large; font-weight:bold;'>No assessment has been done</h3>";
                $stu_form.="<button><strong><a class='text-decoration-none' href = '../view/assign grade.php'>Record grades</a></strong></button></div>";
                echo $stu_form;
            }else{

            $stu_form .= "<div class='row'>";
            $stu_form .= "<div class='col'>";
            $stu_form .= "<table class='table table-light table-bordered'>";
            $stu_form .= "<tr><th>Student Name</th><th>Score/Marks</th> <th>Actions</th></th>";
            foreach ($class_assessment as $student_grades) {

                foreach ($student_grades as $grade) {
                    $student = get_an_studendentname($grade["studentID"]);
                    $stu_form .= "<tr>";
                    $stu_form .= "<td>" . $student . "</td>";
                    $stu_form .= "<td>" . $grade["score"] . "</td>";
                    $stu_form .= "<td>
                    <button class='edit btn btn-info' data-grade-id='" . $grade['studentID'] . "'>Change Score</button>
                    <button class='delete btn btn-danger' data-student-id='" . $grade['studentID'] . "'>Remove Score</button>
                    </td>";
                    $stu_form .= "</tr>";

                }
            }
            $stu_form .= "</table>";
            $stu_form .= "</div></div>";
            echo $stu_form;

        }            
       

    } elseif ($assessmentid == 6) {
       

        $table = "<div class='container'>";
        $table .= "<div class='row'>";
        $table .= "<div class='col'>";
        $table .= "<table class='table table-primary table-striped-columns table-borderless'>";
        $table .= "<tr><th>Class:</th><th>" . $classname . "</th></tr>";
        $table .= "<tr><th>Term:</th><th>" . $termname . "</th></tr>";
        $table .= "<tr><th>Subject:</th><th>" . $subjectname . "</th></tr>";
        $table .= "<tr><th>Assessment Name:</th><th>" . $assessmentname . "</th></tr>";
        $table .= "<tr><th>Academic Year:</th><th>" . $academicyear . "</th></tr>";
        $table .= "</table>";
        $table .= "</div></div><";
        $table .= "<div class='row'>";
        $table .= "<div class='col'>";
        $table .= "<table border='1' class='table table-light table-bordered'>";
       

       


        $sql_assessment_names = "SELECT `assessmentName` FROM `Assessment`";
        $stmt_assessment_names = $con->query($sql_assessment_names);
        $assessment_names = [];
        while ($row = $stmt_assessment_names->fetch_assoc()) {
            $assessment_names[] = $row['assessmentName'];
        }

        // Construct the SQL query dynamically using the assessment names
        $select_statements = [];
        foreach ($assessment_names as $assessment_name) {
            $select_statements[] = "MAX(CASE WHEN Assessment.assessmentName = '$assessment_name' THEN Grade.score ELSE NULL END) AS '$assessment_name'";
        }

        $select_clause = implode(", ", $select_statements);

        $sql = "SELECT `Student.studentName`, $select_clause FROM `Grade`
        INNER JOIN `Student` ON `Grade.studentID` = `Student.studentID`
        INNER JOIN `Assessment` ON `Grade.assessmentID` = `Assessment.assessmentID`
        WHERE `Student.classID` = ? AND `Grade.subjectID` = ? AND `Grade.termID` = ? AND `Grade.year` =?
        GROUP BY `Student.studentID`";

        $stmt = $con->prepare($sql);
        $stmt->bind_param("iiii", $classid, $subjectid, $termid, $academicyear);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows>0) {
           
        $table .= "<tr> <th>Name</th>";
        foreach ($assessment_names as $assessment_name) {
            $table .= "<th>$assessment_name</th>";
        }
       

        while ($row = $result->fetch_assoc()) {
            $table .= "<tr> <td>" . $row['studentName'] . "</td>";
            foreach ($assessment_names as $assessment_name) {
                $table .= "<td>" . $row[$assessment_name] . "</td>";
            }
            $table .= "</tr>";
        }

        $table.= "</table>";
        $table .= "</div></div>";
        echo $table;

    }

    }
}else{
    echo "helloo";
}

?>
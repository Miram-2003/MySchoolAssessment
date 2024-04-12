

<?php
include "../settings/connection.php";
include "../functions/students.php";
include "../functions/class.php";

// Get the selected class, term, and academic year from the user
$classID = $_POST['student_class'];
$termID = $_POST['termname'];
$academicYear = $_POST["year"];
$termname = get_a_termname($termID);
$classname = get_a_classname($classID);

// Retrieve the list of distinct subject IDs from the Grade table
$sql_subjects = "SELECT DISTINCT `subjectID` FROM `Grade` WHERE `termID` = ? AND `year` = ?";
$stmt_subjects = $con->prepare($sql_subjects);
$stmt_subjects->bind_param("ii", $termID, $academicYear);
$stmt_subjects->execute();
$result_subjects = $stmt_subjects->get_result();
$subjectIDs = [];
while ($row_subject = $result_subjects->fetch_assoc()) {
    $subjectIDs[] = $row_subject['subjectID'];
}

// Retrieve the names of subjects corresponding to the subject IDs
$subjects = [];
foreach ($subjectIDs as $subjectID) {
    $sql_subject_name = "SELECT `subjectName` FROM `Subjects` WHERE `subjectID` = ?";
    $stmt_subject_name = $con->prepare($sql_subject_name);
    $stmt_subject_name->bind_param("i", $subjectID);
    $stmt_subject_name->execute();
    $result_subject_name = $stmt_subject_name->get_result();
    if ($result_subject_name->num_rows > 0) {
        $row_subject_name = $result_subject_name->fetch_assoc();
        $subjects[] = $row_subject_name['subjectName'];
    }
}

// Retrieve grades for each student in the selected class
$result_students = get_all_student_class($classID);

while ($row_student = $result_students->fetch_assoc()) {
    $studentID = $row_student['studentID'];
    $studentName = $row_student['studentName'];

    $report = "<div class='head container bg-light' >
    <div class='text-center'>
    <h4><i> FIDELITY JUVENILE BASIC SCHOOL</i></h4>
    <img src=\"../images/logo.png\" alt='school logo'>
    <p> P.O. BOX WY 1658 <br> KWABENYA-ACCRA</p>
    <p> 0542867505/0546761896<br><i>fidelityjuvenileschool@gmail.com </i></p>
    <hr>
    <h5> END OF TERM REPORT</h5>";

    $report .= " <p><b>Name: $studentName</b></p>
    <p><b>Term: $termname</b> </p>
   <p> <b>Class: $classname</b> </p>
   <p> <b> Academic Year: $academicYear</b></p></div>";

    // Display table header
    $report .= "<table class='table table-light table-striped-columns table-bordered'>";
    $report .= "<tr><th>Subject Name</th><th>Class Score</th><th>Exams Score</th><th>Total</th><th>Grade</th><th>Grade Title</th></tr>";

    // Retrieve grades for the student in the selected term and academic year
    foreach ($subjects as $subject) {
        // Retrieve grades for the subject
        $sql_grades = "SELECT * FROM `Grade` WHERE `studentID` = ? AND `subjectID` = ? AND `termID` = ? AND year = ?";
        $stmt_grades = $con->prepare($sql_grades);
        $stmt_grades->bind_param("iiii", $studentID, $subjectID, $termID, $academicYear);
        $stmt_grades->execute();
        $result_grades = $stmt_grades->get_result();

        // Initialize variables for scores and grade calculation
        $classScore = 0;
        $examsScore = 0;

        // Iterate over each grade for the subject
        while ($grade_row = $result_grades->fetch_assoc()) {
            // Calculate class score (excluding exams)
            if ($grade_row['assessmentID'] != 5) { // Assuming assessmentID = 5 represents exams
                $classScore += $grade_row['score'];
            } else {
                // Calculate exams score (assumed to be 50% of the exams score category)
                $examsScore += $grade_row['score'] * 0.5;
            }
        }

        // Convert class score to a scale of 50
        $classScore = number_format(($classScore / 60) * 50, 2);

        // Calculate total score
        $totalScore = number_format(($classScore + $examsScore),2);

        // Determine grade and grade title
        $grade = '';
        $gradeTitle = '';
        if ($totalScore >= 80) {
            $grade = 'A';
            $gradeTitle = 'Excellent';
        } elseif ($totalScore >= 70) {
            $grade = 'B';
            $gradeTitle = 'Very Good';
        } elseif ($totalScore >= 60) {
            $grade = 'C';
            $gradeTitle = 'Good';
        } elseif ($totalScore >= 50) {
            $grade = 'D';
            $gradeTitle = 'Satisfactory';
        } elseif ($totalScore >= 40) {
            $grade = 'E';
            $gradeTitle = 'Pass';
        } else {
            $grade = 'F';
            $gradeTitle = 'Fail';
        }

        // Display grade information in the table row
        $report .= "<tr>";
        $report .= "<td>$subject</td>";
        $report .= "<td>$classScore</td>";
        $report .= "<td>$examsScore</td>";
        $report .= "<td>$totalScore</td>";
        $report .= "<td>$grade</td>";
        $report .= "<td>$gradeTitle</td>";
        $report .= "</tr>";
    }

    // Close the table
    $report .= "</table> <br><br>";
    $report .= "<button data-student-id='$studentID' data-student-name='$studentName' class='register promoted btn btn-info' >Promoted</button>";
    $report .= "<button class='register print btn btn-danger'onclick='printReport(this)'>Print Report</button>";
    $report .= "</div><br><br><br><br>";
    echo $report;
}






?>

<script>

function printReport(button) {

    var reportContainer = $(button).closest('.container').clone();   
    reportContainer.find(".register").remove();
    reportContainer.find('table').css('border-collapse', 'collapse').find('td, th').css('border', '1px solid #ddd');
    reportContainer.find(".register").remove();

        reportContainer.find('div').css({
            'width': '100%',
            'margin': '0',
            'padding': '10px',
            // 'border': '1px solid #ccc',
            'display': 'flex',
            'flex-direction': 'column',
            'align-items': 'center',
            'text-align': 'center'
        });

        reportContainer.find('.school-info').css({
            'margin-right': '20px'
        });

        reportContainer.find('img').css({
            'max-width': '80%',
            'height': 'auto'
           


        });

        reportContainer.find('.table').css({
            'width': '95%',
            'border-collapse': 'collapse',
            'margin': '20px'
            
        });

        reportContainer.find('p').css({
            'margin':'0px',
            
        });

        reportContainer.find('.table th, .table td').css({
            'border': '1px solid #ddd',
            'padding': '8px',
            'text-align': 'left'
        });
    
    // Open a new window and write the contents of the container
    var printWindow = window.open('', '_blank');
    printWindow.document.open();
    printWindow.document.write(reportContainer.html());
    printWindow.document.close();
    // Print the contents of the new window
    printWindow.print();
}







</script>




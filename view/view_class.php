<?php
include "../functions/students.php";
include "../functions/class.php";


$class = $_POST["student_class"];

$result = get_all_student_class($class);

$class_name = get_a_classname($class);
if ($result->num_rows === 0) {
  echo "<div class='text-center'>";
  echo "<h3 style='color:black;'>Class:" . $class_name . "</h3>";
  echo "<p><span style='color:red; font-size:x-large; font-weight:bold;'>!!!!! No student is registered in this class</p>";
  echo "<button><strong><a class='text-decoration-none' href = '../view/register student view.php'>Register Student</a></strong></button>";
  echo "</div>";
} else {
  $students = $result->fetch_all(MYSQLI_ASSOC);
  $table = "<h3 class='text-center' style='color:black;'>Class:" . $class_name . "</h3>";

  $table .= "<table class='table table-light table-borderless '>";
  $table .= "<thead class='table-info text-center '>";
  $table .= "<tr>";
  $table .= "<th scope='col'>Student Index Number</th>";
  $table .= "<th scope='col'>Student Name</th>";
  $table .= "<th>Action</th>";
  $table .= "</tr>";
  $table .= "</thead>";
  $table .= "<tbody class='text-center'>";
  foreach ($students as $row) {
    $table .= "<tr>";
    $table .= "<td >" . $row["studentIndex"] . "</td>";
    $table .= "<td >" . $row["studentName"] . "</td>";
    $table .= "<td>
    <button class='edit btn btn-info' data-student-id='". $row['studentID'] ."' data-action-name='editName'>Change Name</button>
    <button class='edit btn btn-secondary' data-student-id='". $row['studentID'] ."' data-action-name='editclass'>Change Class</button>
    <button class='delete btn btn-danger' data-student-id='". $row['studentID'] ."'>Remove Student</button>
    
        
    </td>";
    $table .= "</tr>";
  }
  $table .= "</tbody>";
  $table .= "</table>";
  echo $table;

}

?>
<?php
include "../functions/class.php";

include "../settings/connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method ='post'>
        <lable for="classname">Class Name</lable>
        <select name="classname" id="student_class">
            <option> </option>
            <?php
            $result = get_all_class($con);
            foreach ($result as $row) {
              echo "<option value=" . $row['classID'] . ">" . $row["className"] . "</option>";
            }
            ?>
        </select>

        <lable for="classname">Term</lable>
        <select name="termname" id="student_class">
            <option> </option>
            <?php
            $result = get_all_term($con);
            foreach ($result as $row) {
              echo "<option value=" . $row['termID'] . ">" . $row["termName"] . "</option>";
            }
            ?>
        </select>

            <lable for="subject">Subject Name</lable>
            <input type="input" name="subject" id="subject">

            <lable for="assessment">Assessment Name</lable>
            <input type="input" name="assessment" id="subject">

            <button type ='submit' name='submitAssessment'>Done</button>
    </form>

<?php
if (!isset($_POST["submitAssessment"])){
    exit();
}else{
    $term = $_POST["termname"];
    $class = $_POST["classname"];
    $subject =$_POST["subject"];
    $assesemnet=$_POST["assessment"];
    $classname= get_a_classname($class);
    $termname= get_a_termname($term);

    $query = "SELECT * FROM `student` WHERE `classID` =?";
    $query_prepare = $con->prepare($query);
    $query_prepare->bind_param("i", $class);
    $query_prepare->execute();
    $query_excuted = $query_prepare->get_result();
    if($query_excuted){
       
        $data = $query_excuted->fetch_all(MYSQLI_ASSOC);
       
        $stu_form = "<form action='../action/grade_action.php' method ='post'>";
        $stu_form.=  "<p>Class: ".$classname."</p>";
        $stu_form.=  "<p>Term: ".$termname."</p>";
        $stu_form.=  "<p>Subject: ".$subject."</p>";
        $stu_form.=  "<p>Assessment Name: ".$assesemnet."</p>";
        foreach($data as $row){
            $stu_form.="<div>";
            $stu_form.= "<input type='hidden' name = 'student[]' value = '".$row["studentName"]."'>";
            $stu_form.= "<label>".$row["studentName"]."    </lable>";
            $stu_form.= "<input type='text' name = 'marks[]'><br><br>";
            $stu_form.="</div>";

        }$stu_form.="<button type='submit' name='grade'>submit</button>";
        $stu_form.="<form>";
        echo $stu_form;
    }

    
}

?>



</body>
</html>


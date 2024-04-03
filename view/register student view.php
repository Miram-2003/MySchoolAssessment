<?php
include_once "../functions/class.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <div id="container">
        <form method="post">
            <label for="student_class">Select a class </label><br>
            <select name="student_class" id="student_class">
                <?php
                $result = get_all_class($con);
                echo "<option></option>";
                foreach ($result as $row) {
                    echo "<option value=" . $row['classID'] . ">" . $row["className"] . "</option>";
                }
                ?>
            </select><br>
            <label for="students"> Number of students to be registered </label><br>
            <input type="text" name="classNumber" id = "student"><br><br>


            <button type="submit" id="submit" name="submit">Done</button>
        </form>
        <div>
</body>

</html>

<?php
$className = $classNumber = "";
if (isset ($_POST["submit"])) {
    $classid = $_POST["student_class"];
    $classNumber = $_POST["classNumber"];



    $result = get_a_classname($classid);
    $classForm = "<form action='../action/register_student_action.php' method='post'>";

    $classForm .= "<input type='hidden' name ='stage' value='" . $result . "'>";
    $classForm .= "<h3>" . $result . "</h3>";
    for ($i = 0; $i < $classNumber; $i++) {
        $classForm .= "<label> Name of student" . ($i+1). "</lable><br>";

        $classForm .= "<input type='text' name='input[]' ><br>";

    }
    $classForm .= "<button type='submit' name='registerStudent'> Register</button><br>";
    $classForm .= "<button type='submit' name='registerPreview'> Preview</button><br>";
    $classForm .="</form>";
    echo $classForm;


}else{



}

?>
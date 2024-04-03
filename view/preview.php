<?php

session_start();

$class = $_SESSION["classname"];
$classid = $_SESSION["classid"];
$studentNames = $_SESSION["student"];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action='../action/register_student_action.php' method='post'>

        <?php

        $classForm = "<h3>Class:" . $class. "</h3>";
        $classForm .= "<input type='hidden' name ='stage' value='" . $class . "'>";

        $index = 0;
        foreach ($studentNames as $name) {
            $index++;
            $classForm .= "<label>" . $index . ".   " . "$name</label>";
            $classForm .= "<input type='hidden' name='input[]' value='$name'><br>";
        }
        echo $classForm;
        ?>

        <button type='submit' name='registerStudent'> Register</button><br>
        <a href="../view/register student view.php"> <button type='submit' name='cancel'> Back</button></a><br>
    </form>

</body>

</html>
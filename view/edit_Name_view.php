<?php
include "../functions/students.php";
include "../functions/class.php";
if (!isset ($_GET["id"]) && !isset ($_GET["name"])) {
    header("Location:../view/class_view.php");
} else {
    $studentid = $_GET["id"];
    $action = $_GET["name"];
    if ($action === "editName") {
        $result = get_a_student($studentid);
        if ($result) {
            $rows = $result->fetch_assoc();
            $form = "<form action='../action/edit action.php' method='post'>";
            $form .= "<div>";
            $form.="<input type='hidden' name='studentID' value='".$studentid."'>";
            $form .= "<label>Student Name<lable><br>";
            $form .= "<input type='text' name='StudentName' value='" . $rows["studentName"] . "'><br>";
            $form .= "<button type='submit' name = 'nameSubmit'>Apply changes</button>";
            $form .= "<button type='submit'>cancel</button>";
            $form .= "</div>";
            $form .= "</form>";
        }
        echo $form;
    } elseif ($action === "editclass") {
        $result = get_all_class($con);
        $currentClass = get_a_classname($studentid);
        if ($result) {
            $forms = "<form action='../action/edit action.php' method='post'>";
            $forms.= "<label>Student Class<lable><br>";
            $forms.= "<div>" . $currentClass . "</div>";
            $forms.="<input type='hidden' name='studentID' value='".$studentid."'>";
            $forms .= "<label for='student_class'>Change To </label><br>";
            $forms .= "<select name='student_class' id='student_class'>";

            foreach ($result as $row) {
                $forms .= "<option value='" . $row['classID'] . "'>" . $row["className"] . "</option>";
            }
            $forms.= "</select><br>";
            $forms.= "<button type='submit' id='submit' name='classSubmit'>Apply Changes</button>";
            $forms.= "<button type='submit'>cancel</button>";
            $forms.= "</form>";
            $forms.= "</div>";
        }echo $forms;
       
    } 
}


?>
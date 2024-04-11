<?php
include "../functions/class.php";

include "../functions/student_index.php";
$gradeid = "";
if (isset($_GET['id'])) {
    $gradeid = $_GET["id"];
        $result = get_grade($gradeid);
        if ($result) {
            $rows = $result->fetch_assoc();
            $forms="<div class='container bg-light'>";
            $forms .= "<form action='../action/edit_grade action.php' method='post' class='editgradeForm'>";
            $forms .= "<div class='form-group'>";
            $forms .= "<input type='hidden' name='gradeID' value='".$gradeid."'><br>";
            $forms .= "<b><label for='StudentName'>Score</label></b>";
            $forms .= "<input type='text' class='form-control' id='score' name='score' value='" . $rows["score"] . "'>";
            $forms .= "<button type='submit' name='nameSubmit' class='register btn btn-primary'>Apply changes</button>";
            $forms .= "<button type='button'onclick='history.back()' class='register btn btn-secondary' >Cancel</button><br>";
            $forms .= "<br><br>";
            $forms .= "</div>";
            $forms .= "</form>";
            $forms.="</div>";
            echo $forms;
            
        }
    }else{
        
        exit();
    }    


?>
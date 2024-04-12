<?php

include "../functions/class.php";
session_start();

      $className = $classNumber = "";
     
        $classid = $_POST["student_class"];
        $classNumber = $_POST["classNumber"];

        $result = get_a_classname($classid);
        $classForm="<div class='container bg-light'>";
        $classForm .= "<form action='../action/register_student_action.php' method='post' id='formsubmit'>";
        $classForm .= "<input type='hidden' name ='stage' value='" . $result . "'>";
        $classForm .= "<h3 class='text-center'><b>Class: " . $result . "</b></h3>";
        for ($i = 0; $i < $classNumber; $i++) {
          $classForm .= "<div class='form-group'>";
          $classForm .= "<label class='form-label' for='studentName" . ($i + 1) . "'>Name of student " . ($i + 1) . "</label>";
          $classForm .= "<input type='text' class='form-control form-control-sm' id='studentName" . ($i + 1) . "' name='input[]'>";
          $classForm .= "</div>";
        }
        
        $classForm .= "<button type='submit' class='register btn btn-info' name='registerStudent'>Register</button>";
       
        $classForm .= "</form><br><br><br>";
        $classForm .= "</div>";
        echo $classForm;
       
      ?> 

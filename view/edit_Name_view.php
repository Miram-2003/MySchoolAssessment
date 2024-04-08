<?php
include "../functions/class.php";
include "../functions/students.php";
$studentid =  $action ="";
if (isset($_GET['id'])) {
    $studentid = $_GET["id"];
    $action = $_GET["name"];
    if ($action === "editName") {
        $result = get_a_student($studentid);
        if ($result) {
            $rows = $result->fetch_assoc();
            $forms = "<form action='../action/edit action.php' method='post' id='#editnameForm'>";
            $forms .= "<div class='form-group'>";
            $forms .= "<input type='hidden' name='studentID' value='".$studentid."'><br>";
            $forms .= "<b><label for='StudentName'>Student Name</label></b>";
            $forms .= "<input type='text' class='form-control' id='StudentName' name='StudentName' value='" . $rows["studentName"] . "'>";
            $forms .= "<button type='submit' name='nameSubmit' class='register btn btn-primary'>Apply changes</button>";
            $forms .= "<button type='button' class='register btn btn-secondary' onclick='history.back()'>Cancel</button><br>";
            $forms .= "<br><br>";
            $forms .= "</div>";
            $forms .= "</form>";
            
        }
      
    } elseif ($action === "editclass") {
        $result = get_all_class($con);
        $current = get_change_class($studentid);
        
        if ($result) {
          $forms = "<form action='../action/edit action.php' method='post'>";
          $forms .= "<div class='form-group'>";
          $forms .= "<b><div class='text-center' style='color:black'>";
          $forms .= "<label for='currentClass'>Current Class</label>";
          $forms .= "<div>" . $current . "</div>";
          $forms .= "<input type='hidden' name='studentID' value='".$studentid."'>";
          $forms .= "<label for='student_class'>Change To</label>";
          $forms .= "</div><b>";
          $forms .= "<select class='form-control' id='student_class' name='student_class'>";
          foreach ($result as $row) {
              $forms .= "<option value='" . $row['classID'] . "'>" . $row["className"] . "</option>";
          }
          $forms .= "</select>";
          $forms .= "<button type='submit' name='classSubmit' class='register btn btn-primary'>Apply Changes</button>";
          $forms .= "<button type='button' class='register btn btn-secondary' onclick='history.back()'>Cancel</button><br>";
          $forms .= "<br><br>";
          $forms .= "</form>";
          
        }
       
    } echo $forms;
  }else{
    echo "not found";
  }



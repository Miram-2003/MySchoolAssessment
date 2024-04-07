<?php
include "../functions/class.php";

include "../settings/connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/cb76afc7c2.js" crossorigin="anonymous"></script>
  <link href="../css/style.css" rel="stylesheet" />
  <title>Document</title>

</head>

<body>
  <div class="main-container d-flex">
    <div class="sidebar" id="side_nav">
      <div class="header-box px-3 pt-2 pb-4 d-flex justify-content-between">
        <img src="../images/logo.png" class="logo fs-4 rounded mx-auto d-block" alt="logo">
    
      </div>
      <hr class="h-color mx-2">
      <ul class="list-unstyled px-2">
        <li class="active"><a href="../view/home.php" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-house" style="color: #74C0FC;"></i> Home</a></li>
        <li class=""><a href="../view/class_view.php" class="text-decoration-none px-3 py-2 d-block"> <i
              class="fa-solid fa-people-group" style="color: #74C0FC;"></i>View Class</a></li>
        <li class=""><a href="../view/register student view.php" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-users" style="color: #74C0FC;"></i> Register Student</a></li>
        <li class=""><a href="../view/assign grade.php" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-file-pen" style="color: #74C0FC;"></i> Record Assessment</a></li>
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"> <i class="fa-solid fa-users-viewfinder"
              style="color: #74C0FC;"></i>View Assessment Record</a></li>
      </ul>

      <hr class="h-color mx-2">
      <ul class="list-unstyled px-2">
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"> <i class="fa-solid fa-house"
              style="color: #74C0FC;"></i>settings</a></li>
      </ul>
    </div>


    <nav class="navbar  fixed-top navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <div class="d-flex justify-content-between">
          <a class="navbar-brand justify-content-between d-md-none d-block" href="#">coding lauge</a>
          <button class="btn px-1 py-0 open-btn"><i class="fa fa-stream" style="color: #74C0FC;"></i></button>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">profile</a>
            </li>
          </ul>

        </div>
      </div>
    </nav>

    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-light second-navbar">

      <form class="container-fluid justify-content-evenly" method="post">
        <div class="container-fluid justify-content-evenly">


          <lable for="classname"><b>Class Name</b></lable>
          <select name="classname" id="student_class" style="width:200px;">
            <option> </option>
            <?php
            $result = get_all_class($con);

            foreach ($result as $row) {
              echo "<option value=" . $row['classID'] . ">" . $row["className"] . "</option>";
            }
            ?>
          </select>


          <lable for="classterm"><b>Term</b></lable>
          <select name="termname" id="student_class">
            <option> </option>
            <?php
            $result = get_all_term($con);
            foreach ($result as $row) {
              echo "<option value=" . $row['termID'] . ">" . $row["termName"] . "</option>";
            }
            ?>
          </select>


          <label for='students'><b> Suject Name</b> </label>
          <input type="input" name="subject" id="subject">

          <lable for="assessment"><b>Assessment Name</b></lable>
          <input type="input" name="assessment" id="subject">


          <button type="submit" name="submitAssessment" class="register btn btn-lg btn-info btn-outlin-dark"
            type="button">Done</button>
      </form>
  </div>

  </nav>




  <div class="content" style='padding-top:50px' ;>
    <div class="container">
      <div class="row justify-content-center">
        <?php
        if (!isset($_POST["submitAssessment"])) {
          exit();
        } else {
          $term = $_POST["termname"];
          $class = $_POST["classname"];
          $subject = $_POST["subject"];
          $assessment = $_POST["assessment"];
          $classname = get_a_classname($class);
          $termname = get_a_termname($term);

          $query = "SELECT * FROM `student` WHERE `classID` = ?";
          $query_prepare = $con->prepare($query);
          $query_prepare->bind_param("i", $class);
          $query_prepare->execute();
          $query_excuted = $query_prepare->get_result();
          if ($query_excuted) {
            $data = $query_excuted->fetch_all(MYSQLI_ASSOC);

            $stu_form = "<form action='../action/grade_action.php' method ='post'>";
            $stu_form .= "<div class='container'>";
            $stu_form .= "<div class='row'>";
            $stu_form .= "<div class='col'>";
            $stu_form .= "<table class='table table-primary table-striped-columns table-borderless'>";
            $stu_form .= "<tr><th>Class:</th><th>" . $classname . "</th></tr>";
            $stu_form .= "<tr><th>Term:</th><th>" . $termname . "</th></tr>";
            $stu_form .= "<tr><th>Subject:</th><th>" . $subject . "</th></tr>";
            $stu_form .= "<tr><th>Assessment Name:</th><th>" . $assessment . "</th></tr>";
            $stu_form .= "</table>";
            $stu_form .= "</div></div>";

            $stu_form .= "<div class='row'>";
            $stu_form .= "<div class='col'>";
            $stu_form .= "<table class='table table-light table-borderless'>";
            $stu_form .= "<tr><th>Student Name</th><th>Score/Marks</th></th>";
            foreach ($data as $row) {
              $stu_form .= "<tr>";
              $stu_form .= "<td><input type='hidden' name='student[]' value='" . $row["studentName"] . "'>" . $row["studentName"] . "</td>";
              $stu_form .= "<td><input type='text' class='form-control' name='marks[]'></td>";
              $stu_form .= "</tr>";
            }
            $stu_form .= "</table>";
            $stu_form .= "</div></div>";

            $stu_form .= "<button type='submit' class='register btn btn-info' name='grade'>Submit grades</button>";
            $stu_form .= "</form>";
            echo $stu_form;
          }
        }

        
        ?>

      </div>
    </div>

    <br><br>
  </div>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>

    $(".sidebar ul li").on('click', function () {
      $(".sidebar ul li.active").removeClass('active');
      $(this).addClass('active');

    })

    $('.open-btn').on('click', function () {
      $('.sidebar').addClass('active');
    })

    $('.close-btn').on('click', function () {
      $('.sidebar').removeClass('active');
    })




    $("#preview").on("click", function () {
      // Display the chore form container as a modal
      $("#previewForm").css("display", "block");
      // Reset the rowIndex in dataset
      $("#previewSubmit").data("rowIndex", "");
      // Clear input field
      // $("#choreName").val(""); // Clear input field
    });

    // Close Form Button Click Event
    $("#stopPreview").on("click", function () {
      // Hide the chore form container
      $("#previewForm").css("display", "none");
    });
  </script>
</body>

</html>
<?php
include "../functions/class.php";
session_start()
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
        <!-- <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">CL</span><span class="text-white">
            coding laugh </span> </h1> -->
      </div>
      <hr class="h-color mx-2">
      <ul class="list-unstyled px-2">
      <li class="active"><a href="../view/home.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-house"
              style="color: #74C0FC;"></i> Home</a></li>
        <li class=""><a href="../view/class_view.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fa-solid fa-people-group"
              style="color: #74C0FC;"></i>View Class</a></li>
        <li class=""><a href="../view/register student view.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-users"
              style="color: #74C0FC;"></i> Register Student</a></li>
        <li class=""><a href="../view/assign grade.php" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-file-pen"
              style="color: #74C0FC;"></i> Record Assessment</a></li>
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
        <h5><b>Select a class </b></h5>

        <select name="student_class" id="student_class" style="width:200px;">
          <option> </option>
          <?php
          $result = get_all_class($con);

          foreach ($result as $row) {
            echo "<option value=" . $row['classID'] . ">" . $row["className"] . "</option>";
          }
          ?>
        </select>
        <label for='students'><b> Number of students to be registered</b> </label>
        <input type='text' name='classNumber' id='student'>


        <button type="submit" name="submit" class="btn btn-lg btn-info btn-outlin-dark" type="button">Done</button>
      </form>

    </nav>




    <div class="content">
      <?php
      $className = $classNumber = "";
      if (isset($_POST["submit"])) {
        $classid = $_POST["student_class"];
        $classNumber = $_POST["classNumber"];

        $result = get_a_classname($classid);
        $classForm = "<form action='../action/register_student_action.php' method='post'>";
        $classForm .= "<input type='hidden' name ='stage' value='" . $result . "'>";
        $classForm .= "<h3 class='text-center'><b>Class: " . $result . "</b></h3>";
        for ($i = 0; $i < $classNumber; $i++) {
          $classForm .= "<div class='form-group'>";
          $classForm .= "<label class='form-label' for='studentName" . ($i + 1) . "'>Name of student " . ($i + 1) . "</label>";
          $classForm .= "<input type='text' class='form-control form-control-sm' id='studentName" . ($i + 1) . "' name='input[]'>";
          $classForm .= "</div>";
        }
        
        $classForm .= "<button type='submit' class='register btn btn-info' name='registerStudent'>Register</button>";
        $classForm .= "<button type='submit' class='register btn btn-secondary' name='registerPreview'>Preview</button>";
        $classForm .= "</form>";
        echo $classForm;
      } elseif(isset($_POST["submit"])){
        
      }
      ?>


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
  </script>
</body>

</html>
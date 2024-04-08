<?php
include "../functions/class.php";

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
        <div class="container-fluid justify-content-evenly">

      
        <h5><b>Class Registeration Preview</b></h5>
        

       
      </div>

    </nav>




    <div class="content">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6" id='previewForm'>
            <?php
            $classForm = "<form action='../action/register_student_action.php' method='post' >";
            $classForm .= "<h3 class='mb-3 text-center'>Class: " . $class . "</h3>";
            $classForm .= "<input type='hidden' name ='stage' value='" . $class . "'>";

            $index = 0;
            foreach ($studentNames as $name) {
                $index++;
                $classForm .= "<div class='mb-3 text-center'>";
                $classForm .= "<label class='fw-bold' style='font-size:x-large;'>" . $index . ". " . "$name</label>";
                $classForm .= "<input type='hidden' name='input[]' value='$name'>";
                $classForm .= "</div>";
                
            }
            $classForm .= "<button type='submit' name='registerStudent' id='previewSubmit' class='register btn btn-info'>Register</button>";
            $classForm .= "<button id='stopPreview' onclick='history.back()' type='submit' class='register btn btn-secondary' name='cancel'> Back</button></a><br>";
            $classForm .= "</form><br><br>";

            echo $classForm;
            ?>
        </div>
    </div>
</div>





    </div>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../js/sidebar.js"></script>
</body>

</html>
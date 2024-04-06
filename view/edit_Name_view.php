<?php
include "../functions/class.php";
include"../functions/students.php";
if (!isset ($_GET["id"]) && !isset ($_GET["name"])) {
    header("Location:../view/class_view.php");
} else {
    $studentid = $_GET["id"];
    $action = $_GET["name"];
    if ($action === "editName") {
        $result = get_a_student($studentid);
        if ($result) {
            $rows = $result->fetch_assoc();
            $forms = "<form action='../action/edit action.php' method='post'>";
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
       
    } 
}


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
        <h5><b>Change student'second class/ name</b></h5>
        
      </div>

    </nav>




    <div class="content">
    <div class="container">
    <div class="row justify-content-center" id='previewForm'>
        
      <?php  echo $forms?>

   


    
    </div>
</div>


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
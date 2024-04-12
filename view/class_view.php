<?php
include "../functions/class.php";
include "../settings/core.php";
isLogin()
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/cb76afc7c2.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <link href="../css/style.css" rel="stylesheet" />
  <title>View a  class</title>


</head>

<body>
  <div class="main-container d-flex">
    <div class="sidebar" id="side_nav">
      <div class="header-box px-3 pt-2 pb-4 d-flex justify-content-between">
        <img src="../images/logo.png" class="logo fs-4 rounded mx-auto d-block" alt="logo">

      </div>
      <hr class="h-color mx-2">

      <ul class="list-unstyled px-2">
       
        <li class=""><a href="../view/class_view.php" class="text-decoration-none px-3 py-2 d-block"> <i
              class="fa-solid fa-people-group" style="color: #74C0FC;"></i><b>View Class</b></a></li>
        <li class=""><a href="../view/register student view.php" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-users" style="color: #74C0FC;"></i><b> Register Student</b></a></li>
        <li class=""><a href="../view/assign grade.php" class="text-decoration-none px-3 py-2 d-block"><i
              class="fa-solid fa-file-pen" style="color: #74C0FC;"></i> <b>Record Assessment</b></a></li>
        <li class=""><a href="../view/view_recorded_grades.php" class="text-decoration-none px-3 py-2 d-block"> <i
              class="fa-solid fa-users-viewfinder" style="color: #74C0FC;"></i><b>View Assessment Record</b></a></li>
        <li class=""><a href="../view/view_student_report.php" class="text-decoration-none px-3 py-2 d-block"> <i
              class="fa-solid fa-users-viewfinder" style="color: #74C0FC;"></i><b>View Student Reports</b></a></li>
      </ul>

      <hr class="h-color mx-2">
      <ul class="list-unstyled px-2">
        <li class=""><a href="../view/view settings.php" class="text-decoration-none px-3 py-2 d-block"> <i class="fa-solid fa-house"
              style="color: #74C0FC;"></i><b>Settings</b></a></li>
      </ul>
    </div>


    <nav class="navbar  fixed-top navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <div style="color: #b40c90; font-size:20px;">
          <b><i> Student Assessement Portal</i></b>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="dropdown">
          <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <b><?php
            echo $_SESSION["name"]
            ?></b>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../login/signout.php">Sign out</a></li>
            
          </ul>
        </div>
      </div>
    </nav>

    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-light second-navbar">

      <form class="container-fluid justify-content-evenly" method="post" id='classform'>
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
        <button type="submit" name="submit" class="btn btn-lg btn-info btn-outlin-dark" type="button">Done</button>
      </form>

    </nav>
    <div class="content">


    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="../js/sidebar.js"></script>
  <script src="../js/class.js"></script>



</body>

</html>
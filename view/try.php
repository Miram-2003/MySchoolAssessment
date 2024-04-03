<?php
include "../functions/class.php";
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
        <li class="active"><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-house"
              style="color: #74C0FC;"></i> Dashboard</a></li>
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"> <i class="fa-solid fa-house"
              style="color: #74C0FC;"></i>Home</a></li>
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-house"
              style="color: #74C0FC;"></i> student</a></li>
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fa-solid fa-house"
              style="color: #74C0FC;"></i> service</a></li>
        <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"> <i class="fa-solid fa-house"
              style="color: #74C0FC;"></i>Dashboard</a></li>
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
        <h6 style="margin-left:-250px" ;>Select a class </h6>

        <select name="student_class" id="student_class" style="width:200px;">
          <option> </option>
          <?php
          $result = get_all_class($con);

          foreach ($result as $row) {
            echo "<option value=" . $row['classID'] . ">" . $row["className"] . "</option>";
          }
          ?>
        </select>
        <button type="submit" name="submit" class="btn btn-sm btn-outline-secondary" type="button">Done</button>
      </form>

    </nav>




    <div class="content">
      <?php
      include "../functions/students.php";

      $class = "";

      if (isset($_POST["submit"])) {
        $class = $_POST["student_class"];
        if ($class === "") {
          echo "please choose a class";
        } else {
          $class_num = $class;
          $result = get_all_student_class($class_num);

          $class_name = get_a_classname($class_num);
          if ($result->num_rows === 0) {
            echo "<h3>Class:" . $class_name . "</h3>";
            echo "No student is register in this class";
            echo "<a href = '../view/register student view.php'>Register Student</a>";
          } else {
            $students = $result->fetch_all(MYSQLI_ASSOC);
            $table = "<h3>Class:" . $class_name . "</h3>";

            $table .= "<table>";
            $table .= "<thead>";
            $table .= "<tr>";
            $table .= "<th>Student Index Number</th>";
            $table .= "<th>Student Name</th>";
            $table .= "<th>Action</th>";
            $table .= "</tr>";
            $table .= "</thead>";
            $table .= "<tbody>";
            foreach ($students as $row) {
              $table .= "<tr>";
              $table .= "<td>" . $row["studentIndex"] . "</td>";
              $table .= "<td>" . $row["studentName"] . "</td>";
              $table .= "<td>
                 <a href=\"../view/edit_Name_view.php?id=" . $row['studentID'] . "&name=editName\"> <button type='submit' name='edit'>change Name</button></a>
                 <a href=\"../view/edit_Name_view.php?id=" . $row['studentID'] . "&name=editclass\"> <button type='submit' name='edit'>change Class</button></a>
                 <a href=\"../action/delete action.php?id=" . $row['studentID'] . "\"> <button type='submit' name='edit'>Remove Student</button></a>
                </td>";
              $table .= "</tr>";
            }
            $table .= "</tbody>";
            $table .= "</thead>";
            echo $table;
          }
        }
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
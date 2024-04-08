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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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

    $(document).ready(function () {
      $('#classform').submit(function (e) {
        e.preventDefault();

        var classname = $('#student_class').val();
        if (classname === '') {
          Swal.fire({
            icon: 'error',
            title: 'Sorry..',
            text: 'please select a class'
          })
          return;
        }

        $.ajax({
          url: '../action/view_class.php',
          type: 'POST',
          data: $(this).serialize(),
          success: function (response) {
            $('.content').html(response);
          }

        })
      })

    })











    $(document).ready(function () {
      // Edit action
      $(document).on('click', '.edit', function (e) {
        e.preventDefault(); // Prevent default link behavior

        var studentID = $(this).data('student-id');
        var actionName = $(this).data('action-name');
        

        // AJAX request for edit action
        $.ajax({
          url: '../view/edit_Name_view.php',
          type: 'GET',
          data: { id: studentID, name: actionName },
          success: function (response) {
            // Update the content div with the response
            $('.content').html(response);
          },
          error: function (xhr, status, error) {
            console.error('Error performing edit action: ' + error);
          }
        });
      });

      // Delete action
      $(document).on('click', '.deleteBtn', function (e) {
        e.preventDefault(); // Prevent default link behavior

        var studentID = $(this).data('student-id');

        // AJAX request for delete action
        $.ajax({
          url: '../action/delete_action.php',
          type: 'GET',
          data: { id: studentID },
          success: function (response) {
            // Optionally handle success response
            // For example, display a success message or reload the student list
            console.log('Student deleted successfully');
          },
          error: function (xhr, status, error) {
            console.error('Error performing delete action: ' + error);
          }
        });
      });
    });


  </script>
</body>

</html>
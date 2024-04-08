<?php
include "../functions/class.php";
include "../functions/students.php"
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/cb76afc7c2.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

      <form class="container-fluid justify-content-evenly" method="post" id="navform">
        <div class="container-fluid justify-content-evenly">


          <lable for="classname"><b>Class Name</b></lable>
          <select name="classname" id="classname" style="width:200px;">
            <option> </option>
            <?php
            $result = get_all_class($con);

            foreach ($result as $row) {
              echo "<option value=" . $row['classID'] . ">" . $row["className"] . "</option>";
            }
            ?>
          </select>


          <lable for="classterm"><b>Term</b></lable>
          <select name="termname" id="termname">
            <option> </option>
            <?php
            $result = get_all_term($con);
            foreach ($result as $row) {
              echo "<option value=" . $row['termID'] . ">" . $row["termName"] . "</option>";
            }
            ?>
          </select>


          <label for='students'><b> Suject Name</b> </label>
          <select name="subject" id="subject">
            <option> </option>
            <?php
            $result = get_all_subject($con);
            foreach ($result as $row) {
              echo "<option value=" . $row['subjectID'] . ">" . $row["subjectName"] . "</option>";
            }
            ?>
          </select>



          <lable for="assessment"><b>Assessment Name</b></lable>
          <input type="input" name="assessment" id="assessment">


          <button type="submit" name="submitAssessment" id="pen-btn"
            class="register btn btn-lg btn-info btn-outlin-dark" type="button">Done</button>
      </form>
  </div>

  </nav>




  <div class="content" style='padding-top:50px' ;>
    <div class="container">
      <div class="row justify-content-center">


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



    $(document).ready(function () {
      $('#navform').submit(function (e) {
        e.preventDefault(); 

       
        var className = $('#classname').val();
        var termName = $('#termname').val();
        var subject = $('#subject').val();
        var assessment = $('#assessment').val();

        if (className === '' || termName === '' || subject === '' || assessment === '') {
         
          Swal.fire({
            icon: 'error',
            title: 'Sorry...',
            text: 'Please fill in all fields!'
          });
          return;
        }

        
        $.ajax({
          url: '../action/grade_form_action.php', 
          type: 'POST',
          data: $(this).serialize(),

          success: function (response) {
            $('.content').html(response);
            $('#gradeForm').submit(function (e) {
              e.preventDefault(); 
              var formData = $(this).serialize();

            
              $.ajax({
                url: '../action/grade_action.php', 
                type: 'POST',
                data: formData,
                dataType: 'json', 
                success: function (response) {
                  if (response.success) {
                  
                    Swal.fire({
                      icon: 'success',
                      title: 'Success!',
                      text: response.message, 
                      onClose: () => {
                        $('.content').empty();
                    }
                    });
                  } else {
                    
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: response.message,
                    });
                  }
                },
                error: function (xhr, status, error) {
               
                  console.error('Error submitting second form via AJAX: ' + error);
                }
              });
            });
          }
        });
      });
    });


  </script>






</body>

</html>
$(document).ready(function () {
    $('#navform').submit(function (e) {
        e.preventDefault();

        var className = $('#classname').val();
        var termName = $('#termname').val();
        var subject = $('#subject').val();
        var assessment = $('#assessment').val();
        var year = $('#year').val();

        // Regular expression to validate the year (four digits)
        var yearRegex = /^\d{4}$/;

        // Check if any field is empty or the year format is invalid
        if (className === '' || termName === '' || subject === '' || assessment === '' || year === '') {
            Swal.fire({
                icon: 'error',
                title: 'Sorry...',
                text: 'Please fill in all fields!'
            });
            return;
        } else if (!yearRegex.test(year)) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Year',
                text: 'Please enter a valid year (YYYY format).'
            });
            return;
        }

        // Get the current year
        var currentYear = new Date().getFullYear();

        // Check if the entered year is not greater than the current year
        if (parseInt(year) > currentYear) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Year',
                text: 'Please enter a year in the past or current year.'
            });
            return;
        }

        $.ajax({
            url: '../view/preview_grade.php',
            type: 'POST',
            data: $(this).serialize(),

            success: function (response) {
                $('.content').html(response);
            },
            error: function (xhr, status, error) {
                console.error('Error submitting second form via AJAX: ' + error);
            }
        });
    });
});












$(document).ready(function () {
    $(document).on("click", ".edit", function (e) {
      e.preventDefault();
  
      var studentID = $(this).data("grade-id");
  
      $.ajax({
        url: "../view/edit_grade_view.php",
        type: "GET",
        data: { id: studentID},
        success: function (response) {
          $(".content").html(response);
  
          $(".editgradeForm").submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
  
            $.ajax({
              url: "../action/edit_grade action.php",
              type: "POST",
              data: formData,
              dataType: "json",
              success: function (response) {
                if (response.success) {
                  Swal.fire({
                    title: "Saved",
                    text: response.message,
                    icon: "success",
                    onClose: function () {
  
                      window.location.href='../view/view_recorded_grades.php';
  
                    },
                  });
                } else {
                  Swal.fire({
                    title: "Error",
                    text: response.message,
                    icon: "error",
                  });
                }
              },
              error: function (xhr, status, error) {
                console.error("Error performing edit action: " + error);
                Swal.fire({
                  title: "Error",
                  text: "Failed to save changes.",
                  icon: "error",
                });
              },
            });
          });
        },
        error: function (xhr, status, error) {
          console.error("Error performing edit action: " + error);
        },
      });
    });
  });
  


$(document).on("click", ".delete", function (e) {
    e.preventDefault();
  
    var gradeID = $(this).data("grade-id");
  
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
       
        $.ajax({
          url: "../action/delete action.php",
          type: "GET",
          data: { id: studentID },
          dataType: "json",
          success: function (response) {
            if (response.success) {
             
              $('[data-student-id="' + studentID + '"]')
                .closest("tr")
                .remove();
              Swal.fire({
                title: "Deleted!",
                text: response.message,
                icon: "success",
              });
            } else {
             
              Swal.fire({
                title: "Error!",
                text: response.message,
                icon: "error",
              });
            }
          },
          error: function (xhr, status, error) {
            console.error("Error performing delete action: " + error);
           
            Swal.fire({
              title: "Error!",
              text: "Failed to delete the student.",
              icon: "error",
            });
          },
        });
      }
    });
  });
  
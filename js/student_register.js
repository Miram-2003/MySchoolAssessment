$(document).ready(function () {
  $("#registerform").submit(function (e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
      url: "../view/registerform.php",
      type: "POST",
      data: formData,
      contentType: false, // Set content type to false for FormData
      processData: false, // Don't process the FormData
      success: function (response) {
        // Handle the response from the server
        $(".content").html(response);

        $("#formsubmit").submit(function (e) {
          e.preventDefault();

          var formData = $(this).serialize();
          $.ajax({
            url: "../action/register_student_action.php",
            type:'POST',
            data: formData,
            dataType: "json",
            success: function (response) {
              if (response.success) {
                Swal.fire({
                  icon: "success",
                  title: "Success!",
                  text: response.message,
                  onClose: () => {
                    $(".content").empty();
                  },
                });
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: response.message,
                });
              }
            },
            error: function (xhr, status, error) {
             
                console.error('Error submitting second form via AJAX: ' + error);
            }
          });
        });
      },
      error: function (xhr, status, error) {
        console.error("Error:", error);
      },
    });
  });
});



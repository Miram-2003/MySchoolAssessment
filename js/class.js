$(document).ready(function () {
  $("#classform").submit(function (e) {
    e.preventDefault();

    var classname = $("#student_class").val();
    if (classname === "") {
      Swal.fire({
        icon: "error",
        title: "Sorry..",
        text: "please select a class",
      });
      return;
    }

    $.ajax({
      url: "../view/view_class.php",
      type: "POST",
      data: $(this).serialize(),
      success: function (response) {
        $(".content").html(response);
      },
    });
  });
});




// editing student name

$(document).ready(function () {
  $(document).on("click", ".edit", function (e) {
    e.preventDefault();

    var studentID = $(this).data("student-id");
    var actionName = $(this).data("action-name");

    $.ajax({
      url: "../view/edit_Name_view.php",
      type: "GET",
      data: { id: studentID, name: actionName },
      success: function (response) {
        $(".content").html(response);

        $(".editnameForm").submit(function (e) {
          e.preventDefault();
          var formData = $(this).serialize();

          $.ajax({
            url: "../action/edit action.php",
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

                    window.location.href='../view/class_view.php';

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









//Deleting student name
$(document).on("click", ".delete", function (e) {
  e.preventDefault();

  var studentID = $(this).data("student-id");

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

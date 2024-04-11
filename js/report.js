$(document).ready(function () {
  $("#navform").submit(function (e) {
    e.preventDefault();

    var className = $("#classname").val();
    var termName = $("#termname").val();
    var year = $("#year").val();

    // Regular expression to validate the year (four digits)
    var yearRegex = /^\d{4}$/;

    // Check if any field is empty or the year format is invalid
    if (className === "" || termName === "" || year === "") {
      Swal.fire({
        icon: "error",
        title: "Sorry...",
        text: "Please fill in all fields!",
      });
      return;
    } else if (!yearRegex.test(year)) {
      Swal.fire({
        icon: "error",
        title: "Invalid Year",
        text: "Please enter a valid year (YYYY format).",
      });
      return;
    }

    // Get the current year
    var currentYear = new Date().getFullYear();

    // Check if the entered year is not greater than the current year
    if (parseInt(year) > currentYear) {
      Swal.fire({
        icon: "error",
        title: "Invalid Year",
        text: "Please enter a year in the past or current year.",
      });
      return;
    }

    $.ajax({
      url: "../action/report_action.php",
      type: "POST",
      data: $(this).serialize(),

      success: function (response) {
        $(".content").html(response);
      },
      error: function (xhr, status, error) {
        console.error("Error submitting second form via AJAX: " + error);
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

function printReport(button) {
    // Find the closest container of the clicked button
    var reportContainer = $(button).closest('.container');
    // Print the contents of the container
    window.print();
}
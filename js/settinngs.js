$(document).ready(function () {
    $(document).on("click", ".add", function (e) {
      e.preventDefault();
  
      // Get the action name from the data attribute of the clicked element
      var name = $(this).data("action-name");
  
      // Send AJAX request to fetch content
      $.ajax({
        url: "../view/setting_view.php",
        type: "POST",
        data: { action: name }, // Include action in the data
        success: function (response) {
          // Update the content area with the fetched content
          $(".content").html(response);
  
          // Attach form submission handler
          $(".addForm").submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
              url: "../action/setting_action.php",
              type: "POST",
              data: formData,
              dataType: "json",
              success: function (response) {
                // Check the response for success or failure
                if (response.success) {
                  // Success message
                  Swal.fire({
                    title: "Add",
                    text: response.message,
                    icon: "success",
                    onClose: function () {
                      // Redirect to the desired page
                      window.location.href = "../view/view settings.php";
                    },
                  });
                } else {
                  // Error message
                  Swal.fire({
                    title: "Try Again",
                    text: response.message,
                    icon: "error",
                  });
                }
              },
              error: function (xhr, status, error) {
                // Error handling
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
  
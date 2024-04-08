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
          $('.content').html(response)
        },
        error: function (xhr, status, error) {
          console.error('Error performing edit action: ' + error);
        }
      });
    });

    $('#editnameForm').submit(function (e) {
        e.preventDefault(); 
        var formData = $(this).serialize();

        $.ajax({
            url:'../action/edit action.php',
            type:'POST',
            data: formDate,
            datatype: 'json',
            success: function(response){
                Swal.fire({
                    title: 'Saved',
                    text: response.message,
                    icon: 'success',
                });
            }
        });
        });


});    










$(document).on('click', '.delete', function (e) {
        e.preventDefault(); 

        var studentID = $(this).data('student-id');
    
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, proceed with the AJAX request
                $.ajax({
                    url: '../action/delete action.php',
                    type: 'GET',
                    data: { id: studentID },
                    dataType:'json',
                    success: function (response) {
                        if (response.success) {
                            // Show success message with SweetAlert
                            $('[data-student-id="' + studentID + '"]').closest('tr').remove();
                            Swal.fire({
                                title: 'Deleted!',
                                text: response.message,
                                icon: 'success',
                            
                            });
                        } else {
                            // Show error message with SweetAlert
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error performing delete action: ' + error);
                        // Show error message with SweetAlert
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to delete the student.',
                            icon: 'error',
                        });
                    }
                });
            }
        });
    });
    
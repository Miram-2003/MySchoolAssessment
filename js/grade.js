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
        url: '../view/grade_form_action.php', 
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

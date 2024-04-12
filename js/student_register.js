$(document).ready(function () {
    // Form submission for selecting class and number of students
    $('#registerform').submit(function (e) {
        e.preventDefault();
        var className = $('#student_class').val();
        var classNumber = $('#student').val();
        
        // Validation
        if (className === '' || classNumber === '') {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please fill in all fields!'
            });
            return;
        }

        var classNumberPattern = /^\d+$/; 
        if (!classNumberPattern.test(classNumber)) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please enter a valid number for the class!'
            });
            return;
        }
        
        $.ajax({
            url: "../view/registerform.php",
            type: "POST",
            data: $(this).serialize(),
            success: function (response) {
                $(".content").html(response);
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
            }
        });
    });

    // Event delegation for student registration form submission
    $(document).on('submit', '#formsubmit', function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        
        // Validate student names
        var isValid = true;
        $(this).find('input[type="text"]').each(function() {
            var studentName = $(this).val().trim();
            // Validate each student name to contain only letters and spaces
            var studentNamePattern = /^[a-zA-Z\s]+$/;
            if (!studentNamePattern.test(studentName)) {
                isValid = false;
                return false; // Exit the loop early if any name is invalid
            }
        });

        if (!isValid) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please enter valid names for all students (letters and spaces only)!'
            });
            return;
        }

        // Proceed with submitting the form data
        $.ajax({
            url: "../action/register_student_action.php",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Success!",
                        text: response.message,
                        onClose: () => {
                            goBack();
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
                console.error('Error submitting form via AJAX: ' + error);
            }
        });
    });
});

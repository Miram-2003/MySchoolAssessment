
    // Handle form submission
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        // Create FormData object to serialize form data
        var formData = new FormData(this);

        // Send AJAX request
        fetch('../action/login-action.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // Check login status and show SweetAlert
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: data.message,
                    onClose: () => {
                        // Redirect to the desired page
                        window.location.href = '../view/class_view.php';
                    }
                });
            } else {
                document.getElementById('passwordError').innerText = data.message;

             }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

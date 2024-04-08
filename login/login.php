<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Login</title>
    
    <style>
        body {
            background: whitesmoke;
        }

        .box {
            width: 550px;
            margin-left: 40%;
            overflow-y: 10px;
        }

        h4 {
            color: rgb(148, 6, 105);
        }

        .side {
            margin-top: -8%;
            height: 100vh;
            width: 350px;
            position: fixed;
        }

        .sch {
            margin-top: 50%;
            margin-left: 12%;
        }

        form {
            margin-top: 20%;
            margin-left: 5%;
            width: 480px;
        }

        button {
            margin-left: 68%;
            width: 150px;
            height: 40px;
            background: rgb(148, 6, 105);
            color: white;
            font-size: large;
            border: white;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="side bg-light">
        <div class="sch">
            <h4 class="text-center" Style=" margin-left: -12%;"><i>Fidelity Juvinile Basic School</i></h4>
            <img src="../images/logo.png" alt="school logo">
        </div>

        <h5 class="text-center"><em>Student Assessment Portal</em></h5>
    </div>
    <div class="container">
        <div class="box">
            <form action="../action/login-action.php" method="post" id='loginForm'>
                <div>
                    <h4 class="text-center p-2">LogIn</h4>
                    <div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" required title='Enter your email'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control" required title='Enter your password'>
                            </div>
                        </div>
                        

                        <span id="passwordError" class="text-danger"></span> <!-- Placeholder for error message -->
                       
                        <div class="form-group">
                            <button type="submit" name="login" id='submit'>Login</button>
                        </div>

                        <div class="text-center">
                            <h6 class="m-3"><em>Don't have an account? <a href="../login/login.php">Signup here</a></em>
                            </h6>
                        </div>
            </form>
        </div>
    </div>
<script>
    
    // Handling form submission
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Preventing default form submission

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
</script>
 

</body>
</html>
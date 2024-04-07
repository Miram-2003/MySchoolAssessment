<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/rgister.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">

    <title>Register</title>

    <Style>
        body {
            background: whitesmoke;

        }

        .box {
            border: 1px solid rgb(148, 6, 105);
            width: 550px;

            margin-left: 40%;
            overflow-y: 10px;


            h4 {
                color: rgb(148, 6, 105);
            }

        }

        .side {

            height: 100vh;
            width: 350px;
            position: fixed;
        }

        .sch {
            margin-top: 50%;
            margin-left: 12%;
        }

        form {
            margin-top: 5%;
            margin-left: 5%;
            width: 480px;
        }
    </Style>

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

            <form action="../action/register-action.php" method="post">
                <h4 class="text-center p-2">Sign up</h4>
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        </div>
                        <input type="text" name="fname" class="form-control" placeholder="Enter your name"
                            pattern="[A-Z- a-z]{2,}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="lname">Last Name</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        </div>
                        <input type="text" name="lname" class="form-control" placeholder="Enter your last name"
                            pattern="[A-Z- a-z]{2,}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="contact">Contact</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                        </div>
                        <input type="tel" name="contact" class="form-control" placeholder="0509534568" required
                            pattern="[0-9 ()+-]{10,}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required
                            pattern="[a-z0-9._-]+@[a-z0-9.-]+\.[a-z]{2,}">
                    </div>

                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        </div>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Enter a password"
                            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}" required>
                    </div>

                </div>

                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                        </div>
                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control"
                            placeholder="Confirm your password" onkeyup="checkPassword()" required>
                    </div>
                    <div>
                        <span class="" id="confirmMessage"></span>
                    </div>

                </div>

                <div class="form-group">
                    <button type="submit" name="register" class="btn btn-primary mt-2">Sign up</button>
                </div>
            </form>

            <div class="text-center">
                <p class="m-3">Already have an account? <a href="../login/login.php">Login here</a></p>
            </div>
        </div>
    </div>

    <script src="../js/register.js"></script>
</body>

</html>
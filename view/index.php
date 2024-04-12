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
            background: #eee;
            padding-top: 56px;
            background:
                linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                /* Overlay color */
                url('../images/logo.png') no-repeat center center fixed;
            /* Background image */
            /* Specify background image size */
            background-size: 700px, 700px;
            background-position: top;
            background-position-x: 450px;
            font-family: "Times New Roman", Times, serif;

        }

        .box {
            width: 550px;
            margin-left: 40%;
            overflow-y: 10px;
        }

        h4 {
            color:rgb(111, 22, 114);
        }

        .side {
            margin-top: -4%;
            height: 100vh;
            width: 350px;
            position: fixed;
        }

        .sch {
            margin-top: 50%;
            margin-left: 12%;
        }

a {
   
    color:white;
}
a:hover{
    color: black;
   
}

        button {
            margin-top: 40%;
            width: 170px;
            height: 40px;
            background: rgb(111, 22, 114);
            color: white;
            font-size: x-large;
            border: white;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="side bg-light">

        <div class="sch">
            <h4 class="text-center" Style=" margin-left: -12%;"><i>Fidelity Juvinile Basic School</i></h4>
            <img src="images/logo.png">
        </div>

        <h5 class="text-center"style="font-size: 30px;"><em>Student Assessment Portal</em></h5>

    </div>

    <div class="box container">
        <h4 class="text-center" style="font-size: 80px;"><em><b>Welcome Our Great Teacher</em></b></h4>
        <div class="container d-flex justify-content-between">
        <a href="login/login.php"><button class="">LogIn</button></a>

        <a href="login/register.php"> <button class="">Sign Up</button></a>
        </div>
    </div>


</body>

</html>
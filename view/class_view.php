<?php
include "../functions/class.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Optional custom styles */
        .sidebar {
            height: 100%;
            overflow-y: auto;
            position:fixed;
            z-index: 999;
        }

        .sidebar a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
        }

        .sidebar a:hover {
            background-color: #ddd;
        }

    .px-md-4 {
    padding-right: 1.5rem !important;
    padding-left: 20rem !important;
}

    </style>
</head>

<body>

  
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
               
                <div class="classform">
                    <form method="post">
                        <label for="student_class">Select a class </label>
                        <select name="student_class" id="student_class">
                            <option> </option>
                            <?php
                            $result = get_all_class($con);

                            foreach ($result as $row) {
                                echo "<option value=" . $row['classID'] . ">" . $row["className"] . "</option>";
                            }
                            ?>
                        </select>
                        <button type="submit" id="submit" name="submit">Done</button>
                    </form>
                </div>



                <?php
                include "../functions/students.php";

                $class = "";

                if (isset($_POST["submit"])) {
                    $class = $_POST["student_class"];
                    if ($class === "") {
                        echo "please choose a class";
                    } else {
                        $class_num = $class;
                        $result = get_all_student_class($class_num);

                        $class_name = get_a_classname($class_num);
                        if ($result->num_rows === 0) {
                            echo "<h3>Class:" . $class_name . "</h3>";
                            echo "No student is register in this class";
                            echo "<a href = '../view/register student view.php'>Register Student</a>";
                        } else {
                            $students = $result->fetch_all(MYSQLI_ASSOC);
                            $table = "<h3>Class:" . $class_name . "</h3>";

                            $table .= "<table>";
                            $table .= "<thead>";
                            $table .= "<tr>";
                            $table .= "<th>Student Index Number</th>";
                            $table .= "<th>Student Name</th>";
                            $table .= "<th>Action</th>";
                            $table .= "</tr>";
                            $table .= "</thead>";
                            $table .= "<tbody>";
                            foreach ($students as $row) {
                                $table .= "<tr>";
                                $table .= "<td>" . $row["studentIndex"] . "</td>";
                                $table .= "<td>" . $row["studentName"] . "</td>";
                                $table .= "<td>
                 <a href=\"../view/edit_Name_view.php?id=" . $row['studentID'] . "&name=editName\"> <button type='submit' name='edit'>change Name</button></a>
                 <a href=\"../view/edit_Name_view.php?id=" . $row['studentID'] . "&name=editclass\"> <button type='submit' name='edit'>change Class</button></a>
                 <a href=\"../action/delete action.php?id=" . $row['studentID'] . "\"> <button type='submit' name='edit'>Remove Student</button></a>
                </td>";
                                $table .= "</tr>";
                            }
                            $table .= "</tbody>";
                            $table .= "</thead>";
                            echo $table;
                        }
                    }
                }

                if (isset($_POST["submit"])) {
                    $class = $_POST["student_class"];
                    if ($class === "") {
                        echo "please choose a class";
                    } else {
                        $class_num = $class;
                        $result = get_all_student_class($class_num);

                        $class_name = get_a_classname($class_num);
                        if ($result->num_rows === 0) {
                            echo "<h3>Class:" . $class_name . "</h3>";
                            echo "No student is register in this class";
                            echo "<a href = '../view/register student view.php'>Register Student</a>";
                        } else {
                            $students = $result->fetch_all(MYSQLI_ASSOC);
                            $table = "<h3>Class:" . $class_name . "</h3>";

                            $table .= "<table>";
                            $table .= "<thead>";
                            $table .= "<tr>";
                            $table .= "<th>Student Index Number</th>";
                            $table .= "<th>Student Name</th>";
                            $table .= "<th>Action</th>";
                            $table .= "</tr>";
                            $table .= "</thead>";
                            $table .= "<tbody>";
                            foreach ($students as $row) {
                                $table .= "<tr>";
                                $table .= "<td>" . $row["studentIndex"] . "</td>";
                                $table .= "<td>" . $row["studentName"] . "</td>";
                                $table .= "<td>
                 <a href=\"../view/edit_Name_view.php?id=" . $row['studentID'] . "&name=editName\"> <button type='submit' name='edit'>change Name</button></a>
                 <a href=\"../view/edit_Name_view.php?id=" . $row['studentID'] . "&name=editclass\"> <button type='submit' name='edit'>change Class</button></a>
                 <a href=\"../action/delete action.php?id=" . $row['studentID'] . "\"> <button type='submit' name='edit'>Remove Student</button></a>
                </td>";
                                $table .= "</tr>";
                            }
                            $table .= "</tbody>";
                            $table .= "</thead>";
                            echo $table;
                        }
                    }
                }


                if (isset($_POST["submit"])) {
                    $class = $_POST["student_class"];
                    if ($class === "") {
                        echo "please choose a class";
                    } else {
                        $class_num = $class;
                        $result = get_all_student_class($class_num);

                        $class_name = get_a_classname($class_num);
                        if ($result->num_rows === 0) {
                            echo "<h3>Class:" . $class_name . "</h3>";
                            echo "No student is register in this class";
                            echo "<a href = '../view/register student view.php'>Register Student</a>";
                        } else {
                            $students = $result->fetch_all(MYSQLI_ASSOC);
                            $table = "<h3>Class:" . $class_name . "</h3>";

                            $table .= "<table>";
                            $table .= "<thead>";
                            $table .= "<tr>";
                            $table .= "<th>Student Index Number</th>";
                            $table .= "<th>Student Name</th>";
                            $table .= "<th>Action</th>";
                            $table .= "</tr>";
                            $table .= "</thead>";
                            $table .= "<tbody>";
                            foreach ($students as $row) {
                                $table .= "<tr>";
                                $table .= "<td>" . $row["studentIndex"] . "</td>";
                                $table .= "<td>" . $row["studentName"] . "</td>";
                                $table .= "<td>
                 <a href=\"../view/edit_Name_view.php?id=" . $row['studentID'] . "&name=editName\"> <button type='submit' name='edit'>change Name</button></a>
                 <a href=\"../view/edit_Name_view.php?id=" . $row['studentID'] . "&name=editclass\"> <button type='submit' name='edit'>change Class</button></a>
                 <a href=\"../action/delete action.php?id=" . $row['studentID'] . "\"> <button type='submit' name='edit'>Remove Student</button></a>
                </td>";
                                $table .= "</tr>";
                            }
                            $table .= "</tbody>";
                            $table .= "</thead>";
                            echo $table;
                        }
                    }
                }
                if (isset($_POST["submit"])) {
                    $class = $_POST["student_class"];
                    if ($class === "") {
                        echo "please choose a class";
                    } else {
                        $class_num = $class;
                        $result = get_all_student_class($class_num);

                        $class_name = get_a_classname($class_num);
                        if ($result->num_rows === 0) {
                            echo "<h3>Class:" . $class_name . "</h3>";
                            echo "No student is register in this class";
                            echo "<a href = '../view/register student view.php'>Register Student</a>";
                        } else {
                            $students = $result->fetch_all(MYSQLI_ASSOC);
                            $table = "<h3>Class:" . $class_name . "</h3>";

                            $table .= "<table>";
                            $table .= "<thead>";
                            $table .= "<tr>";
                            $table .= "<th>Student Index Number</th>";
                            $table .= "<th>Student Name</th>";
                            $table .= "<th>Action</th>";
                            $table .= "</tr>";
                            $table .= "</thead>";
                            $table .= "<tbody>";
                            foreach ($students as $row) {
                                $table .= "<tr>";
                                $table .= "<td>" . $row["studentIndex"] . "</td>";
                                $table .= "<td>" . $row["studentName"] . "</td>";
                                $table .= "<td>
                 <a href=\"../view/edit_Name_view.php?id=" . $row['studentID'] . "&name=editName\"> <button type='submit' name='edit'>change Name</button></a>
                 <a href=\"../view/edit_Name_view.php?id=" . $row['studentID'] . "&name=editclass\"> <button type='submit' name='edit'>change Class</button></a>
                 <a href=\"../action/delete action.php?id=" . $row['studentID'] . "\"> <button type='submit' name='edit'>Remove Student</button></a>
                </td>";
                                $table .= "</tr>";
                            }
                            $table .= "</tbody>";
                            $table .= "</thead>";
                            echo $table;
                        }
                    }
                }

                ?>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
</body>

</html>
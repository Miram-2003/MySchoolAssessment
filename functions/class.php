<?php
include "../settings/connection.php";


function get_all_class($con){
    $class_query = "SELECT * FROM `class`";
    $class_execute = $con->query($class_query);
    if ($class_execute) {
        $result = $class_execute->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}

function get_a_classname($num)
{
    global $con;

    $class_query = "SELECT `className` FROM `class` WHERE `classID` = ?";
    $class_query = $con->prepare($class_query);
    $class_query->bind_param("i", $num);
    $class_query->execute();
    $result = $class_query->get_result();
    if ($result->num_rows === 0) {
        return "Please select a class";
    } else {
        $class = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($class as $row) {
            return $row["className"];
        }

    }
}

function get_class_id($name)
{
    global $con;

    $class_query = "SELECT `classID` FROM `class` WHERE `className` = ?";
    $class_query = $con->prepare($class_query);
    $class_query->bind_param("s", $name);
    $class_query->execute();
    $result = $class_query->get_result();
    if ($result->num_rows > 0) {
        $class = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($class as $row) {
            return $row["classID"];
        }

    }
}




function get_all_term($con){
    $class_query = "SELECT * FROM `term`";
    $class_execute = $con->query($class_query);
    if ($class_execute) {
        $result = $class_execute->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
}


function get_a_termname($num)
{
    global $con;

    $class_query = "SELECT `termName` FROM `term` WHERE `termID` = ?";
    $class_query = $con->prepare($class_query);
    $class_query->bind_param("i", $num);
    $class_query->execute();
    $result = $class_query->get_result();
    if ($result->num_rows === 0) {
        return "Please select a class";
    } else {
        $class = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($class as $row) {
            return $row["termName"];
        }

    }
}
?>



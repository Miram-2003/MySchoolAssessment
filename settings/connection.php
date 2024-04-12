<?php

$_SERVER = "localhost";
$USERNAME = "root";
$PASSWORD =  "kch6Xcwx3FF/";
$DB = "school_assessment";

$con =new mysqli($_SERVER, $USERNAME, $PASSWORD, $DB) or die("could not connect database");

if ($con->connect_error) {
    die("connecton failed". $con->connect_error);
}

?>
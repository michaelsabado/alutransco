<?php

include('dbcon.php');

$type = $_POST['type'];



if ($type == 1) {

    $busname = $_POST['busname'];

    $sql = "INSERT INTO `buses`( `bus_name`) VALUES ('$busname')";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 2;
    }
}


if ($type == 2) {

    $id = $_POST['id'];
    $busname = $_POST['busname'];

    $sql = "UPDATE `buses` SET `bus_name`='$busname' WHERE bus_id = $id";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 2;
    }
}


if ($type == 3) {
    $id = $_POST['id'];
    $sql = "DELETE from buses WHERE bus_id = $id";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 2;
    }
}

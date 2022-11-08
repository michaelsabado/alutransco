<?php

include('dbcon.php');

$type = $_POST['type'];



if ($type == 1) {

    $bus = $_POST['bus'];
    $driver = $_POST['driver'];
    $conductor = $_POST['conductor'];
    $dispatcher = $_POST['dispatcher'];
    $earnings = $_POST['earnings'];
    $maintenance = $_POST['earnings'] * .20;
    $date = $_POST['date'];

    $sql = "INSERT INTO `trips`(`bus_id`, `driver_id`, `conductor_id`, `dispatcher_id`, `earnings`, `maintenance`, `date`) VALUES ($bus,$driver,$conductor,$dispatcher,'$earnings','$maintenance','$date')";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 2;
    }
}


if ($type == 2) {
    $id = $_POST['id'];
    $bus = $_POST['bus'];
    $driver = $_POST['driver'];
    $conductor = $_POST['conductor'];
    $dispatcher = $_POST['dispatcher'];
    $earnings = $_POST['earnings'];
    $maintenance = $_POST['earnings'] * .20;
    $date = $_POST['date'];

    $sql = "UPDATE `trips` SET `bus_id`='$bus',`driver_id`='$driver',`conductor_id`='$conductor',`dispatcher_id`='$dispatcher',`earnings`='$earnings',`maintenance`='$maintenance',`date`='$date' WHERE trip_id = $id";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 2;
    }
}


if ($type == 3) {
    $id = $_POST['id'];
    $sql = "DELETE from trips WHERE trip_id = $id";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 2;
    }
}

<?php

include('dbcon.php');

$type = $_POST['type'];



if($type == 1){

    $bus = $_POST['bus'];
    $driver = $_POST['driver'];
    $conductor = $_POST['conductor'];
    $dispatcher = $_POST['dispatcher'];
    $earnings = $_POST['earnings'];
    $maintenance = $_POST['maintenance'];
    $date = $_POST['date'];

    $sql = "INSERT INTO `trips`(`bus_id`, `driver_id`, `conductor_id`, `dispatcher_id`, `earnings`, `maintenance`, `date`) VALUES ($bus,$driver,$conductor,$dispatcher,'$earnings','$maintenance','$date')";

    if(mysqli_query($conn, $sql)){
        echo 1;
    }else {
        echo 2;
    }
    

}
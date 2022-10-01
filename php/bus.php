<?php

include('dbcon.php');

$type = $_POST['type'];



if($type == 1){

    $busname = $_POST['busname'];

    $sql = "INSERT INTO `buses`( `bus_name`) VALUES ('$busname')";

    if(mysqli_query($conn, $sql)){
        echo 1;
    }else {
        echo 2;
    }
    
}
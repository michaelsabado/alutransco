<?php

include('dbcon.php');

$type = $_POST['type'];



if($type == 1){

    $description = $_POST['description'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO `deductions`( `description`, `amount`) VALUES ('$description', $amount)";

    if(mysqli_query($conn, $sql)){
        echo 1;
    }else {
        echo 2;
    }
    
}
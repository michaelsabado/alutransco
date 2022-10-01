<?php

include('dbcon.php');

$type = $_POST['type'];



if($type == 1){

    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $e_type = $_POST['e_type'];

    $sql = "INSERT INTO `employees`( `firstname`, `middlename`, `lastname`, `address`, `contact`, `type`) VALUES ('$firstname','$middlename','$lastname','$address','$contact','$e_type')";

    if(mysqli_query($conn, $sql)){
        echo 1;
    }else {
        echo 2;
    }
    

}
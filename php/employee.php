<?php

include('dbcon.php');

$type = $_POST['type'];



if ($type == 1) {

    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $e_type = $_POST['e_type'];

    $sql = "INSERT INTO `employees`( `firstname`, `middlename`, `lastname`, `address`, `contact`, `type`) VALUES ('$firstname','$middlename','$lastname','$address','$contact','$e_type')";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 2;
    }
}

if ($type == 2) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $e_type = $_POST['e_type'];

    $sql = "UPDATE `employees` SET `firstname`='$firstname',`middlename`='$middlename',`lastname`='$lastname',`address`='$address',`contact`='$contact',`type`='$e_type' WHERE emp_id = $id";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 2;
    }
}

if ($type == 3) {
    $id = $_POST['id'];
    $sql = "DELETE from employees WHERE emp_id = $id";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 2;
    }
}


if ($type == 4) {
    $id = $_POST['id'];
    $bonus = $_POST['bonus'];
    $sql = "UPDATE adjustments SET bonus = $bonus WHERE user_id = $id";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 2;
    }
}

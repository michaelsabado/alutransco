<?php

include('dbcon.php');

$type = $_POST['type'];



if ($type == 1) {

    $description = $_POST['description'];
    $amount = $_POST['amount'];

    $sql = "INSERT INTO `deductions`( `description`, `amount`) VALUES ('$description', $amount)";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 2;
    }
}


if ($type == 2) {
    $id = $_POST['id'];
    $description = $_POST['description'];
    $amount = $_POST['amount'];

    $sql = "UPDATE `deductions` SET `description`='$description',`amount`='$amount' WHERE deduc_id = $id";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 2;
    }
}


if ($type == 3) {
    $id = $_POST['id'];
    $sql = "DELETE from deductions WHERE deduc_id = $id";

    if (mysqli_query($conn, $sql)) {
        echo 1;
    } else {
        echo 2;
    }
}

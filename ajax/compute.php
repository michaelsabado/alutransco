<?php

require('../php/dbcon.php');

$emp = $_POST['emp'];
$e_type = $_POST['e_type'];
$deduction = $_POST['deduction'];
$bonus = $_POST['bonus'];
$start = $_POST['start'];
$end = $_POST['end'];

// Compute deductions

$sql = "SELECT SUM(amount) as deductions from deductions";
$res = mysqli_query($conn, $sql);
$deductions = $res->fetch_array()['deductions'];





if ($e_type == 1) $field = 'driver_id';
else if ($e_type == 2) $field = 'conductor_id';
else if ($e_type == 3) $field = 'dispatcher_id';
$sql = "SELECT SUM(earnings) as earnings, SUM(maintenance) as maintenance, (earnings - maintenance) as total FROM trips WHERE $field = $emp AND ( `date` >= '$start' AND `date` <= '$end' )";
$res = mysqli_query($conn, $sql);
extract($res->fetch_array());

switch ($e_type) {
    case 1:
        $text = "Driver Salary Rate";
        $rate = .15;
        break;
    case 2:
        $text = "Conductor Salary Rate";
        $rate = .10;
        break;
    case 3:
        $text = "Collector/Dispatcher Salary Rate";
        $rate = '350';
        break;
}

?>

<div class="h3 fw-bold mb-4">Computations</div>

<div class="h6 fw-bold"><?= $text ?></div>
<?php

if ($e_type == 1 || $e_type == 2) {
?>
    <div class="h1 fw-bold mb-3"><?= ($e_type == 1) ? '15%' : '10%' ?></div>
<?php
} else {
?>
    <div class="h1 fw-bold mb-3">₱ <?= $rate ?>/day</div>
<?php
}
?>


<div class="h6 fw-bold">Gross Pay</div>
<?php

if ($e_type == 1 || $e_type == 2) {
    $gross = $total * $rate;
?>
    <div class="h1 fw-bold mb-3">₱ <?= number_format($gross, 2) ?></div>
<?php
} else {

    $sql_dispatch = "SELECT distinct(date) FROM trips WHERE $field = $emp AND ( `date` >= '$start' AND `date` <= '$end' ) ";
    $r = mysqli_query($conn, $sql_dispatch);
    $gross = $r->num_rows * $rate;

?>
    <div class="h1 fw-bold mb-0">₱ <?= number_format($gross, 2) ?></div>
    <div class="h6 mb-4"><?= $r->num_rows ?> day/s</div>
<?php
}
?>



<?php



if ($deduction == 1) {
?>
    <div class="h6 fw-bold">Deductions</div>
    <div class="h1 fw-bold mb-3 text-danger">₱ <?= number_format($deductions, 2) ?></div>
<?php
} else {
    $deductions = 0;
?>

<?php
}


if ($bonus != '') {

?>

    <div class="h6 fw-bold">Bonus</div>
    <div class="h1 fw-bold mb-3 text-success">₱ <?= number_format($bonus, 2) ?></div>
<?php
} else $bonus = 0;


?>

<hr>
<div class="h6 fw-bold text-end">Net Pay</div>
<div class="display-6 fw-bold mb-3 text-end">= ₱ <?= number_format($gross - $deductions + $bonus, 2) ?></div>
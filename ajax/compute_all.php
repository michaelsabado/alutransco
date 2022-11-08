<?php

require('../php/dbcon.php');


$deduction = $_POST['deduction'];
if ($deduction == 1) {
    // Compute deductions
    $sql = "SELECT SUM(amount) as deductions from deductions";
    $res = mysqli_query($conn, $sql);
    $deductions = $res->fetch_array()['deductions'];
} else {
    $deductions = 0;
}

$start = $_POST['start'];
$end = $_POST['end'];


$days = [];
while ($start != date('Y-m-d', strtotime($end . ' + 1 days'))) {
    array_push($days, $start);
    $start = date('Y-m-d', strtotime($start . ' + 1 days'));
}


?>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                    Employees
                </th>
                <?php
                foreach ($days as $day) {
                    echo '<th>' . date('m/d', strtotime($day)) . '</th>';
                }
                ?>
                <th class="bg-success text-white text-nowrap">Gross Pay (₱)</th>
                <th class="bg-danger text-white">Deduction (₱)</th>
                <th class=" bg-primary text-white text-nowrap">Net Pay (₱)</th>
                <th>Print</th>
            </tr>
        </thead>
        <tbody>

            <?php


            $sql = "SELECT * FROM employees ORDER by firstname";
            $employees_res = mysqli_query($conn, $sql);
            while ($emp_row = $employees_res->fetch_assoc()) {
                $emp = $emp_row['emp_id'];

                $e_type = $emp_row['type'];

                if ($e_type == 1) $field = 'driver_id';
                else if ($e_type == 2) $field = 'conductor_id';
                else if ($e_type == 3) $field = 'dispatcher_id';

            ?>
                <tr>
                    <td><?= $emp_row['firstname'] . ' ' .  $emp_row['lastname']  ?></td>
                    <?php

                    $totalGross = 0;

                    foreach ($days as $d) {
                        $sql = "SELECT * FROM trips WHERE $field = $emp AND `date` = '$d'";

                        $res = mysqli_query($conn, $sql);
                        if ($res->num_rows == 0) {
                            echo '<td>0</td>';
                            continue;
                        }
                        extract($res->fetch_array());
                        $total = $earnings - $maintenance;
                        switch ($e_type) {
                            case 1:
                                $text = "Driver Salary Rate";
                                $gross = number_format($total * 0.15, 2);
                                break;
                            case 2:
                                $text = "Conductor Salary Rate";
                                $gross = number_format($total * 0.10, 2);
                                break;
                            case 3:
                                $text = "Collector/Dispatcher Salary Rate";
                                // FOR CONDUCTOR
                                $sql_dispatch = "SELECT distinct(date) FROM trips WHERE $field = $emp AND ( `date` >= '$start' AND `date` <= '$end' ) ";
                                $r = mysqli_query($conn, $sql_dispatch);
                                $gross = $r->num_rows * 350;
                                break;
                        }
                        echo '<td>' . $gross . '</td>';

                        $totalGross += $gross;
                    }
                    echo '<td>' . $totalGross . '</td>';
                    echo '<td>' . $deductions . '</td>';
                    echo '<td>' . $totalGross - $deductions . '</td>';
                    echo '<td><a href="">Print</a></td>';
                    ?>
                </tr>
            <?php

            }
            ?>

        </tbody>
    </table>
</div>
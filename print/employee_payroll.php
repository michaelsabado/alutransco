<?php

require('../php/dbcon.php');

$emp = $_GET['id'];

$st = $start = $_GET['start'];
$end = $_GET['end'];
$sql = "SELECT a.emp_id, a.firstname, a.middlename, a.lastname, a.type, b.id as adj, b.bonus, b.deduction FROM employees a  LEFT JOIN adjustments b ON a.emp_id = b.user_id WHERE emp_id = $emp";
$employees_res = mysqli_query($conn, $sql);
if ($employees_res->num_rows > 0) {
    $emp_row = $employees_res->fetch_assoc();
    $bonus = $emp_row['bonus'];
    $deductions = $emp_row['deduction'];
} else {
    header('Location:../payroll');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINT</title>
    <style>
        body {
            max-width: 8in;
        }

        table tr td {
            vertical-align: middle;
            text-align: end;
            padding: 2px;
        }

        th {
            text-align: start;
        }

        table,
        th,
        td {
            border: 1px solid #888;
            border-collapse: collapse;
        }

        h3,
        h4,
        h5 {
            margin: 0;
        }
    </style>
</head>

<body id="element-to-print">

    <?php
    $days = [];
    while ($start != date('Y-m-d', strtotime($end . ' + 1 days'))) {
        array_push($days, $start);
        $start = date('Y-m-d', strtotime($start . ' + 1 days'));
    }


    ?>


    <div id="tb" class="table-responsive">
        <div style="text-align: center; margin-bottom: 10px">
            <h3>Employee Payslip</h3>
        </div>
        <br>
        <h4>Employee Name: <?= $emp_row['firstname'] . ' ' . $emp_row['lastname'] ?></h4>
        <h4>Pay Period: <?= date('F d, Y', strtotime($st)) ?> to <?= date('F d, Y', strtotime($end)) ?></h4>
        <h4>Worked Days: <?= count($days) ?></h4>
        <?php

        if ($emp_row['type'] == 1) $tx = 'Driver';
        else if ($emp_row['type']  == 2) $tx = 'Conductor';
        else if ($emp_row['type']  == 3) $tx = 'Dispatcher/Collector';

        ?>
        <h4>Designation: <?= $tx ?></h4>
        <br>
        <table border="1" class="table table-bordered" width="100%">

            <!-- <tr>
                <th>
                    Employees
                </th>
             
                <th class="bg-success text-white text-nowrap">Gross Pay (₱)</th>
                <th class="bg-danger text-white">Deduction (₱)</th>
                <th class="bg-warning text-white">Bonus (₱)</th>
                <th class=" bg-primary text-white text-nowrap">Net Pay (₱)</th>

            </tr> -->

            <!-- <tr>
                <td><?= $emp_row['firstname'] . ' ' .  $emp_row['lastname']  ?></td> -->
            <?php



            $emp = $emp_row['emp_id'];

            $e_type = $emp_row['type'];

            if ($e_type == 1) $field = 'driver_id';
            else if ($e_type == 2) $field = 'conductor_id';
            else if ($e_type == 3) $field = 'dispatcher_id';
            $totalGross = 0;

            foreach ($days as $d) {
                $sql = "SELECT * FROM trips WHERE $field = $emp AND `date` = '$d'";

                $res = mysqli_query($conn, $sql);
                if ($res->num_rows == 0) {
                    echo '<tr>';
                    echo '<th>' . date('F d, Y', strtotime($d)) . '</th>';
                    echo '<td><h3>0</h3></td>';
                    echo '</tr>';
                    continue;
                }
                extract($res->fetch_array());
                $total = $earnings - $maintenance;
                switch ($e_type) {
                    case 1:
                        $text = "Driver Salary Rate";
                        $gross = (float)$total * 0.15;
                        break;
                    case 2:
                        $text = "Conductor Salary Rate";
                        $gross = (float)$total * 0.10;
                        break;
                    case 3:
                        $text = "Collector/Dispatcher Salary Rate";
                        // FOR CONDUCTOR
                        $sql_dispatch = "SELECT distinct(date) FROM trips WHERE $field = $emp AND ( `date` = '$d' ) ";
                        $r = mysqli_query($conn, $sql_dispatch);
                        if ($r->num_rows > 0) {
                            $gross = 350;
                        } else $gross = 0;
                        break;
                }
                echo '<tr>';
                echo '<th>' . date('F d, Y', strtotime($d)) . '</th>';
                echo '<td><h3>' . $gross . '</h3></td>';
                echo '</tr>';
                $totalGross = (float)$totalGross + $gross;
            }
            // echo '<td>' . $totalGross . '</td>';
            // echo '<td>' . $deductions . '</td>';
            // echo '<td>' . $bonus . '</td>';
            // echo '<td>' . ($totalGross - $deductions + $bonus) . '</td>';

            ?>
            <!-- </tr> -->

            <tr>
                <td>-</td>
                <td></td>
            </tr>
            <tr>
                <th>Gross Pay</th>
                <td>
                    <h3><?= $totalGross ?></h3>
                </td>
            </tr>
            <tr>
                <th>Deductions</th>
                <td>
                    <h3>- <?= $deductions ?></h3>
                </td>
            </tr>
            <tr>
                <th>Bonus Pay</th>
                <td>
                    <h3>+ <?= $bonus ?></h3>
                </td>
            </tr>
            <tr>
                <th>Net Pay</th>
                <td>
                    <h3>= <?= ($totalGross - $deductions + $bonus) ?></h3>
                </td>
            </tr>


        </table>
        <br><br>
        <div style="text-align: center; margin-bottom: 10px">
            <h1>Php <?= ($totalGross - $deductions + $bonus) ?></h1>
        </div>
        <br><br><br>
        <h3>Employer Signature: ____________________</h3>
        <br>
        <br><br>
        <h3>Employee Signature: ____________________</h3>
        <br><br><br><br>
        <div style="text-align: center; margin-bottom: 10px">
            <h4>This is a system generated slip.</h4>
        </div>
    </div>
    <script src="../partials/html2pdf.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // code... 
            // window.print();
            var element = document.getElementById('element-to-print');
            var opt = {
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                margin: 0.3,
                filename: '<?= date('Y-m-d') ?>_Admin-QMS-Report.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };

            html2pdf().set(opt).from(element).save();
        });
    </script>
</body>

</html>
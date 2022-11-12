<?php

require('../php/dbcon.php');


$deduction = $_GET['deduction'];
if ($deduction == 1) {
    // Compute deductions
    $sql = "SELECT SUM(amount) as deductions from deductions";
    $res = mysqli_query($conn, $sql);
    $deductions = $res->fetch_array()['deductions'];
} else {
    $deductions = 0;
}
if ($_GET['bonus'] != '') {
    $bonus = $_GET['bonus'];
} else {
    $bonus = 0;
}
$st = $start = $_GET['start'];
$end = $_GET['end'];

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
            <h3>Employee Payroll</h3>
            <h5>
                from <?= date('F d, Y', strtotime($st)) ?> to <?= date('F d, Y', strtotime($end)) ?></h5>
        </div>

        <table border="1" class="table table-bordered" width="100%">
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
                    <th class="bg-warning text-white">Bonus (₱)</th>
                    <th class=" bg-primary text-white text-nowrap">Net Pay (₱)</th>

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
                                    $sql_dispatch = "SELECT distinct(date) FROM trips WHERE $field = $emp AND ( `date` >= '$st' AND `date` <= '$end' ) ";
                                    $r = mysqli_query($conn, $sql_dispatch);
                                    if ($r->num_rows > 0) {
                                        $gross = 350;
                                    } else $gross = 0;
                                    break;
                            }
                            echo '<td>' . $gross . '</td>';

                            $totalGross += $gross;
                        }
                        echo '<td>' . $totalGross . '</td>';
                        echo '<td>' . $deductions . '</td>';
                        echo '<td>' . $bonus . '</td>';
                        echo '<td>' . ($totalGross - $deductions + $bonus) . '</td>';

                        ?>
                    </tr>
                <?php

                }
                ?>

            </tbody>
        </table>
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
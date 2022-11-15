<?php

require('../php/dbcon.php');

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
            font-family: Arial, Helvetica, sans-serif;
            max-width: 8in;
            box-sizing: border-box;
            font-size: 10.5px;
            padding: 6px;
        }


        table tr td {
            vertical-align: middle;
            text-align: end;
            padding: 2px;

        }

        th {
            text-align: start;
        }

        .wrap {
            display: flex;
            flex-wrap: wrap;
        }

        .card {
            width: calc(50% - 54px);
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
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

    <div class="wrap">



        <?php



        $sql = "SELECT a.emp_id, a.firstname, a.middlename, a.lastname, a.type, b.id as adj, b.bonus, b.deduction FROM employees a  LEFT JOIN adjustments b ON a.emp_id = b.user_id ORDER by a.firstname";
        $employees_res = mysqli_query($conn, $sql);
        $count = 1;
        while ($emp_row = $employees_res->fetch_assoc()) {

            if ($emp_row['adj'] === null) {
                $bonus = 0;
                $deductions = 0;
                $conn->query("INSERT INTO `adjustments`( `user_id`, `bonus`, `deduction`) VALUES ($emp,$bonus,$deductions)");
            } else {
                $bonus = $emp_row['bonus'];
                $deductions =  $emp_row['deduction'];
            }



            $emp = $emp_row['emp_id'];

            $e_type = $emp_row['type'];

            if ($e_type == 1) $field = 'driver_id';
            else if ($e_type == 2) $field = 'conductor_id';
            else if ($e_type == 3) $field = 'dispatcher_id';

        ?>
            <div class="card">
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

                    $netpay = $totalGross - $deductions + $bonus;
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
                    <tr class="<?= ($netpay < 0) ? 'bg-danger' : '' ?>">
                        <th>Net Pay</th>
                        <td>
                            <h3>= <?= $netpay ?></h3>
                        </td>
                    </tr>


                </table>
                <div style="text-align: center; margin-bottom: 10px">
                    <h2 style="color: <?= ($netpay < 0) ? 'red' : 'black' ?>">Php <?= $netpay  ?></h2>
                </div>
                <br>
                <h3>Employer Signature: ____________________</h3>
                <br>
                <h3>Employee Signature: ____________________</h3>
                <br>
                <div style="text-align: center; margin-bottom: 10px">
                    <h4>This is a system generated slip.</h4>
                </div>


            </div>
        <?php
            if ($count == 4) {
                echo '<div class="html2pdf__page-break" style="width: 100%"></div>';
                $count = 1;
            } else {
                $count++;
            }
        }


        ?>
    </div>
    <script src="../partials/html2pdf.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // code... 
            // window.print();
            var element = document.getElementById('element-to-print');
            var opt = {
                pagebreak: {
                    mode: 'legacy'
                },
                margin: 0,
                filename: '<?= date('Y-m-d') ?>_alutransco_payroll.pdf',
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
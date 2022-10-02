<?php
require('php/dbcon.php');

$id = $_GET['id'];

$sql = "SELECT * FROM employees WHERE emp_id = $id";
$res = mysqli_query($conn, $sql);

if ($res->num_rows > 0) {
    $emp = $res->fetch_assoc();

    extract($emp);
} else {
    header("Location: payroll");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('partials/_head.php') ?>
    <title>ALUTRANSCO - Trips</title>
</head>

<body>
    <?php include('partials/_nav.php') ?>

    <div class="container pt-5">

        <div class="row">
            <div class="col-md-3 col-sm-12 col-12">
                <a href="payroll" class="text-decoration-none"><i class="fas fa-arrow-left"></i> Go back</a>
                <div class="display-5 fw-bold">Payroll</div>
                <div class="h3 fw-semi"><?= $lastname . ', ' . $firstname ?></div>
                <hr>
                <form action="" id="compute-form">
                    <input type="hidden" id="emp" value="<?= $emp_id ?>">
                    <input type="hidden" id="e_type" value="<?= $type ?>">
                    <div class="menu">
                        <div class="h6 fw-semi">Date Range</div>
                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; border-radius: 10px">
                            <i class="fa fa-calendar"></i>&nbsp;
                            <span></span>
                            <!-- <i class="fa fa-caret-down"></i> -->
                        </div>

                        <hr>
                        <div class="h6 fw-semi">Deduction</div>
                        <select name="deduction" id="deduction" class="form-select mb-3">
                            <option value="1">Yes</option>
                            <option value="2" selected>No</option>
                        </select>
                        <div class="h6 fw-semi">Bonus</div>
                        <input type="number" name="bonus" id="bonus" class="form-control mb-3" placeholder="Php" value="">
                        <!-- <hr>
                        <button type="submit" class="h6 py-3 fw-bold">Compute Pay<i class="fas fa-calculator float-end"></i></i></button> -->

                    </div>
                </form>

            </div>
            <div class="col-md-9 col-sm-12 col-12">



                <div class="card main">
                    <div class="card-body p-4" id="computations">

                    </div>
                </div>
            </div>
        </div>

    </div>








    <?php include('partials/_foot.php') ?>
    <script>
        var start = moment().subtract(6, 'days');
        var end = moment();

        var s, e;

        $("#deduction").change(function() {
            cb(s, e);
        });
        $("#bonus").keyup(function() {
            cb(s, e);
        });

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
            s = start;
            e = end;
            $.ajax({
                type: "POST",
                url: "ajax/compute",
                data: {
                    e_type: $("#e_type").val(),
                    start: start.format('YYYY-MM-DD'),
                    end: end.format('YYYY-MM-DD'),
                    emp: $("#emp").val(),
                    deduction: $("#deduction").val(),
                    bonus: $("#bonus").val()
                },
                success: function(data) {
                    $("#computations").html(data);
                }
            });
        }

        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);
    </script>
    </script>
</body>

</html>
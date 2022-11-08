<?php
require('php/dbcon.php');
if (!isset($_SESSION['user'])) {
    header('Location: login');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('partials/_head.php') ?>
    <title>ALUTRANSCO</title>
    <style>
        table tr td {
            vertical-align: middle;
            text-align: end;
        }
    </style>
</head>

<body>
    <?php include('partials/_nav.php') ?>

    <div class="container pt-5">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
                <div class="d-flex flex-md-row flex-sm-column flex-column justify-content-between">
                    <div class="me-3">
                        <a href="payroll" class="text-decoration-none"><i class="fas fa-arrow-left"></i> Go back</a>
                        <div class="h3 fw-bold">All Payroll</div>
                    </div>
                    <div>
                        <form action="" id="compute-form">

                            <div class="menu">
                                <div class="d-flex flex-md-row flex-sm-column flex-column ">
                                    <div class="me-2">
                                        <div class="h6 fw-semi">Date Range</div>
                                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; border-radius: 10px">
                                            <i class="fa fa-calendar"></i>&nbsp;
                                            <span></span>
                                            <!-- <i class="fa fa-caret-down"></i> -->
                                        </div>
                                    </div>
                                    <div class="me-2">
                                        <div class="h6 fw-semi">Deduction</div>
                                        <select name="deduction" id="deduction" class="form-select mb-3">
                                            <option value="1">Yes</option>
                                            <option value="2" selected>No</option>
                                        </select>
                                    </div>
                                    <div class="me-2">

                                        <div class="h6 fw-semi">Bonus</div>
                                        <input type="number" name="bonus" id="bonus" class="form-control mb-3" placeholder="Php" value="">
                                    </div>
                                    <div>
                                        <button type="button" id="printall" class="h6 py-3 fw-bold h-100">Print All <i class="fas fa-calculator ms-2"></i></i></button>
                                    </div>
                                </div>




                                <!-- <hr>
    <button type="submit" class="h6 py-3 fw-bold">Compute Pay<i class="fas fa-calculator float-end"></i></i></button> -->

                            </div>
                        </form>
                    </div>
                </div>




            </div>
            <div class="col-md-12 col-sm-12 col-12">



                <div class="card ">
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
        $("#printall").click(function() {
            cb(s, e, true);
        });

        function cb(start, end, print) {
            $('#reportrange span').html(start.format('MMM D, YYYY') + ' - ' + end.format('MMM D, YYYY'));
            s = start;
            e = end;
            const days = (date_1, date_2) => {
                let difference = date_1 - date_2;
                let TotalDays = Math.ceil(difference / (1000 * 3600 * 24));
                return TotalDays;
            }



            if (days(e, s) > 7) {
                alert('Please select 7 days only');
            } else {
                console.log("Start: " + start.format('YYYY-MM-DD'));
                console.log("End: " + end.format('YYYY-MM-DD'));

                if (print) {
                    st = start.format('YYYY-MM-DD');
                    en = end.format('YYYY-MM-DD');
                    window.location.href = `print/all_payroll?start=${st}&end=${en}&deduction=${$("#deduction").val()}&bonus=${$("#bonus").val()}`;
                } else {
                    $.ajax({
                        type: "POST",
                        url: "ajax/compute_all",
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


            }

        }


        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end
        }, cb);

        cb(start, end);
    </script>
    </script>
</body>

</html>
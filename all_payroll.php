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
        table tr td,
        table tr th {
            vertical-align: middle;
            text-align: end;
            font-size: 14px;
            padding: 3px 5px !important;
        }
    </style>
</head>

<body>
    <?php include('partials/_nav.php') ?>

    <div class="container pt-3">

        <div class="row">
            <div class="col-md-12 col-sm-12 col-12">
                <div class="d-flex flex-md-row flex-sm-column flex-column justify-content-">
                    <div class="me-3">
                        <!-- <a href="payroll" class="text-decoration-none"><i class="fas fa-arrow-left"></i> Go back</a> -->
                        <div class="h3 fw-bold">All Payroll</div>
                    </div>
                    <div>
                        <form id="compute-form">

                            <div class="menu">
                                <div class="d-flex flex-md-row flex-sm-column flex-column ">
                                    <div class="me-3">
                                        <div class="h6 fw-semi">Date Range</div>
                                        <div id="reportrange" class="mb-2" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%; border-radius: 10px">
                                            <i class="fa fa-calendar"></i>&nbsp;
                                            <span></span>
                                            <!-- <i class="fa fa-caret-down"></i> -->
                                        </div>
                                    </div>
                                    <div class="me-3">
                                        <div class="h6 fw-semi">Deduction (All)</div>
                                        <select name="deduction" id="deduction" class="form-select mb-3">
                                            <option value="1">Yes</option>
                                            <option value="2" selected>No</option>
                                        </select>
                                    </div>
                                    <div class="me-3">

                                        <div class="h6 fw-semi">Bonus (All)</div>
                                        <input type="number" min="0" name="bonus" id="bonus" class="form-control mb-3" placeholder="Php" value="">
                                    </div>
                                    <div class="me-2">
                                        <div class="h6">.</div>
                                        <button type="button" id="fetch" class="btn btn-primary h6 fw-bold py-2">Calculate <i class="fas fa-calculator ms-2"></i></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="ms-auto">
                        <div class="h6">.</div>
                        <button type="button" id="printall" class="btn btn-primary h6 fw-bold w-md-auto w-sm-100 w-100">Print All <i class="fas fa-calculator ms-2"></i></i></button>
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

        // $("#deduction").change(function() {
        //     cb(s, e);
        // });
        // $("#bonus").keyup(function() {
        //     cb(s, e);
        // });
        $("#fetch").click(function() {
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
                    window.open(`print/all_payroll?start=${st}&end=${en}&deduction=${$("#deduction").val()}&bonus=${$("#bonus").val()}`, '_blank');
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
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Payroll calculated',
                                showConfirmButton: false,
                                timer: 1000
                            })
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
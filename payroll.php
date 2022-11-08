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
    <title>ALUTRANSCO - Payroll</title>
</head>

<body>
    <?php include('partials/_nav.php') ?>

    <div class="container pt-5">

        <div class="row">
            <div class="col-md-3 col-sm-12 col-12">
                <div class="display-5 fw-bold mb-4">Payroll</div>
                <div class="menu">

                    <a class="h6 py-3" href="all_payroll">View all Payroll <i class="fas fa-chevron-circle-right float-end"></i></a>

                </div>

                <!-- <div class="menu">
             <dib class="h6 fw-semi">Start Date</dib>
                <input type="date" id="filter-date" class="form-control mb-3" value="<?= date('Y-m-d') ?>">
                <dib class="h6 fw-semi">End Date</dib>
                <input type="date" id="filter-date" class="form-control mb-3" value="<?= date('Y-m-d') ?>">
            
             </div> -->


            </div>
            <div class="col-md-9 col-sm-12 col-12">



                <div class="card main">
                    <div class="card-body">
                        <div class="table-responsive" id="ajax-result">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>








    <?php include('partials/_foot.php') ?>
    <script>
        $(document).ready(function() {


            load_data();

            function load_data() {
                $('#ajax-result').load('ajax/employees_payroll', {
                    date: $("#filter-date").val()
                });
            }






        });
    </script>
</body>

</html>
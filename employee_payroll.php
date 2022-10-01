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
                    <input type="hidden" name="emp_id" value="<?= $emp_id ?>">
                    <input type="hidden" name="e_type" value="<?= $type ?>">
                    <div class="menu">
                        <div class="h6 fw-semi">Start Date</div>
                        <input type="date" name="start" class="form-control mb-3" value="<?= date('Y-m-d') ?>">
                        <dib class="h6 fw-semi">End Date</dib>
                        <input type="date" name="end" class="form-control mb-3" value="<?= date('Y-m-d') ?>">
                        <hr>
                        <div class="h6 fw-semi">Deduction</div>
                        <select name="deduction" id="" class="form-select mb-3">
                            <option value="1">Yes</option>
                            <option value="2" selected>No</option>
                        </select>
                        <div class="h6 fw-semi">Bonus</div>
                        <input type="number" name="bonus" class="form-control mb-3" placeholder="Php" value="0">
                        <hr>
                        <button type="submit" class="h6 py-3 fw-bold">Compute Pay<i class="fas fa-calculator float-end"></i></i></button>

                    </div>
                </form>

            </div>
            <div class="col-md-9 col-sm-12 col-12">



                <div class="card main">
                    <div class="card-body p-4">

                    </div>
                </div>
            </div>
        </div>

    </div>








    <?php include('partials/_foot.php') ?>
    <script>
        $("#compute-form").submit(function(e) {
            e.preventDefault();



            console.log($("#compute-form").serialize());
        });
    </script>
</body>

</html>
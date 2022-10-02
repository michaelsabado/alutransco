<?php
require('php/dbcon.php');
if (!isset($_SESSION['user'])) {
    header('Location: login');
}

extract($_SESSION['user']);
$message = "";

if (isset($_POST['submit'])) {
    $n_firstname = $_POST['firstname'];
    $n_lastname = $_POST['lastname'];
    $n_username = $_POST['username'];



    if ($_POST['password'] != "") {
        $n_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE `admin` SET `firstname`='$n_firstname',`lastname`='$n_lastname',`username`='$n_username',`password`='$n_pass' WHERE admin_id = $admin_id";
    } else {
        $sql = "UPDATE `admin` SET `firstname`='$n_firstname',`lastname`='$n_lastname',`username`='$n_username' WHERE admin_id = $admin_id";
    }

    mysqli_query($conn, $sql);
    $message = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Information updated.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';

    $firstname = $n_firstname;
    $lastname = $n_lastname;
    $username = $n_username;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('partials/_head.php') ?>
    <title>ALUTRANSCO - Credentials</title>
</head>

<body>
    <?php include('partials/_nav.php') ?>

    <div class="container pt-5">

        <div class="row">
            <div class="col-md-3 col-sm-12 col-12">
                <div class="display-5 fw-bold mb-4">Credentials</div>



            </div>
            <div class="col-md-9 col-sm-12 col-12">



                <div class="card main">
                    <div class="card-body">
                        <div class="h5 fw-bold">Update Adminstrator Information</div>
                        <?= $message ?>
                        <hr>
                        <form action="" method="post" autocomplete="off">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h6 mt-2 fw-semi">Firstname</div>
                                </div>
                                <div class="col-md-5"><input type="text" class="form-control" name="firstname" value="<?= $firstname ?>" required></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h6 mt-2 fw-semi">Lastname</div>
                                </div>
                                <div class="col-md-5"><input type="text" class="form-control" name="lastname" value="<?= $lastname ?>" required></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h6 mt-2 fw-semi">Username</div>
                                </div>
                                <div class="col-md-5"><input type="text" class="form-control" name="username" value="<?= $username ?>" required></div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <div class="h6 mt-2 fw-semi">New Password</div>
                                    <div class="h6 text-muted fst-italic">6 character above</div>
                                </div>
                                <div class="col-md-5"><input type="password" class="form-control" name="password" placeholder="Leave blank to retain password" onkeyup="validateMe($(this).val())"></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-5 text-end"><button type="submit" name="submit" id="submit-btn" class="btn btn-dark w-100 py-2">Update Information <i class="fas fa-save mt-1 float-end"></i></button></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>








    <?php include('partials/_foot.php') ?>
    <script>
        function validateMe(e) {
            if (e != "") {
                if (e.length < 6) {
                    $("#submit-btn").addClass('disabled');
                } else {
                    $("#submit-btn").removeClass('disabled');
                }
            } else {
                $("#submit-btn").removeClass('disabled');
            }
        }
    </script>
</body>

</html>
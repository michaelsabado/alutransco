<?php
require('php/dbcon.php');

if (isset($_SESSION['user'])) {
    header('Location: index');
}
$username = '';
$message = '';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);

    if ($res->num_rows > 0) {
        $row = $res->fetch_array();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row;
            header("Location: index");
        } else {
            $message = "Incorrect Password";
        }
    } else {
        $message = "Account not found";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('partials/_head.php') ?>
    <title>ALUTRANSCO - Login</title>
</head>

<body class="bg-dark">

    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="card">
            <div class="card-body p-4">

                <form action="" method="post">
                    <div class="text-center mb-3" style="margin-top: -70px">
                        <img class="shadow" src="assets/logo.jpg" height="100" alt="" style="border-radius: 100px">
                    </div>
                    <div class="text-center">
                        <div class=" fw-bold h4" style="letter-spacing: 3px;"> ALUTRANSCO</div>
                        <div class="h6">Payroll System</div>
                    </div>
                    <hr>
                    <div class="text-center text-danger mb-3"><?= $message ?></div>
                    <input type="text" class="form-control mb-3" name="username" placeholder="Username" value="<?= $username ?>" required>
                    <input type="password" class="form-control mb-5" name="password" placeholder="Password" required>

                    <button type="submit" name="submit" class="btn btn-dark w-100 py-2">Login <i class="fas fa-arrow-right float-end mt-1"></i></button>
                </form>
            </div>
        </div>
    </div>










    <?php include('partials/_foot.php') ?>
    <script>

    </script>
</body>

</html>
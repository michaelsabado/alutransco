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
    <title>ALUTRANSCO - Employees</title>
</head>

<body>
    <?php include('partials/_nav.php') ?>

    <div class="container pt-5">

        <div class="row">
            <div class="col-md-3 col-sm-12 col-12">
                <div class="h6">Management</div>
                <div class="display-5 fw-bold mb-4">Employees</div>

                <div class="menu">

                    <a class="h6 py-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Employee <i class="fas fa-plus-circle float-end"></i></a>

                </div>

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



    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="exampleModalLabel">Employee Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="" id="add-form">
                        <input type="hidden" name="type" value="1">
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <div class="h6 pt-2">Firstname</div>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="firstname" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <div class="h6 pt-2">Middlename</div>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="middlename" placeholder="optional">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <div class="h6 pt-2">Lastname</div>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="lastname">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <div class="h6 pt-2">Address</div>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="address">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <div class="h6 pt-2">Contact</div>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="contact">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <div class="h6 pt-2">Type</div>
                            </div>
                            <div class="col-md-7">
                                <select name="e_type" class="form-select" required>
                                    <option value="">- - -</option>
                                    <option value="1">Driver</option>
                                    <option value="2">Conductor</option>
                                    <option value="3">Collector/Dispatcher</option>

                                </select>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button id="close-modal" type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="add-form" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Employee Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="" id="edit-form">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="type" value="2">
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <div class="h6 pt-2">Firstname</div>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="firstname" id="firstname" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <div class="h6 pt-2">Middlename</div>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="middlename" id="middlename" placeholder="optional">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <div class="h6 pt-2">Lastname</div>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="lastname" id="lastname" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-5">
                                <div class="h6 pt-2">Address</div>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="address" id="address">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <div class="h6 pt-2">Contact</div>
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="contact" id="contact">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-5">
                                <div class="h6 pt-2">Type</div>
                            </div>
                            <div class="col-md-7">
                                <select name="e_type" class="form-select" id="e_type" required>
                                    <option value="">- - -</option>
                                    <option value="1">Driver</option>
                                    <option value="2">Conductor</option>
                                    <option value="3">Collector/Dispatcher</option>

                                </select>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer border-0">
                    <button id="close-edit" type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="edit-form" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>




    <?php include('partials/_foot.php') ?>
    <script>
        $(document).ready(function() {


            load_data();

            function load_data() {
                $('#ajax-result').load('ajax/employees', {
                    date: $("#filter-date").val()
                });
            }



            $("#add-form").submit(function(e) {
                e.preventDefault();
                $("#close-modal").click();

                $.ajax({
                    type: 'POST',
                    url: 'php/employee',
                    data: $("#add-form").serialize(),
                    success: function(data) {
                        $("#add-form")[0].reset();
                        if (data == 1) {
                            load_data();
                            Swal.fire(
                                'Success!',
                                'Employee has been added.',
                                'success'
                            )
                        }
                    }
                })
            });


            $("#edit-form").submit(function(e) {
                e.preventDefault();
                $("#close-edit").click();

                $.ajax({
                    type: 'POST',
                    url: 'php/employee',
                    data: $("#edit-form").serialize(),
                    success: function(data) {

                        $("#edit-form")[0].reset();
                        if (data == 1) {
                            load_data();
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'Employee Details Updated',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    }
                })
            });





        });
    </script>
</body>

</html>
<?php
require('php/dbcon.php');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('partials/_head.php')?>
    <title>ALUTRANSCO - Trips</title>
</head>
<body>
<?php include('partials/_nav.php')?>

    <div class="container pt-5">

    <div class="row">
        <div class="col-md-3 col-sm-12 col-12">
             <div class="display-5 fw-bold mb-4">Daily Trips</div>

             <div class="menu">
                <dib class="h6 fw-semi">Filter Date</dib>
                <input type="date" id="filter-date" class="form-control mb-3" value="<?= date('Y-m-d')?>">
                <hr>
                <a  class="h6 py-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add new trip <i class="fas fa-plus-circle float-end"></i></a>
            
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



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="exampleModalLabel">Trip Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="" id="add-form">
            <input type="hidden" name="type" value="1">
        <div class="row mb-2">
            <div class="col-md-5">
                <div class="h6 pt-2">Bus Name</div>
            </div>
            <div class="col-md-7">
                <select name="bus"  class="form-select" required>
                    <option value="">- - -</option>

                    <?php
                    
                    $sql = "SELECT * FROM buses";
                    $res = mysqli_query($conn, $sql);

                    if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                            echo '<option value="'.$row['bus_id'].'">'.$row['bus_name'].'</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-5">
                <div class="h6 pt-2">Driver</div>
            </div>
            <div class="col-md-7">
            <select name="driver"  class="form-select" required>
                    <option value="">- - -</option>
                    <?php
                    
                    $sql = "SELECT * FROM employees WHERE type = 1";
                    $res = mysqli_query($conn, $sql);

                    if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                            echo '<option value="'.$row['emp_id'].'">'.$row['firstname'] . ' ' . $row['lastname'] .'</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-5">
                <div class="h6 pt-2">Conductor</div>
            </div>
            <div class="col-md-7">
            <select name="conductor" class="form-select" required>
                    <option value="">- - -</option>
                    <?php
                    
                    $sql = "SELECT * FROM employees WHERE type = 2";
                    $res = mysqli_query($conn, $sql);

                    if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                            echo '<option value="'.$row['emp_id'].'">'.$row['firstname'] . ' ' . $row['lastname'] .'</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div> <div class="row mb-4">
            <div class="col-md-5">
                <div class="h6 pt-2">Dispatcher</div>
            </div>
            <div class="col-md-7">
            <select name="dispatcher" class="form-select" required>
                    <option value="">- - -</option>
                    <?php
                    
                    $sql = "SELECT * FROM employees WHERE type = 3";
                    $res = mysqli_query($conn, $sql);

                    if($res->num_rows > 0){
                        while($row = $res->fetch_assoc()){
                            echo '<option value="'.$row['emp_id'].'">'.$row['firstname'] . ' ' . $row['lastname'] .'</option>';
                        }
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-5">
                <div class="h6 pt-2">Earnings (Php)</div>
            </div>
            <div class="col-md-7">
                <input type="number" name="earnings" class="form-control">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-5">
                <div class="h6 pt-2">Maintenance (Php)</div>
            </div>
            <div class="col-md-7">
                <input type="number" name="maintenance" class="form-control">
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-5">
                <div class="h6 pt-2">Date</div>
            </div>
            <div class="col-md-7">
                <input type="date" name="date" class="form-control text-center" value="<?= date('Y-m-d')?>">
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




<?php include('partials/_foot.php')?>
<script>
    $(document).ready(function () {
  

        load_data();
        function load_data(){
            $('#ajax-result').load('ajax/trips', {date: $("#filter-date").val()});
        }


       
        $("#add-form").submit(function(e){
            e.preventDefault();
            $("#close-modal").click();
      
            $.ajax({
                type: 'POST',
                url: 'php/trip',
                data: $("#add-form").serialize(),
                success: function(data){
                    $("#add-form")[0].reset();
                    if(data == 1){
                        load_data();
                    }
                }
            })
         });



         $("#filter-date").change(function(){
            load_data();
         });





    });






    
</script>
</body>
</html>
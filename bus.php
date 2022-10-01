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
        <div class="h6">Management</div>
             <div class="display-5 fw-bold mb-4">Buses</div>

             <div class="menu">
              
                <a  class="h6 py-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add new Bus <i class="fas fa-plus-circle float-end"></i></a>
            
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
        <h5 class="modal-title" id="exampleModalLabel">Bus Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="" id="add-form">
            <input type="hidden" name="type" value="1">
        <div class="row mb-2">
            <div class="col-md-5">
                <div class="h6 pt-2">Bus Trade Name</div>
            </div>
            <div class="col-md-7">
               <input type="text" class="form-control" name="busname" required>
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
            $('#ajax-result').load('ajax/buses');
        }


       
        $("#add-form").submit(function(e){
            e.preventDefault();
            $("#close-modal").click();
      
            $.ajax({
                type: 'POST',
                url: 'php/bus',
                data: $("#add-form").serialize(),
                success: function(data){
                    $("#add-form")[0].reset();
                    if(data == 1){
                        load_data();
                    }
                }
            })
         });








    });






    
</script>
</body>
</html>
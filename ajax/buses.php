<?php

require('../php/dbcon.php');





$sql = "SELECT * FROM buses ORDER BY bus_name";

$result = mysqli_query($conn, $sql);




?>
<table id="datatable" class="table table-striped" style="width:100%">
    <thead>
        <tr valign="">
            <th>ID</th>
            <th>Bus Trade Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

        <?php

        if ($result->num_rows > 0) {
            $count = 1;
            while ($row = $result->fetch_assoc()) {


                $params = "'" . $row['bus_id'] . "', " . "'" . $row['bus_name'] . "'";
        ?>
                <tr valign="middle" id="bus_<?= $row['bus_id'] ?>">
                    <td><?= $count ?></td>
                    <td><?= $row['bus_name'] ?></td>
                    <td class="text-nowrap">
                        <button class="btn btn-primary me-1" onclick="load_edit(<?= $params ?>)" data-bs-toggle="modal" data-bs-target="#exampleModal1"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="delete_record(<?= $row['bus_id'] ?>)"><i class="far fa-trash-alt"></i></button>
                    </td>
                </tr>


        <?php
                $count++;
            }
        }



        ?>

    </tbody>

</table>

<script>
    $('#datatable').DataTable();


    function load_edit(id, busname) {

        $("#id").val(id);
        $("#busname").val(busname);



    }

    function delete_record(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: 'php/bus',
                    data: {
                        id: id,
                        type: 3
                    },
                    success: function(data) {
                        if (data == 1) {
                            $("#bus_" + id).remove();
                            Swal.fire(
                                'Deleted!',
                                'Bus has been deleted.',
                                'success'
                            )
                        }
                    }
                })

            }
        })
    }
</script>
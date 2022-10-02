<?php

require('../php/dbcon.php');





$sql = "SELECT * FROM deductions";

$result = mysqli_query($conn, $sql);




?>
<table id="datatable" class="table table-striped" style="width:100%">
    <thead>
        <tr valign="">
            <th>ID</th>
            <th>Description</th>
            <th class="text-center">Amount (Php)</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>

        <?php

        if ($result->num_rows > 0) {
            $count = 1;
            while ($row = $result->fetch_assoc()) {

                $params = "'" . $row['deduc_id'] . "', " . "'" . $row['description'] . "', " . "'" . $row['amount'] . "'";

        ?>
                <tr valign="middle" id="deduc_<?= $row['deduc_id'] ?>">
                    <td><?= $count ?></td>
                    <td><?= $row['description'] ?></td>
                    <td class="text-center"><?= number_format($row['amount'], 2) ?></td>
                    <td class="text-nowrap text-center">
                        <button class="btn btn-primary me-1" onclick="load_edit(<?= $params ?>)" data-bs-toggle="modal" data-bs-target="#exampleModal1"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="delete_record(<?= $row['deduc_id'] ?>)"><i class="far fa-trash-alt"></i></button>
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

    function load_edit(id, description, amount) {

        $("#id").val(id);
        $("#description").val(description);
        $("#amount").val(amount);


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
                    url: 'php/deduction',
                    data: {
                        id: id,
                        type: 3
                    },
                    success: function(data) {
                        if (data == 1) {
                            $("#deduc_" + id).remove();
                            Swal.fire(
                                'Deleted!',
                                'Deduction has been deleted.',
                                'success'
                            )
                        }
                    }
                })

            }
        })
    }
</script>
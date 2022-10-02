<?php

require('../php/dbcon.php');





$sql = "SELECT * FROM employees   ORDER BY type, firstname";

$result = mysqli_query($conn, $sql);




?>
<table id="datatable" class="table table-striped" style="width:100%">
    <thead>
        <tr valign="">
            <th>ID</th>
            <th>Full Name</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

        <?php

        if ($result->num_rows > 0) {
            $count = 1;
            while ($row = $result->fetch_assoc()) {


                if ($row['type'] == 1) $type = '<span class="badge text-bg-success">Driver</span>';
                else if ($row['type'] == 2) $type = '<span class="badge text-bg-secondary">Conductor</span>';
                else if ($row['type'] == 3) $type = '<span class="badge text-bg-warning">Dispatcher</span>';

                $params = "'" . $row['emp_id'] . "', " . "'" . $row['firstname'] . "', " . "'" . $row['middlename'] . "', " . "'" . $row['lastname'] . "', " . "'" . $row['address'] . "', " . "'" . $row['contact'] . "', " . "'" . $row['type'] . "'";
        ?>
                <tr valign="middle" id="emp_<?= $row['emp_id'] ?>">
                    <td><?= $count ?></td>
                    <td><?= $row['firstname'] . ' ' . $row['lastname'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['contact'] ?></td>
                    <td><?= $type ?></td>
                    <td class="text-nowrap">
                        <button class="btn btn-primary me-1" onclick="load_edit(<?= $params ?>)" data-bs-toggle="modal" data-bs-target="#exampleModal1"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="delete_record(<?= $row['emp_id'] ?>)"><i class="far fa-trash-alt"></i></button>
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

    function load_edit(id, firstname, middlename, lastname, address, contact, type) {

        $("#id").val(id);
        $("#firstname").val(firstname);
        $("#middlename").val(middlename);
        $("#lastname").val(lastname);
        $("#address").val(address);
        $("#contact").val(contact);
        $("#e_type").val(type);



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
                    url: 'php/employee',
                    data: {
                        id: id,
                        type: 3
                    },
                    success: function(data) {
                        if (data == 1) {
                            $("#emp_" + id).remove();
                            Swal.fire(
                                'Deleted!',
                                'Employee has been deleted.',
                                'success'
                            )
                        }
                    }
                })

            }
        })
    }
</script>
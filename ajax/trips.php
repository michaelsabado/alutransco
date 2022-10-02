<?php

require('../php/dbcon.php');




$date = $_POST['date'];

$sql = "SELECT *,CONCAT(c.firstname , ' ' , c.lastname) as driver,CONCAT(d.firstname , ' ' , d.lastname) as conductor,CONCAT(e.firstname , ' ' , e.lastname) as dispatcher FROM trips a INNER JOIN buses b ON a.bus_id = b.bus_id INNER JOIN employees c ON a.driver_id = c.emp_id  INNER JOIN employees d ON a.conductor_id = d.emp_id INNER JOIN employees e ON a.dispatcher_id = e.emp_id WHERE a.date = '$date' ORDER BY date";

$result = mysqli_query($conn, $sql);




?>
<table id="datatable" class="table table-striped" style="width:100%">
    <thead>
        <tr valign="">
            <th>ID</th>
            <th>Bus</th>
            <th>Driver</th>
            <th>Conductor</th>
            <th>Dispatcher</th>
            <th>Earnings (Php)</th>
            <th>Maintenance (Php)</th>
            <th>Total (Php)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>

        <?php

        if ($result->num_rows > 0) {
            $count = 1;
            while ($row = $result->fetch_assoc()) {

                $params = "'" . $row['trip_id'] . "', " . "'" . $row['bus_id'] . "', " . "'" . $row['driver_id'] . "', " . "'" . $row['conductor_id'] . "', " . "'" . $row['dispatcher_id'] . "', " . "'" . $row['earnings'] . "', " . "'" . $row['maintenance'] . "', " . "'" . $row['date'] . "', ";
        ?>
                <tr valign="middle" id="trip_<?= $row['trip_id'] ?>">
                    <td><?= $count ?></td>
                    <td><?= $row['bus_name'] ?></td>
                    <td><?= $row['driver'] ?></td>
                    <td><?= $row['conductor'] ?></td>
                    <td><?= $row['dispatcher'] ?></td>
                    <td class="text-end"><?= number_format($row['earnings'], 2) ?></td>
                    <td class="text-end">- <?= number_format($row['maintenance'], 2) ?></td>
                    <td class="text-end"><?= number_format($row['earnings'] - $row['maintenance'], 2) ?></td>
                    <td class="text-nowrap">
                        <button class="btn btn-primary me-1" onclick="load_edit(<?= $params ?>)" data-bs-toggle="modal" data-bs-target="#exampleModal1"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-danger" onclick="delete_record(<?= $row['trip_id'] ?>)"><i class="far fa-trash-alt"></i></button>

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

    function load_edit(id, bus, driver, conductor, dispatcher, earnings, maintenance, date) {

        $("#id").val(id);
        $("#bus").val(bus);
        $("#driver").val(driver);
        $("#conductor").val(conductor);
        $("#dispatcher").val(dispatcher);
        $("#earnings").val(earnings);
        $("#maintenance").val(maintenance);
        $("#date").val(date);

        console.log($("#edit-form").serialize());

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
                    url: 'php/trip',
                    data: {
                        id: id,
                        type: 3
                    },
                    success: function(data) {
                        if (data == 1) {
                            $("#trip_" + id).remove();
                            Swal.fire(
                                'Deleted!',
                                'Trip has been deleted.',
                                'success'
                            )
                        }
                    }
                })

            }
        })
    }
</script>
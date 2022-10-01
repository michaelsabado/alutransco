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
                        <tbody >

<?php          

if($result->num_rows > 0){
    $count = 1;
    while($row = $result->fetch_assoc()){


        if($row['type'] == 1) $type = '<span class="badge text-bg-success">Driver</span>';
        else if($row['type'] == 2) $type = '<span class="badge text-bg-secondary">Conductor</span>';
        else if($row['type'] == 3) $type = '<span class="badge text-bg-warning">Dispatcher</span>';

        ?>
        <tr valign="middle">
            <td><?= $count?></td>
            <td><?= $row['firstname'] . ' ' . $row['lastname']?></td>
            <td><?= $row['address']?></td>
            <td><?= $row['contact']?></td>
            <td><?= $type?></td>
            <td class="text-nowrap">      
                <button class="btn btn-primary me-1"><i class="fas fa-edit"></i></button>
                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
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
</script>
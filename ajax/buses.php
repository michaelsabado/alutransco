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
                        <tbody >

<?php          

if($result->num_rows > 0){
    $count = 1;
    while($row = $result->fetch_assoc()){


    
        ?>
        <tr valign="middle">
            <td><?= $count?></td>
            <td><?= $row['bus_name']?></td>
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
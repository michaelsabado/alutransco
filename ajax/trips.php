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
                        <tbody >

<?php          

if($result->num_rows > 0){
    $count = 1;
    while($row = $result->fetch_assoc()){
        ?>
        <tr valign="middle">
            <td><?= $count?></td>
            <td><?= $row['bus_name']?></td>
            <td><?= $row['driver']?></td>
            <td><?= $row['conductor']?></td>  
            <td><?= $row['dispatcher']?></td>
            <td class="text-end"><?= number_format($row['earnings'],2)?></td>
            <td class="text-end"><?= number_format($row['maintenance'],2)?></td>
            <td class="text-end"><?= number_format($row['earnings'] - $row['maintenance'],2)?></td>
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
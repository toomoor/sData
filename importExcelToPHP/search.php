<?php include_once("../crud.php");
$connection = new CRUD();

if(isset($_POST['search']) && $_POST['tableSelect']){
    $search = $_POST['search'];
    $table = $_POST['tableSelect'];

    $cTable = $connection->getColumnsName($table);

$where = array(
    $cTable[1]['Field'] => $search,
    $cTable[2]['Field'] => $search,
);
$result = $connection->search($table,$where);

if(count($result) > 0){
    foreach ($result as $key => $value) {?>
        <tr>
            <td><?= $value[$cTable[0]['Field']] ?></td>
            <td><?= $value[$cTable[1]['Field']] ?></td>
            <td><?= $value[$cTable[2]['Field']] ?></td>
            <td>
            <!--<div class="btn-group btn-group-lg">
                <a onclick="return confirm('Are you sure you want to delete')" class="btn btn-danger" href="?delete_id=#">Delete</a>
                <a class="btn btn-warning" href="update.php?id=#">Update</a>
                
            </div>-->
            </td>
        </tr>
<?php
    }
}else{ ?>
Data Not Found...
<?php }
}elseif(empty($_POST['search']) && isset($_POST['tableSelect'])){
    $table = $_POST['tableSelect'];
    $result = $connection->Read($table);

    $cTable = $connection->getColumnsName($table);

    if(count($result) > 0){
        foreach ($result as $key => $value) {?>
            <tr>
                <td><?= $value[$cTable[0]['Field']] ?></td>
                <td><?= $value[$cTable[1]['Field']] ?></td>
                <td><?= $value[$cTable[2]['Field']] ?></td>
                <td>
                <!--<div class="btn-group btn-group-lg">
                    <a onclick="return confirm('Are you sure you want to delete')" class="btn btn-danger" href="?delete_id=#">Delete</a>
                    <a class="btn btn-warning" href="update.php?id=#">Update</a>
                    
                </div>-->
                </td>
            </tr>
    <?php
        }
    }
}?>
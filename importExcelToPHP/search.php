<?php include_once("../crud.php");
$connection = new CRUD();

if(isset($_POST['search']) && $_POST['tableSelect']){
    $search = $_POST['search'];
    $table = $_POST['tableSelect'];

$where = array(
    $table."_fname" => $search,
    $table."_lname" => $search,
);
$result = $connection->search($table,$where);

if(count($result) > 0){
    foreach ($result as $key => $value) {?>
        <tr>
            <td><?= $value[$table."_id"] ?></td>
            <td><?= $value[$table."_fname"] ?></td>
            <td><?= $value[$table."_lname"] ?></td>
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

    if(count($result) > 0){
        foreach ($result as $key => $value) {?>
            <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['fname'] ?></td>
                <td><?= $value['lname'] ?></td>
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
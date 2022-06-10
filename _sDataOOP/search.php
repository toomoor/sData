<?php include_once("crud.php");
$connection = new CRUD();
$table = "userdata";
if(isset($_POST['search'])){
    $search = $_POST['search'];

$where = array(
    "fname" => $search,
    "lname" => $search,
);
$result = $connection->search($table,$where);

if(count($result) > 0){
    foreach ($result as $key => $value) {?>
        <tr>
            <td><?= $value['id'] ?></td>
            <td><?= $value['fname'] ?></td>
            <td><?= $value['lname'] ?></td>
            <td><?= $value['pnum'] ?></td>
            <td>
            <div class="btn-group btn-group-lg">
                <a onclick="return confirm('Are you sure you want to delete')" class="btn btn-danger" href="?delete_id=<?= $value['id'] ?>">Delete</a>
                <a class="btn btn-warning" href="update.php?id=<?= $value['id'] ?>">Update</a>
                
            </div>
            </td>
        </tr>
<?php
    }
}else{ ?>
Data Not Found...
<?php }
}elseif(empty($_POST['search'])){
    $result = $connection->Read($table);

    if(count($result) > 0){
        foreach ($result as $key => $value) {?>
            <tr>
                <td><?= $value['id'] ?></td>
                <td><?= $value['fname'] ?></td>
                <td><?= $value['lname'] ?></td>
                <td><?= $value['pnum'] ?></td>
                <td>
                <div class="btn-group btn-group-lg">
                    <a onclick="return confirm('Are you sure you want to delete')" class="btn btn-danger" href="?delete_id=<?= $value['id'] ?>">Delete</a>
                    <a class="btn btn-warning" href="update.php?id=<?= $value['id'] ?>">Update</a>
                    
                </div>
                </td>
            </tr>
    <?php
        }
    }
}?>
<?php include_once("../crud.php");
$connection = new CRUD();

if(isset($_POST['tableSelect'])){
    $table = $_POST['tableSelect'];

    $result = $connection->Read($table);

    $rColumns = $connection->getColumnsName($table);

    if(count($result) > 0){
        $i=0;
        foreach ($result as $key => $value) {?>
            <tr>
                <td><?= $value[$rColumns[0]["Field"]]?></td>
                <td><?= $value[$rColumns[1]["Field"]]?></td>
                <td><?= $value[$rColumns[2]["Field"]]?></td>
                <td> </td>
            </tr>
<?php
        }
    }else{ 
?>
        Data Not Found...
<?php 
    }
}
?>
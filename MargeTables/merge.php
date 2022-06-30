<?php include_once('../crud.php');
$connection = new CRUD();

if(isset($_POST['table1']) && $_POST['table2']){
    $table1 = $_POST['table1'];
    $table2 = $_POST['table2'];
    
    $mergeName = $connection->MergeTable($table1, $table2);
    $rColumns = $connection->getColumnsName($mergeName);

    $connection->DropDuplicate($mergeName);
    $result = $connection->Read($mergeName);

    if(count($result) > 0){
        foreach($result as $value){
    ?>
            <tr>
                <td><?= $value[$rColumns[0]["Field"]]?></td>
                <td><?= $value[$rColumns[1]["Field"]]?></td>
                <td><?= $value[$rColumns[2]["Field"]]?></td>
                <td> </td>
            </tr>
    <?php
        }
    }
}else{
    echo "no data ...";
}
?>
<?php include_once("../crud.php");
$connection = new CRUD();

if(isset($_POST['tableSelect'])){
    $table = $_POST['tableSelect'];

    $result = $connection->Read($table);

    if(count($result) > 0){
        $i=0;
        foreach ($result as $key => $value) {?>
            <tr>
                <td><?= ++$i?></td>
                <td><?= $value['fname']?></td>
                <td><?= $value['lname']?></td>
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
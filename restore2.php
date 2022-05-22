<?php include_once("database.php"); 

$id = $_GET['id'];
if($id != 'all'){
  $sql = "UPDATE userdata SET `action` = '1' WHERE id = $id";
}elseif($id == 'all'){
  $sql = "UPDATE userdata SET `action` = '1'";
}

$result = $con->query($sql);

$sql2 = "SELECT * FROM userdata WHERE `action` = '0'";
$result2 = $con->query($sql2);


//echo "Record updated successfully";
if($result2->num_rows >= 1){
  header("Location: restore.php");
}else{
  header("Location: index.php");
}
?>
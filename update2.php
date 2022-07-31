<?php include_once("database.php"); 

$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$pnum = $_POST['pnum'];

$sql = "UPDATE userdata SET 
    userdata_fname = '$fname',
    userdata_lname = '$lname',
    userdata_pnum = '$pnum'    
    WHERE userdata_id=$id";

if ($con->query($sql) === TRUE) {
    //echo "Record updated successfully";
    header("Location: index.php");
  } else {
    echo "Error updating record: " . $con->error;
  }
  
  
?>
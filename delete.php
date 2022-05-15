<?php
include_once("database.php");

$id = $_GET['id'];

$sql = "UPDATE userdata SET `action`='0' WHERE id=$id";

if ($con->query($sql) === TRUE) {
  //echo "Record updated successfully";
  header("Location: index.php");
} else {
  echo "Error updating record: " . $con->error;
}

$con->close();
?>
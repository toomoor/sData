<?php
include_once("database.php");

function getData(){
    $data = array();
    $data[1] = $_POST["fname"];
    $data[2] = $_POST["lname"];
    $data[3] = $_POST["pnum"];
    return $data;
}

if(!isset($_POST["insert"])){
    die("POST is not insert.");
}else{
    $info = getData();
}

$sql = "INSERT INTO userdata 
    (userdata_fname, userdata_lname, userdata_pnum, userdata_action)
    VALUES
    ('$info[1]', '$info[2]', '$info[3]', '1')";

if ($con->query($sql) === TRUE) {
  echo "New record created successfully.</br>";
  echo "If you wanna back to list <a href=\"index.php\">Click here.</a>></br>";
  echo "If you wanna make another contact <a href=\"insert.php\">Click here.</a>>";
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();
?>
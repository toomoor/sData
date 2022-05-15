<?php
#defind database info
$host = "localhost";
$username = "boy";
$password = "12345";
$database = "database";

#connecting to mysqli
$con = new mysqli($host, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

  


?>
<?php
#defind database info
$host = "sql110.unaux.com";
$username = "unaux_31726220";
$password = "8bgna7xfc2";
$database = "unaux_31726220_database";

$con = new mysqli($host, $username, $password, $database);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
// Database Structure 
$sql = "CREATE TABLE IF NOT EXISTS names (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(30) NOT NULL,
    lname VARCHAR(30) NOT NULL)";
if($con->query($sql) === TRUE){
    #echo "Table created :)";
}else{
    echo "Error: " . $sql . "<br>" . $con->error;
    die();
}


if(isset($_POST["submit_file"])){
    $file = $_FILES["file"]["tmp_name"];
    $file_open = fopen($file,"r");
    while(! feof($file_open)){
        $csv = fgetcsv($file_open);
        
        $fname = $csv[0];
        $lname = $csv[1];

        $sql = "INSERT INTO names (fname, lname) VALUES ('$fname','$lname')";
        if (($fname == NULL && $lname != NULL) || $fname == TRUE){
            if($con->query($sql) === TRUE){
                #echo "insert into done.";
            }else{
                echo "Error: " . $sql . "<br>" . $con->error;
                die();
            }
        }
    }
}
fclose($file);
header("location:view.php");
?>
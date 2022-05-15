<?php include_once("database.php"); 

$id = $_GET['id'];

$sql = "SELECT * FROM userdata WHERE id=$id";
$result = $con->query($sql);
foreach($result as $row){
$fname = $row['fname'];
$lname = $row['lname'];
$pnum = $row['pnum'];
$con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Viewing <?php echo $fname." ".$lname;?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="insert.html">Add New</a>
      </li>
    </ul>
  </nav>
<div class="container">
  <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="usr">Name:</label>
            <label for="usr"><?php echo $fname." ".$lname;?></label>
        </div>
        <div class="form-group">
            <label for="usr">Phone Number:</label>
            <label for="usr"><?php echo $pnum;?></label>
        </div>
        <div class="form-group">
        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
        <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-primary">Update</a>
        </div>
    </div>
    <div class="col-sm-6">    
    </div>
    
  </div>
</div>

</body>
</html>
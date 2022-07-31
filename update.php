<?php include_once("database.php"); 

$id = $_GET['id'];

$sql = "SELECT * FROM userdata WHERE userdata_id=$id";
$result = $con->query($sql);
foreach($result as $row){
$fname = $row['userdata_fname'];
$lname = $row['userdata_lname'];
$pnum = $row['userdata_pnum'];
$con->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Updating <?php echo $fname." ".$lname;?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include("resource/resource.php"); ?>
</head>
<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="insert.php">Add New</a>
      </li>
    </ul>
  </nav>
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <form method="post" action="update2.php">
          <input type="hidden" name="id" value="<?php echo $id;?>">
        <div class="form-group">
            <label for="usr">First Name:</label>
            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $fname;?>">
        </div>
        <div class="form-group">
            <label for="usr">Last Name:</label>
            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lname;?>">
        </div>
        <div class="form-group">
            <label for="usr">Phone Number:</label>
            <input type="text" class="form-control" id="pnum" name="pnum" value="<?php echo $pnum;?>">
        </div>
        <div class="btn-group">
          <button type="submit" class="btn btn-primary" name="update">Update</button>
        </div>
      </form>
    </div>
    <div class="col-sm-6">    
    </div>
    
  </div>
</div>

</body>
</html>
<?php include_once("crud.php");
$connection = new CRUD();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add New</title>
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
      <li class="nav-item active">
        <a class="nav-link disabled" href="#">Add New</a>
      </li>
    </ul>
  </nav>

  <?php
  if (isset($_POST['insert'])){
      $table = "userdata";
      $fields = array(
          'fname' => $_POST['fname'],
          'lname' => $_POST['lname'],
          'pnum' => $_POST['pnum'],
          'action' => "1",
      );
      $resultData = $connection->Create($table, $fields);
      if($resultData){
          echo "Successfully saved.";
      }else{
          echo "Faild to save.";
      }
  }
  ?>
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <form method="post" action="insert.php">
        <div class="form-group">
            <label for="usr">First Name:</label>
            <input type="text" class="form-control" id="fname" name="fname">
        </div>
        <div class="form-group">
            <label for="usr">Last Name:</label>
            <input type="text" class="form-control" id="lname" name="lname">
        </div>
        <div class="form-group">
            <label for="usr">Phone Number:</label>
            <input type="text" class="form-control" id="pnum" name="pnum">
        </div>
        <div class="btn-group">
          <button type="submit" class="btn btn-primary" name="insert">Insert</button>
        </div>
      </form>
    </div>
    <div class="col-sm-6">
      
    
    </div>
    
  </div>
</div>

</body>
</html>

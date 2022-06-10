<?php include_once("crud.php");
$connection = new CRUD();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Data User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
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
  <?php
      if(isset($_POST['update'])){
          $table = 'userdata';
          $fields = array(
              "fname" => $_POST['fname'],
              "lname" => $_POST['lname'],
              "pnum" => $_POST['pnum'],
          );
          $where = array(
              "id" => $_POST['id'],
          );
          $updateData = $connection->Update($table, $fields, $where);
          if($updateData){
?>
<div class="alert alert-success d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
    Success update.
  </div>
</div>
<?php
              #echo "Success update.";
          }else{
              echo "Error update.";
          }
      }
      ?>

  <?php
  if(isset($_GET['id'])){
      $id = $_GET['id'];
      $where = array(
          "id" => $id,
      );
      $userdata = $connection->ReadWhere('userdata', $where);
      foreach($userdata as $key => $value){
  ?>
  <div class="container">
  <div class="row">
    <div class="col-sm-6">
      <form method="post" action="">
          
        <div class="form-group">
            <label for="usr">First Name:</label>
            <input type="text" class="form-control" id="fname" name="fname" value="<?= $value['fname'] ?>">
            <input type="hidden" name="id" value="<?= $value['id'] ?>">
        </div>
        <div class="form-group">
            <label for="usr">Last Name:</label>
            <input type="text" class="form-control" id="lname" name="lname" value="<?= $value['lname'] ?>">
        </div>
        <div class="form-group">
            <label for="usr">Phone Number:</label>
            <input type="text" class="form-control" id="pnum" name="pnum" value="<?= $value['pnum'] ?>">
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
  <?php
      }
  }
  ?>
</body>
</html>

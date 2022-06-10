<?php include_once("crud.php");
$connection = new CRUD();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome to Phonenote</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <?php $table = 'userdata';
  $where = array(
    "action" => '0',
  );
  $list = $connection->ReadWhere($table, $where);
  ?>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="insert.php">Add New</a>
      </li>
      <?php if(count($list) > 0){
      ?>
      <li class="nav-item active">
        <a class="nav-link disabled" href="restore.php">Restore</a>
      </li>
      <?php }else{ 
          echo "<script>alert('No data')</script>";
          echo "<meta http-equiv='refresh' content='2,url=index.php'>";
      }?>
    </ul>
  </nav>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
    <table class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Phone Number</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php
        
        foreach ($list as $key => $value) {
          if(!($value['action'])){
        ?>
        <tr>
            <td><?= $value['id'] ?></td>
            <td><?= $value['fname'] ?></td>
            <td><?= $value['lname'] ?></td>
            <td><?= $value['pnum'] ?></td>
            <td>
            <div class="btn-group btn-group-lg">
                <a onclick="return confirm('Are you sure you want to restore')" class="btn btn-primary" href="?restore_id=<?= $value['id'] ?>">Restore</a>
            </div>
            </td>
        </tr>
        <?php
          }
        }
        ?>
    </tbody>
  </table>
    </div>    
  </div>
  <div class="row">
  <div class="col-sm-6">
      <!--<h4>Next feature : ...</h4>-->
    
    </div>
  </div>
</div>
<?php
  if(isset($_GET['restore_id'])){
    $restore_id = $_GET['restore_id'];
    $table = 'userdata';
    $fields = array(
        "action" => '1',
    );
    $where = array(
      "id" => $restore_id,
    );
    $restore = $connection->Update($table, $fields, $where);
    if($restore){
      echo "<script>alert('Data has been Restored')</script>";
      echo "<meta http-equiv='refresh' content='2,url=restore.php'>";
    }else{
      echo "Error restore.";
    }
  }
  ?>
</body>
</html>

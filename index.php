<?php include("database.php");
include_once("crud.php");
$connection = new CRUD();

$sql = "SELECT * FROM userdata WHERE `userdata_action` = '1'";
$sql2 = "SELECT * FROM userdata WHERE `userdata_action` = '0'";
$result = $con->query($sql);
$result2 = $con->query($sql2);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome to Phonenote</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include("resource/resource.php"); ?>
</head>
<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link disabled" href="#">List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="insert.php">Add New</a>
      </li>
      <?php
      if ($result2->num_rows > 0) {
      ?>
        <li class="nav-item">
          <a class="nav-link" href="restore.php">Restore</a>
        </li>
      <?php
      }
      ?>
      <li class="nav-item">
        <a class="nav-link" href="importExcelToPHP/import.php">Import</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="MargeTables/">Marge Tables</a>
      </li>
    </ul>
  </nav>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
    <table class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Phone Number</th>
        <th></th>
      </tr>
    </thead>
    <?php
    if ($result->num_rows > 0) {
      // output data of each row
      foreach ($result as $row) {
        ?>
      <tr>
        <td><?= $row["userdata_fname"] ?></td>
        <td><?= $row["userdata_lname"] ?></td>
        <td><?= $row["userdata_pnum"] ?></td>
        <td>
          <div class="btn-group btn-group-lg">
            <a class="btn btn-danger" href="delete.php?id=<?= $row["userdata_id"] ?>">Delete</a>
            <a class="btn btn-primary" href="update.php?id=<?= $row["userdata_id"] ?>">Update</a>
            <a class="btn btn-warning" href="view.php?id=<?= $row["userdata_id"] ?>">View</a>
          </div>
        </td>
      </tr>
        <?php
      }
    }
    ?>
    <tbody>
    </tbody>
  </table>
    </div>    
  </div>
  <div class="row">
  <div class="col-sm-6">
      <!--<h4>Next feature : Import Databases.</h4>-->
    
    </div>
  </div>
</div>

</body>
</html>

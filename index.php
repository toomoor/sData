<?php include("database.php");

$sql = "SELECT * FROM userdata WHERE `action` = '1'";
$sql2 = "SELECT * FROM userdata WHERE `action` = '0'";
$result = $con->query($sql);
$result2 = $con->query($sql2);
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
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link disabled" href="#">List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="insert.html">Add New</a>
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
        <a class="nav-link" href="importExcelToPHP/import.html">Import</a>
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
        <td><?= $row["fname"] ?></td>
        <td><?= $row["lname"] ?></td>
        <td><?= $row["pnum"] ?></td>
        <td>
          <div class="btn-group btn-group-lg">
            <a class="btn btn-danger" href="delete.php?id=<?= $row["id"] ?>">Delete</a>
            <a class="btn btn-primary" href="update.php?id=<?= $row["id"] ?>">Update</a>
            <a class="btn btn-warning" href="view.php?id=<?= $row["id"] ?>">View</a>
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

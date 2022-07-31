<?php include("database.php");

$sql = "SELECT * FROM userdata WHERE `userdata_action` = '0'";
//$sql2 = "SELECT * FROM userdata WHERE action = 0";
$result = $con->query($sql);
//$result2 = $con->query($sql2);
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
      <li class="nav-item">
        <a class="nav-link" href="index.php">List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="insert.php">Add New</a>
      </li>
      <?php
      if ($result->num_rows > 0) {
      ?>
        <li class="nav-item  active">
          <a class="nav-link disabled" href="#">Restore</a>
        </li>
      <?php
      }
      ?>
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
        <th>
          <?php if($result->num_rows >= 2){ ?>
          <a class="btn btn-primary" href="restore2.php?id=all">Restore All</a>
          <?php } ?>
        </th>
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
            <a class="btn btn-primary" href="restore2.php?id=<?= $row["userdata_id"] ?>">Restore</a>
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

<?php 
include("../database.php");
include_once("../crud.php");
$connection = new CRUD();
session_start();
@$tableName = $_SESSION['tablen'];
$tables = $connection->showTables();

if($tableName == NULL){
  $sql = "SELECT * FROM ".$tables[0][0];
  $rColumns = $connection->getColumnsName($tables[0][0]);
}else{
  $sql = "SELECT * FROM $tableName";
  $rColumns = $connection->getColumnsName($tableName);
}

$result = $con->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Import CSV to php</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include("../resource/resource.php"); ?>
</head>
<body>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="../index.php">List</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../insert.php">Add New</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="import.php">Import</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../MargeTables">MargeTables</a>
      </li>
    </ul>
    <div class="form-inline ml-auto">
      <input class="form-control mr-sm-2" type="input" id="search" placeholder="Search.." aria-label="Search" />
      <button class="btn btn-light my-sm-0" id="searchBtn">Search</button>
    </div>
  </nav>
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text">Table Show</label>
        </div>
        <select class="custom-select" id="tableShow">
        <?php
        $i=0;
        if(count($tables) > 0){
          foreach($tables as $option){
        ?>
          <option <?= ($tableName == $option[0]) ? "selected" : ""?> value="<?= $option[0]?>"><?= $option[0]?></option>
        <?php
          }
        }

        ?>
        </select>
      </div>
    </div>
    <div class="col-sm-12">
    <table class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th>#</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th></th>
      </tr>
    </thead>
    <tbody id="show">
      <?php
      if ($result->num_rows > 0) {
        $i=0;
        // output data of each row
        foreach ($result as $row) {
          ?>
        <tr>
          <td><?= $row[$rColumns[0]["Field"]] ?></td>
          <td><?= $row[$rColumns[1]["Field"]] ?></td>
          <td><?= $row[$rColumns[2]["Field"]] ?></td>
          <td>
            <!--<div class="btn-group btn-group-lg">
              <a class="btn btn-danger" href="detele.php?id=#">Delete</a>
              <a class="btn btn-primary" href="update.php?id=#">Update</a>
              <a class="btn btn-warning" href="view.php?id=#">View</a>
            </div>-->
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
        <!--<h4>New feature : Import CSV to php Databases.</h4>
        <h4>Next feature : Import Databases.</h4>-->
    
    </div>
  </div>
</div>

</body>
</html>
<script type="text/javascript">
  $(document).ready(function() {
    $("#tableShow").change(function(){
      var select = $(this).val();
      // alert(select);

      if(select != ""){
        //alert("we go in IF normal");
        $.ajax({
          
          url:"tableLoad.php",
          method:"POST",
          data:{tableSelect:select},

          success:function(data){
            //alert("we go in SUCCESS normal");
            $("#show").html(data);
          },
        });
      }else{
        alert("we don't go in IF normal");
        // $.ajax({
          
        //   url:"search.php",
        //   method:"POST",
        //   data:{search:input},

        //   success:function(data){
        //     $("#show").html(data);
        //   }
        // });
      }
    });
    $("#searchBtn").click(function(){
      var search = $("#search").val();
      var select = $("#tableShow").val();
      //alert(input);

      if(search != ""){
        $.ajax({
          
          url:"search.php",
          method:"POST",
          data:{
            search:search,
            tableSelect:select,
          },

          success:function(data){
            $("#show").html(data);
          }
        });
      }else{
        $.ajax({
          
          url:"search.php",
          method:"POST",
          data:{
            search:search,
            tableSelect:select,
          },

          success:function(data){
            $("#show").html(data);
          }
        });
      }
    });
  });
</script>
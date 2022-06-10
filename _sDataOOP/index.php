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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <?php $table = 'userdata';
  $list = $connection->Read($table);
  $where = array(
    "action" => '0',
  );
  $list2 = $connection->ReadWhere($table, $where);

  ?>
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav md-auto">
        <li class="nav-item active">
          <a class="nav-link disabled" href="#">List</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="insert.php">Add New</a>
        </li>
        <?php if(count($list2) > 0){
        ?>
        <li class="nav-item">
          <a class="nav-link" href="restore.php">Restore</a>
        </li>
        <?php }?>
      </ul>
      <div class="form-inline ml-auto">
      <input class="form-control mr-sm-2" type="input" id="search" placeholder="Search.." aria-label="Search" />
      <button class="btn btn-light my-sm-0" id="searchBtn">Search</button>
      </div>
    </div>
      
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
    <tbody id="show">
        <?php
        
        foreach ($list as $key => $value) {
          if($value['action']){
        ?>
        <tr>
            <td><?= $value['id'] ?></td>
            <td><?= $value['fname'] ?></td>
            <td><?= $value['lname'] ?></td>
            <td><?= $value['pnum'] ?></td>
            <td>
            <div class="btn-group btn-group-lg">
                <a onclick="return confirm('Are you sure you want to delete')" class="btn btn-danger" href="?delete_id=<?= $value['id'] ?>">Delete</a>
                <a class="btn btn-warning" href="update.php?id=<?= $value['id'] ?>">Update</a>
                
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
  if(isset($_GET['delete_id'])){
    $delete_id = $_GET['delete_id'];
    $table = 'userdata';
    $where = array(
      "id" => $delete_id,
    );
    $delete = $connection->Delete($table, $where);
    if($delete){
      echo "<script>alert('Data has been deleted')</script>";
      echo "<meta http-equiv='refresh' content='1,url=index.php'>";
    }else{
      echo "Error delete.";
    }
  }
  ?>
</body>
</html>

<script type="text/javascript">
$(document).ready(function() {
  $("#searchBtn").click(function(){
    var input = $("#search").val();
    //alert(input);

    if(input != ""){
      $.ajax({
        
        url:"search.php",
        method:"POST",
        data:{search:input},

        success:function(data){
          $("#show").html(data);
        }
      });
    }else{
      $.ajax({
        
        url:"search.php",
        method:"POST",
        data:{search:input},

        success:function(data){
          $("#show").html(data);
        }
      });
    }
  });
});
</script>
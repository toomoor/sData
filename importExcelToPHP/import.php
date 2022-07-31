<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add New</title>
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
      <li class="nav-item active">
        <a class="nav-link disabled" href="#">Import</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view.php">View Tables</a>
      </li>
    </ul>
  </nav>
<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <form method="post" action="import_file.php" enctype="multipart/form-data">
        <div class="form-group">
          <label for="usr">Table Name :</label>
          <input type="text" class="form-control" id="tablen" name="tablen">
      </div>
        <div class="form-group">
            <label for="usr">File :</label>
            <input type="file" class="form-control" id="file" name="file">
        </div>
        <div class="btn-group">
          <button type="submit" class="btn btn-primary" name="submit_file">Upload File</button>
        </div>
      </form>
    </div>
    <div class="col-sm-6">
    
    </div>
    
  </div>
</div>

</body>
</html>

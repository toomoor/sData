<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add New</title>
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
      <li class="nav-item active">
        <a class="nav-link disabled" href="#">Add New</a>
      </li>
    </ul>
  </nav>
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

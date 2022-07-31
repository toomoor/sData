<?php
$addr = $_SERVER['PHP_SELF'];
if ($addr == "/_sdata/MargeTables/index.php" ||
$addr == "/_sdata/importExcelToPHP/view.php" ||
$addr == "/_sdata/importExcelToPHP/import.php")
  $addrInd = 1;
else
  $addrInd = 0;
switch($addrInd){
  case 1:
?>
<link rel="stylesheet" href="../resource/bootstrap.min.css" />
  <script src="../resource/jquery-3.6.0.min.js"></script>
  <script src="../resource/popper.min.js"></script>
  <script src="../resource/bootstrap.bundle.min.js"></script>
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
<?php
  break;
  default:
  ?>
  <link rel="stylesheet" href="resource/bootstrap.min.css" />
  <script src="resource/jquery-3.6.0.min.js"></script>
  <script src="resource/popper.min.js"></script>
  <script src="resource/bootstrap.bundle.min.js"></script>
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <?php
}
?>
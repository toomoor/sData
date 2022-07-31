<?php 
include_once("../crud.php");
$connection = new CRUD();

$tables = $connection->showTables();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome to Phonenote</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include("../resource/resource.php"); ?>
  
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
        <a class="nav-link" href="../">List</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link disabled" href="#">Marge Tables</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../importExcelToPHP/view.php">View Tables</a>
      </li>
    </ul>
  </nav>
<div class="container">
  <div class="row">
    <div class="col-sm-5">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text">First Table</label>
            </div>
            <select class="custom-select" id="tableShow1" required>
                <option disabled selected hidden>Select First Table</option>
            <?php
            #$i=0;
            if(count($tables) > 0){
            foreach($tables as $option){
            ?>
                <option value="<?= $option[0]?>">
                    <?= $option[0]?>
                </option>
            <?php
            }
            }
            ?>
            </select>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <label class="input-group-text">Table Show</label>
            </div>
            <select class="custom-select" id="tableShow2" required>
                <option disabled selected hidden>Select Second Table</option>
            <?php
            if(count($tables) > 0){
            foreach($tables as $option){
            ?>
                <option value="<?= $option[0]?>">
                    <?= $option[0]?>
                </option>
            <?php
            }
            }
            ?>
            </select>
        </div>
    </div>
    <div class="col-sm-2">
      <button class="btn btn-primary my-sm-0" id="mergeBtn">Merge</button>
    </div> 
  </div>
  <div class="row">
    <div class="col-sm-12 alert alert-success align-items-center" id="massageShow" hidden>
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
        <use xlink:href="#check-circle-fill"/>
      </svg>
            message show
    </div>
    <div class="col-sm-12">
        <table class="table table-hover" id="mergeTable" hidden>
          <thead class="thead-light">
            <tr>
              <th>#</th>
              <th>Firstname</th>
              <th>Lastname</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="show"></tbody>
        </table>
    </div>
  </div>
</div>
</body>
</html>
<script type="text/javascript">
$(document).ready(function() {
  //<!--#region Selects  -->
      /* store options */
      var $selects = $(".custom-select");
        var $opts = $selects.first().children().clone();

        $selects.change(function () {
          /*create array of all selected values*/    
          var selectedValues=$selects.map(function(){
            var val=$(this).val();
            return val !=0? val :null;
          }).get();

          $selects.not(this).each(function(){

            var $sel=$(this), myVal=$sel.val() ||0;        
            var $options=$opts.clone().filter(function(i){
              var val=$(this).val();         
              return  val==myVal || $.inArray(val, selectedValues) ==-1;
            });
            $sel.html( $options).val( myVal)
          });  

        });

  //<!--#endregion -->
  //<!--#region MergeTables  -->
    $("#mergeBtn").click(function () {
      var tableSelect1 = $("#tableShow1").val();
      var tableSelect2 = $("#tableShow2").val();

      if(tableSelect1 != "" && tableSelect2 != ""){
        $.ajax({
          url: "merge.php", method: "POST",
          data:{
            table1:tableSelect1,
            table2:tableSelect2,
          },
          success:function(data){
            $("#show").html(data);
          },
        });
        $("#massageShow").removeAttr("hidden")
          .show().delay(2000)
          .queue(function(n) {
          $(this).hide(); n();
        });
        $("#mergeTable").removeAttr("hidden");
      }else{
        alert("please select tables for merge");
      }
    });
  //<!--#endregion -->
});
</script>
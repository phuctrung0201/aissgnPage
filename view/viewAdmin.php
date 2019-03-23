<?php
  require 'public/template/header.php';
  if(isset($error)){
    if($error){
      echo "<script>alert('Uncomplete!!!');</script>";
    } else {
      echo "<script>alert('Complete!!!');</script>";
    }
  }
?>
<div id="newTask" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">New Task</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="index.php" method='post'>
            <div>Task</div>
            <input type="text" class="form-control" name='task'/>
            <div>User</div>
            <div class="input-group">
                <input type="text" name="usern" id="" class='form-control'/>
                <div class="input-group-append">
                    <button class='btn btn-success' name='assign'>Assign</button>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-------------End Modal---------->
<div class="container-fluid">
  <div class="row">
    <?php echo $display; ?>
  </div>
</div>
<?php
  
  require 'public/template/pagination.php';
?>
<form id="vegetable-form" class="form-horizontal" method="post">
  <div class="form-group">
    <label for="Name" class="control-label col-md-2">Name</label>
    <div class="col-md-10">
      <input type='text' name="name" value="<?php echo isset($vegetable_row['name']) ? $vegetable_row['name'] : null; ?>" class="form-control" id="name-input">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2"></label>
    <div class="col-md-10">
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span>&nbsp;Update</button>
    </div>
  </div>
</form>
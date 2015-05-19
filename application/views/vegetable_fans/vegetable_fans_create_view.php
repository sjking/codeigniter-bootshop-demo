<form id="vegetable_fans-form" class="form-horizontal" method="post">
  <div class="form-group">
    <label for="Name" class="control-label col-md-2">Name</label>
    <div class="col-md-10">
      <input type='text' name="name" value="" class="form-control" id="name-input">
    </div>
  </div>
  <div class="form-group">
    <label for="Occupation" class="control-label col-md-2">Occupation</label>
    <div class="col-md-10">
      <input type='text' name="occupation" value="" class="form-control" id="occupation-input">
    </div>
  </div>
  <div class="form-group">
    <label for="Favorite Vegetable" class="control-label col-md-2">Favorite Vegetable</label>
    <div class="col-md-10">
      <select name="vegetable_id" class="form-control" id="vegetable-dropdown">
        <?php foreach($vegetable_id_dropdown as $name => $val) { ?>
          <option value="<?php echo $val; ?>"><?php echo $name; ?></option>
        <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2"></label>
    <div class="col-md-10">
      <div class="checkbox">
        <label>
          <input type='hidden' name="vegetarian" value="2">
          <input type='checkbox' name="vegetarian" value="1" id="vegetarian-checkbox">Vegetarian
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <label for="Vegetable Status" class="control-label col-md-2">Vegetable Status</label>
    <div class="col-md-10">
      <?php foreach($vegetable_status_radio as $name => $val) { ?>
        <div class="radio">
          <label>
            <input type='radio' name="vegetable_status" value="<?php echo $val; ?>" id="vegetable_status-radio">
            <?php echo $name; ?>
          </label>
        </div>
      <?php } ?>
    </div>
  </div>
  <div class="form-group">
    <label for="Notes" class="control-label col-md-2">Notes</label>
    <div class="col-md-10">
      <textarea name="notes" class="form-control" id="Notes-textarea" rows="3">
        
      </textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2"></label>
    <div class="col-md-10">
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-check"></span>&nbsp;Create</button>
    </div>
  </div>
</form>
<form id="vegetable_fans-form" class="form-horizontal" method="post">
  <div class="form-group">
    <label for="Name" class="control-label col-md-2">Name</label>
    <div class="col-md-10">
      <input type='text' name="name" value="<?php echo isset($vegetable_fans_row['name']) ? $vegetable_fans_row['name'] : null; ?>" class="form-control" id="name-input">
    </div>
  </div>
  <div class="form-group">
    <label for="Occupation" class="control-label col-md-2">Occupation</label>
    <div class="col-md-10">
      <input type='text' name="occupation" value="<?php echo isset($vegetable_fans_row['occupation']) ? $vegetable_fans_row['occupation'] : null; ?>" class="form-control" id="occupation-input">
    </div>
  </div>
  <div class="form-group">
    <label for="Favorite Vegetable" class="control-label col-md-2">Favorite Vegetable</label>
    <div class="col-md-10">
      <select name="vegetable_id" class="form-control" id="vegetable-dropdown">
        <?php foreach($vegetable_id_dropdown as $name => $val) { ?>
          <option value="<?php echo $val; ?>" <?php echo (isset($vegetable_fans_row['vegetable_id']) && $val == $vegetable_fans_row['vegetable_id']) ? "selected" : null; ?>><?php echo $name; ?></option>
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
          <input type='checkbox' name="vegetarian" value="1" <?php echo (isset($vegetable_fans_row['vegetarian']) && $vegetable_fans_row['vegetarian']== "1") ? "checked" : null; ?> id="vegetarian-checkbox">Vegetarian
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
            <input type='radio' name="vegetable_status" value="<?php echo $val; ?>" id="vegetable_status-radio" <?php echo (isset($vegetable_fans_row['vegetable_status']) && $val == $vegetable_fans_row['vegetable_status']) ? "checked" : null; ?>>
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
        <?php echo $vegetable_fans_row['notes']; ?>
      </textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-2"></label>
    <div class="col-md-10">
      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span>&nbsp;Update</button>
    </div>
  </div>
</form>
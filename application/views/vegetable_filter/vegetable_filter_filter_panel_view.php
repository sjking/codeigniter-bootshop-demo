<div class="img-rounded filter-form-container">
  <form id="vegetable_filter-form" class="form-inline filter-table-form" method="post">
    <div class="form-group">
      <label for="Favorite Vegetable" class="control-label">Favorite Vegetable</label>
      <select name="vegetable_id" class="form-control" id="vegetable-dropdown">
        <?php foreach($vegetable_id_dropdown as $name => $val) { ?>
          <option value="<?php echo $val; ?>" <?php echo (isset($vegetable_filter_row['vegetable_id']) && $val == $vegetable_filter_row['vegetable_id']) ? "selected" : null; ?>><?php echo $name; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label class="control-label"></label>
      <div class="checkbox">
        <label>
          <input type='hidden' name="vegetarian" value="0">
          <input type='checkbox' name="vegetarian" value="1" <?php echo (isset($vegetable_filter_row['vegetarian']) && $vegetable_filter_row['vegetarian']== "1") ? "checked" : null; ?> id="vegetarian-checkbox">Vegetarian
        </label>
      </div>
    </div>
    <div class="form-group">
      <label for="Vegetable Status" class="control-label">Vegetable Status</label>
      <?php foreach($vegetable_status_radio as $name => $val) { ?>
        <div class="radio">
          <label>
            <input type='radio' name="vegetable_status" value="<?php echo $val; ?>" id="vegetable_status-radio" <?php echo (isset($vegetable_filter_row['vegetable_status']) && $val == $vegetable_filter_row['vegetable_status']) ? "checked" : null; ?>>
            <?php echo $name; ?>
          </label>
        </div>
      <?php } ?>
    </div>
    <div class="form-group">
      <label for="Results Per Page" class="control-label">Results Per Page</label>
      <select name="results_per_page" class="form-control" id="results_per_page-dropdown">
        <?php foreach($results_per_page_dropdown as $name => $val) { ?>
          <option value="<?php echo $val; ?>" <?php echo (isset($vegetable_filter_row['results_per_page']) && $val == $vegetable_filter_row['results_per_page'] || isset($results_per_page_default) && $val == $results_per_page_default) ? "selected" : null; ?>><?php echo $name; ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label class="control-label"></label>
      <button type="submit" name="filter-submit" value="submit" class="btn btn-default"><span class="glyphicon glyphicon-filter"></span>&nbsp;Filter</button>
      <button type="submit" name="filter-submit" value="clear" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span>&nbsp;Clear</button>
    </div>
  </form>
</div>
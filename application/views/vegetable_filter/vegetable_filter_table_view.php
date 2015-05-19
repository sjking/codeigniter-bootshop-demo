<table id="vegetable_filter-table" class="list table table-bordered">
  <thead id="sorting-header">
    <th>
      <a href="<?php echo $sort_link; ?>/name"><div id="sort-name" class="sorting-header-container">Name&nbsp;<div class="pull-right"><span class="<?php echo $sort['name']; ?>"></span></div></div></a>
    </th>
    <th>
      <a href="<?php echo $sort_link; ?>/occupation"><div id="sort-occupation" class="sorting-header-container">Occupation&nbsp;<div class="pull-right"><span class="<?php echo $sort['occupation']; ?>"></span></div></div></a>
    </th>
    <th>
      <a href="<?php echo $sort_link; ?>/vegetable_id"><div id="sort-vegetable_id" class="sorting-header-container">Favorite Vegetable&nbsp;<div class="pull-right"><span class="<?php echo $sort['vegetable_id']; ?>"></span></div></div></a>
    </th>
    <th>
      <a href="<?php echo $sort_link; ?>/vegetable_status"><div id="sort-vegetable_status" class="sorting-header-container">Vegetable State&nbsp;<div class="pull-right"><span class="<?php echo $sort['vegetable_status']; ?>"></span></div></div></a>
    </th>
  </thead>
  <tbody>
  <?php
  if ($table_rows) {
  	foreach($table_rows as $row) {
  ?>
  	<tr id="<?php echo $row['Vegetable_filter_model_id']; ?>">
  <?php
  		$id;
  		foreach($row as $key => $val) {
  			if ($key == 'Vegetable_filter_model_id') {
  				$id = $val;
  				continue;
  			}
  ?>
  		<td name="<?php echo $key; ?>" <?php echo $table_col_params[$key]; ?>><?php echo $val; ?></td>
  <?php 	} ?>
  	</tr>
  <?php
  	}
  }
  ?>
  </tbody>
</table>
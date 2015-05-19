<table id="vegetable_fans-table" class="list table table-striped table-hover">
  <thead id="sorting-header">
    <th>
      <a href="<?php echo $sort_link; ?>/name">Name&nbsp;
        <span class="<?php echo $sort['name']; ?>"></span>
      </a>
    </th>
    <th>
      <a href="<?php echo $sort_link; ?>/occupation">Occupation&nbsp;
        <span class="<?php echo $sort['occupation']; ?>"></span>
      </a>
    </th>
    <th></th>
    <th></th>
  </thead>
  <tbody>
  <?php
  if ($table_rows) {
  	foreach($table_rows as $row) {
  ?>
  	<tr id="<?php echo $row['Vegetable_fans_model_id']; ?>">
  <?php
  		$id;
  		foreach($row as $key => $val) {
  			if ($key == 'Vegetable_fans_model_id') {
  				$id = $val;
  				continue;
  			}
  ?>
  		<td name="<?php echo $key; ?>" <?php echo $table_col_params[$key]; ?>><?php echo $val; ?></td>
  <?php 	} ?>
  		<td class="col-xs-1">
  			<a href="<?php echo $view_link;?>/<?php echo $id;?>" class="edit-vegetable_fans btn btn-default btn-xs">
  				<span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit
  			</a>
  		</td>
  		<td class="col-xs-1">
  			<a href="<?php echo $delete_link;?>/<?php echo $id;?>" class="delete-vegetable_fans btn btn-danger btn-xs">
  				<span class="glyphicon glyphicon-remove"></span>&nbsp;Delete
  			</a>
  		</td>
  	</tr>
  <?php
  	}
  }
  ?>
  </tbody>
</table>
<table id="vegetable-table" class="list table table-striped table-hover">
  <thead>
    <th>Name</th>
    <th></th>
    <th></th>
    <th></th>
  </thead>
  <tbody>
  <?php
  if ($table_rows) {
  	foreach($table_rows as $row) {
  ?>
  	<tr id="<?php echo $row['Vegetable_model_id']; ?>">
  
  <?php
  		$id;
  		foreach($row as $key => $val) {
  			if ($key == 'Vegetable_model_id') {
  				$id = $val;
  				continue;
  			}
  ?>
  		<td name="<?php echo $key; ?>" <?php echo $table_col_params[$key]; ?>><?php echo $val; ?></td>
  <?php 	} ?>
  		<td>
  			<div class="btn-group">
  				<a href="<?php echo $order_up_link;?>/<?php echo $id;?>" type="submit" class="btn btn-default btn-xs ordering-btn"><span class="glyphicon glyphicon-chevron-up"></span></a>
  				<a href="<?php echo $order_down_link;?>/<?php echo $id;?>" type="submit" class="btn btn-default btn-xs ordering-btn"><span class="glyphicon glyphicon-chevron-down"></span></a>
  			</div>
  		</td>
  		<td class="col-xs-1">
  			<a href="<?php echo $view_link;?>/<?php echo $id;?>" class="edit-vegetable btn btn-default btn-xs">
  				<span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit
  			</a>
  		</td>
  		<td class="col-xs-1">
  			<a href="<?php echo $delete_link;?>/<?php echo $id;?>" class="delete-vegetable btn btn-danger btn-xs">
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
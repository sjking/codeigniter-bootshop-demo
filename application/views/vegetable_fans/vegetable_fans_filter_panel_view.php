<div id="filter-panel">
	<div id="filter-panel-body" class="container-fluid">
		<form id="vegetable_fans-filter" role="form" method="post">
			<?php foreach($filter_fields as $key => $val) { ?>
				<div class="form-group">
					<div <?php echo $table_col_params[$key]; ?>>
						<label class="sr-only" for="<?php echo $key; ?>-input"><?php echo $key; ?></label>
						<input type="text" class="form-control filter-input" 
							id="<?php echo $key; ?>-input" 
							placeholder="<?php echo $table_col_display_name_map[$key]; ?>" 
							name="<?php echo $key; ?>" 
							value="<?php echo $val; ?>">
					</div>
				</div>
			<?php } ?>
			<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 btn-group" id="filter-button-group">
				<button name="filter-submit" type="submit" class="btn btn-default" value="submit"><span class="glyphicon glyphicon-filter"></span>&nbsp;Filter</button>
				<button name="filter-submit" type="submit" class="btn btn-default" value="clear"><span class="glyphicon glyphicon-remove"></span>&nbsp;Clear</button>
			</div>
		</form>
	</div>
</div>
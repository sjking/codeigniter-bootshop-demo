$(document).ready(function ()
{
	pagination_links();

	var $filter_button;

	$('#vegetable_fans-filter').find('button').on('click', function() {
		$filter_button = $(this);
	});

	$('#vegetable_fans-filter').on('submit', function(event) {
		event.preventDefault();

		var href = $(location).attr('href');
		var $panel = $('#results-panel').find('.results-body');
		$img = $('<img>').attr('src', '/assets/img/loading.gif');
		$img.attr('class', 'loading');
		$panel.empty().html($img);
		var filter_data = $(this).serialize();
		filter_data = filter_data + '&' + $filter_button.attr('name') + '=' + $filter_button.val();

		$.post(href, filter_data, function(data) {
			$panel.html(data.table);
			$('.pagination-links').empty().html(data.links);
			$('#filter-panel').find('.panel-heading').find('strong').text(data.num_records);
			$('.results-count').find('strong').text(data.num_records);

			if ($filter_button.val() == 'clear') {
				$('#vegetable_fans-filter').find('.filter-input').val('');
			}
			pagination_links();
		});
	});
});

function pagination_links()
{
	$('.pagination').find('li').not('.active').find('a').on('click', function(event) {
		event.preventDefault();
		var $page = $(this);
		var href = $page.attr('href');

		var $panel = $('#vegetable_fans-table').parent();
		$img = $('<img>').attr('src', '/assets/img/loading.gif');
		$img.attr('class', 'loading');
		$panel.empty().html($img);

		$.post(href, function(data) {
			$panel.html(data.table);
			$('.pagination-links').empty().html(data.links);
			pagination_links();
		});
	});

	$('#vegetable_fans-table').find('th').find('a').on('click', function(event) {
		event.preventDefault();
		var href = $(this).attr('href');
		var $panel = $('#vegetable_fans-table').parent();

		$.post(href, function(data) {
			$panel.empty().html(data.table);
			$('.pagination-links').empty().html(data.links);
			pagination_links();
		});
	});

	$('a.edit-vegetable_fans').on('click', function(event) {
		// TO-DO:
		// Action to take when edit button clicked
	});

	$('a.delete-vegetable_fans').on('click', function(event) {
		event.preventDefault();
		var href = $(this).attr('href');
		var id = href.substr(href.lastIndexOf('/') + 1);
		$('#universalModal').modal('show');
		$('#universalModal .modal-title').html('Delete Confirm');
		$('#universalModal form').attr('id','delete-vegetable_fans-form');
		$('#universalModal .modal-body')
			.html('Are you sure you want to delete record ' + id + '?');
		$('#universalModal .modal-footer button#submitButton')
			.attr('class', 'btn btn-primary');
		$('#universalModal .modal-footer button#submitButton')
			.html('<span class="glyphicon glyphicon-trash"></span> Delete');

		$('#delete-vegetable_fans-form').on('submit', function(event) {
			event.preventDefault();
			$.post(href, function(resp) {
				if (resp.success) {
					delete_success(resp.msg);
				}
				else {
					delete_failure(resp.msg);
				}
			});
		});
	});
}

function delete_success(id)
{
	$('#universalModal').modal('hide');
	$('#' + id).remove();
}

function delete_failure(msg)
{
	$('#error-alert').show();
	$('#error-alert').find('.alert-msg').text('Error: ' + msg);
	$('#universalModal').modal('hide');
	$('#error-alert').show();
}
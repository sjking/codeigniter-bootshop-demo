$(document).ready(function ()
{
	pagination_links(false);
	ordering(false);

	var $filter_button;
	var filter_is_active = false;

	$('#vegetable-filter').find('button').on('click', function() {
		$filter_button = $(this);
	});

	$('#vegetable-filter').on('submit', function(event) {
		event.preventDefault();

		filter_is_active = true;
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
			$('.results-count').find('strong').text(data.num_records);

			if ($filter_button.val() == 'clear') {
				$('#vegetable-filter').find('.filter-input').val('');
				filter_is_active = false;
			}
			pagination_links(filter_is_active);
			ordering(filter_is_active);
		});
	});

});

function ordering(filter_is_active)
{
	var is_next_page = false;
	var is_prev_page = false;
	var is_last_row = false;
	var is_first_row = false;

	if (!filter_is_active) {
		$('.ordering-btn').on('click', function(event) {
			event.preventDefault();

			var $current_page = $('ul.pagination').find('li.active');
			
			var $prev = $current_page;
			do {
				$prev = $prev.prev();
				is_prev_page = !$prev.hasClass('disabled');
			} while ( !($prev.is(':first-child') || is_prev_page) );
			
			is_next_page = !$current_page.is(':last-child');

			var $current_row = $(this).parent().parent().parent();
			is_last_row = $current_row.is(':last-child');
			is_first_row = $current_row.is(':first-child');

			var href = $(this).attr('href');

			$.post(href, function(resp) {
				if (resp.success) {
					if (href.match('/up/')) {
						if (is_first_row && is_prev_page) {
							$current_row.remove();
						}
						else {
							$current_row.each( function() {
								$(this).insertBefore($(this).prev());
							});
						}
					}
					else {
						if (is_last_row && is_next_page) {
							$current_row.remove();
						}
						else {
							$current_row.each( function() {
								$(this).insertAfter($(this).next());
							});
						}
					}
				}
			});
		});
	}
	else {
		$('.ordering-btn').addClass('disabled');
		$('.ordering-btn').on('click', function(event) {
			event.preventDefault();
		});
	}
}

function pagination_links(filter_is_active)
{
	$('.pagination').find('li').not('.active').find('a').on('click', function(event) {
		event.preventDefault();
		var $page = $(this);
		var href = $page.attr('href');

		var $panel = $('#vegetable-table').parent();
		$img = $('<img>').attr('src', '/assets/img/loading.gif');
		$img.attr('class', 'loading');
		$panel.empty().html($img);

		$.post(href, function(data) {
			$panel.html(data.table);
			$('.pagination-links').empty().html(data.links);
			pagination_links(filter_is_active);
			ordering(filter_is_active);
		});
	});

	$('a.edit-vegetable').on('click', function(event) {
		// TO-DO:
		// Action to take when edit button clicked
	});

	$('a.delete-vegetable').on('click', function(event) {
		event.preventDefault();
		var href = $(this).attr('href');
		var id = href.substr(href.lastIndexOf('/') + 1);
		$('#universalModal').modal('show');
		$('#universalModal .modal-title').html('Delete Confirm');
		$('#universalModal form').attr('id','delete-vegetable-form');
		$('#universalModal .modal-body')
			.html('Are you sure you want to delete record ' + id + '?');
		$('#universalModal .modal-footer button#submitButton')
			.attr('class', 'btn btn-primary');
		$('#universalModal .modal-footer button#submitButton')
			.html('<span class="glyphicon glyphicon-trash"></span> Delete');

		$('#delete-vegetable-form').on('submit', function(event) {
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
$(document).ready(function ()
{
	var $div;
	var sort_id;
	if ($(this).find('span.sorting-descending').length > 0) {
		$div = $(this).find('span.sorting-descending').parent().parent();
		sort_id = $div.attr('id');
	}
	else if ($(this).find('span.sorting-ascending').length > 0) {
		$div = $(this).find('span.sorting-ascending').parent().parent();
		sort_id = $div.attr('id');
	}

	pagination_links(sort_id);

	var $filter_button;

	$('#vegetable_filter-form').find('button').on('click', function() {
		$filter_button = $(this);
	});

	$('#vegetable_filter-form').on('submit', function(event) {
		event.preventDefault();

		var href = $(location).attr('href');
		var $panel = $('#results-panel').find('.results-body');
		var sort_id = $panel.find('.sorting-header-container-selected').attr('id');
		var filter_data = $(this).serialize();
		filter_data = filter_data + '&' + $filter_button.attr('name') + '=' + $filter_button.val();

		$.post(href, filter_data, function(data) {
			$panel.empty().html(data.table);
			$('.pagination-links').empty().html(data.links);
			$('#filter-panel').find('.panel-heading').find('strong').text(data.num_records);
			$('.results-count').find('strong').text(data.num_records);

			if ($filter_button.val() == 'clear') {
				$('#vegetable_filter-form').trigger("reset");
			}
			pagination_links(sort_id);
		});
	});
});

function pagination_links(sort_id)
{
	var $div = $('#' + sort_id);
	$div.addClass('sorting-header-container-selected');

	$('.pagination').find('li').not('.active').find('a').on('click', function(event) {
		event.preventDefault();
		var $page = $(this);
		var href = $page.attr('href');

		var $panel = $('#vegetable_filter-table').parent();
		var sort_id = $panel.find('.sorting-header-container-selected').attr('id');

		$.post(href, function(data) {
			$panel.empty().html(data.table);
			$('.pagination-links').empty().html(data.links);
			pagination_links(sort_id);
		});
	});

	$('#vegetable_filter-table').find('th').find('a').hover(
		function() {
			$container = $(this).find('.sorting-header-container');
			$container.addClass('sorting-header-container-hover');
		}, function() {
			$container = $(this).find('.sorting-header-container');
			$container.removeClass('sorting-header-container-hover');
		}
	);

	$('#vegetable_filter-table').find('th').find('a').on('click', function(event) {
		event.preventDefault();
		var href = $(this).attr('href');
		var $panel = $('#vegetable_filter-table').parent();
		var sort_id = $(this).find('.sorting-header-container').attr('id');

		$.post(href, function(data) {
			$panel.empty().html(data.table);
			$('.pagination-links').empty().html(data.links);
			pagination_links(sort_id);
		});
	});

}
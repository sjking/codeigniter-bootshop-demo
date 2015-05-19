<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vegetable_filter extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

    $this->load->helper('url');
		$this->load->library('session');
	}

	public function index($page = null)
	{
		$this->load->model('Vegetable_filter_model');
		$this->load->library('pagination');

		$data['siteTitle'] 		= "CodeIgniter Bootshop";
		$data['title'] 			= $data['siteTitle'] . ' - Vegetable Fans';
		$data['javaScript'] 	= array('vegetable_filter/vegetable_filter_table.js',
										'alert.js'
									   );
		$data['styleSheets']    = array('alert.css',
										'filter_table.css',
										'filter_form_inline.css'
									   );
		$data['header'] = 'Vegetable Fans';

		$data['controller'] = strtolower('vegetable_filter');
		$data['display_name'] = 'vegetable_filter';

		$data['table_col_params'] = array('name' => 'class="col-lg-3 col-md-3 col-sm-3 col-xs-3"','occupation' => 'class="col-lg-3 col-md-3 col-sm-3 col-xs-3"','vegetable_id' => 'class="col-lg-3 col-md-3 col-sm-3 col-xs-3"','vegetable_status' => 'class="col-lg-3 col-md-3 col-sm-3 col-xs-3"');
		$data['table_col_display_name_map'] = array('name' => 'Name','occupation' => 'Occupation','vegetable_id' => 'Favorite Vegetable','vegetable_status' => 'Vegetable State');

		$data['sort_link'] = base_url($data['controller'] . '/sort');

		$is_filter_request = false;

		if ($this->input->post()) {
			$post_data = $this->input->post(null, true);

			if ($this->input->post('filter-submit') == 'submit') {
				unset($post_data['filter-submit']);
				$this->session->set_userdata('filter_data_vegetable_filter', $post_data);
			}
			else if ($this->input->post('filter-submit') == 'clear') {
				$this->session->unset_userdata('filter_data_vegetable_filter');
			}
			$is_filter_request = true;
		}
		$filter_data = $this->session->userdata('filter_data_vegetable_filter') ? 
			$this->session->userdata('filter_data_vegetable_filter') : null;

		$select_columns = array('vegetable_id', 'vegetarian', 'vegetable_status', 'results_per_page');
		$active_filters = array();
		if ($filter_data) {

			foreach ($select_columns as $col) {
				if (isset($filter_data[$col])) {
					$active_filters[$col] = $filter_data[$col];
				}
			}
		}
		$data['vegetable_filter_row'] = $active_filters;

		$data['vegetable_id_dropdown'] = $this->Vegetable_filter_model->get_vegetable_id_dropdown();
		$data['vegetable_status_radio'] = $this->Vegetable_filter_model->get_vegetable_status_radio();
		$data['results_per_page_dropdown'] = $this->Vegetable_filter_model->get_results_per_page_dropdown();
		$data['results_per_page_default'] = $this->Vegetable_filter_model->get_results_per_page_default();

		// sorting
		$sort_data = $this->session->userdata('vegetable_filter-sort_data');

		$results_per_page = $data['results_per_page_default'];
		if (isset($filter_data['results_per_page'])) {
			$results_per_page = $filter_data['results_per_page'];
			unset($filter_data['results_per_page']);
			$data['vegetable_filter_row']['results_per_page'] = $results_per_page;
			unset($data['results_per_page_default']);
		}

		// Pagination
		$config['base_url'] = base_url() . $data['controller'];
		$config['total_rows'] = $this->Vegetable_filter_model->rowCount($filter_data);
		$config['per_page'] = $results_per_page;
		$this->pagination->initialize($config);
		$data['table_rows'] = $this->Vegetable_filter_model
			->get_rows_pagination($config['per_page'], $page, $filter_data, $sort_data);
		$data['links'] = $this->pagination->create_links();
		$data['number_of_records'] = $config['total_rows'];

		$data['sort'] = array();
		foreach($data['table_col_display_name_map'] as $key => $val) {
			if ($sort_data) {
				if ($sort_data['col'] == $key) {
					switch ($sort_data['order']) {
						case 'ASC': 
							$data['sort'][$key] = 'sorting-ascending';
							break;
						case 'DESC':
							$data['sort'][$key] = 'sorting-descending';
							break;
						default:
							$data['sort'][$key] = 'sorting-disabled';
					}
				}
				else {
					$data['sort'][$key] = 'sorting-disabled';
				}
			}
			else {
				$data['sort'][$key] = 'sorting-disabled';
			}
		}

		if ($this->input->is_ajax_request()) {
			$this->load->helper('ajax_helper');
			$views = array();
			$views['links'] = $data['links'];
			if ($data['number_of_records'] > 0) {
				$views['table'] = $this->load->view('vegetable_filter/vegetable_filter_table_view', $data, true);
			}
			else {
				$views['table'] = 'No Records Found.';
			}
			if ($is_filter_request) {
				$views['num_records'] = $data['number_of_records'] ? $data['number_of_records'] : 0;
			}
			echo ajax_html($views);
		}
		else {
			$this->load->view('header', $data);
			$this->load->view('vegetable_filter/vegetable_filter_view', $data);
			$this->load->view('vegetable_filter/vegetable_filter_filter_panel_view', $data);
			$this->load->view('vegetable_filter/vegetable_filter_panel_header_view', $data);
			$this->load->view('vegetable_filter/vegetable_filter_table_view', $data);
			$this->load->view('vegetable_filter/vegetable_filter_panel_footer_view', $data);
			$this->load->view('universal_modal_view.php');
			$this->load->view('alerts_view.php');
			$this->load->view('footer', $data);
		}
	}

	public function sort($col)
	{
		$sort_data = null;
		$controller = strtolower('vegetable_filter');

		if ($this->session->userdata('vegetable_filter-sort_data')) {
			$sort_data = $this->session->userdata('vegetable_filter-sort_data');
			if ($sort_data['col'] == $col) {
				$sort_data['order'] = $sort_data['order'] == 'ASC' ? 'DESC' : 'ASC';
			}
			else {
				$sort_data['order'] = 'ASC';
				$sort_data['col'] = $col;
			}
			$this->session->unset_userdata('vegetable_filter-sort_data');
		}
		else {
			$sort_data = array();
			$sort_data['col'] = $col;
			$sort_data['order'] = 'ASC';
		}

		$this->session->set_userdata('vegetable_filter-sort_data', $sort_data);

		$to = base_url($controller);
		redirect($to, 'location');
	}


}

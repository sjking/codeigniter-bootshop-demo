<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vegetable_fans extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index($page = null)
	{
		$this->load->model('Vegetable_fans_model');
		$this->load->library('pagination');

		$data['siteTitle'] 		= "CodeIgniter Bootshop";
		$data['title'] 			= $data['siteTitle'] . ' - Vegetable Fans';
		$data['javaScript'] 	= array('vegetable_fans/vegetable_fans_table.js',
										'alert.js'
									   );
		$data['styleSheets']    = array('alert.css',
										'lut_main.css'
									   );
		$data['header'] = 'Vegetable Fans';

		$data['controller'] = strtolower('vegetable_fans');
		$data['create_link'] = base_url($data['controller'] . '/create');
		$data['view_link'] = base_url($data['controller'] . '/view');
		$data['delete_link'] = base_url($data['controller'] . '/delete');
		$data['display_name'] = 'vegetable_fans';

		$data['table_col_params'] = array('name' => 'class="col-lg-2 col-md-2 col-sm-3 col-xs-3"','occupation' => 'class="col-lg-8 col-md-8 col-sm-6 col-xs-6"');
		$data['table_col_display_name_map'] = array('name' => 'Name','occupation' => 'Occupation');

		$data['sort_link'] = base_url($data['controller'] . '/sort');

		$is_filter_request = false;

		if ($this->input->post()) {
			$post_data = $this->input->post(null, true);

			if ($this->input->post('filter-submit') == 'submit') {
				unset($post_data['filter-submit']);
				$this->session->set_userdata('filter_data_vegetable_fans', $post_data);
			}
			else if ($this->input->post('filter-submit') == 'clear') {
				$this->session->unset_userdata('filter_data_vegetable_fans');
			}
			$is_filter_request = true;
		}
		$filter_data = $this->session->userdata('filter_data_vegetable_fans') ? 
			$this->session->userdata('filter_data_vegetable_fans') : null;

		$filter_fields = array_keys($data['table_col_params']);
		$data['filter_fields'] = array();
		foreach($filter_fields as $field) {
			$data['filter_fields'][$field] = $filter_data ? $filter_data[$field] : null;
		}

		// sorting
		$sort_data = $this->session->userdata('sort_data_vegetable_fans');

		// Pagination
		$config['base_url'] = base_url() . $data['controller'];
		$config['total_rows'] = $this->Vegetable_fans_model->rowCount($filter_data);
		$config['per_page'] = 20;
		$this->pagination->initialize($config);
		$data['table_rows'] = $this->Vegetable_fans_model
			->get_rows_pagination($config['per_page'], $page, $filter_data, $sort_data);
		$data['links'] = $this->pagination->create_links();
		$data['number_of_records'] = $config['total_rows'];

		$data['sort'] = array();
		foreach($data['table_col_display_name_map'] as $key => $val) {
			if ($key != 'Vegetable_fans_model_id') {
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
		}

		if ($this->input->is_ajax_request()) {
			$this->load->helper('ajax_helper');
			$views = array();
			$views['links'] = $data['links'];
			if ($data['number_of_records'] > 0) {
				$views['table'] = $this->load->view('vegetable_fans/vegetable_fans_table_view', $data, true);
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
			$this->load->view('vegetable_fans/vegetable_fans_view', $data);
			$this->load->view('vegetable_fans/vegetable_fans_filter_panel_view', $data);
			$this->load->view('vegetable_fans/vegetable_fans_panel_header_view', $data);
			$this->load->view('vegetable_fans/vegetable_fans_table_view', $data);
			$this->load->view('vegetable_fans/vegetable_fans_panel_footer_view', $data);
			$this->load->view('universal_modal_view.php');
			$this->load->view('alerts_view.php');
			$this->load->view('footer', $data);
		}
	}

	public function sort($col)
	{
		$sort_data = null;
		$controller = strtolower('vegetable_fans');

		if ($this->session->userdata('sort_data_vegetable_fans')) {
			$sort_data = $this->session->userdata('sort_data_vegetable_fans');
			if ($sort_data['col'] == $col) {
				$sort_data['order'] = $sort_data['order'] == 'ASC' ? 'DESC' : 'ASC';
			}
			else {
				$sort_data['order'] = 'ASC';
				$sort_data['col'] = $col;
			}
			$this->session->unset_userdata('sort_data_vegetable_fans');
		}
		else {
			$sort_data = array();
			$sort_data['col'] = $col;
			$sort_data['order'] = 'ASC';
		}

		$this->session->set_userdata('sort_data_vegetable_fans', $sort_data);

		$to = base_url($controller);
		redirect($to, 'location');
	}

	public function view($id)
	{
		$this->load->model('Vegetable_fans_model');

		// check if its a post (update)
		if ($update = $this->input->post()) {
			$this->Vegetable_fans_model->update($id, $update);
		}

		$data['siteTitle'] 		= "CodeIgniter Bootshop";
		$data['title'] 			= $data['siteTitle'] . ' - Vegetable Fans';
		$data['javaScript'] 	= array(
									   );
		$data['styleSheets']    = array(
									   );
		
		$data['vegetable_fans_row'] = $this->Vegetable_fans_model->get($id);
		$data['header'] = $data['vegetable_fans_row']['name'];
		$data['detail_id'] = $id;
		$data['controller'] = strtolower('vegetable_fans');
		$data['vegetable_id_dropdown'] = $this->Vegetable_fans_model->get_vegetable_id_dropdown();
		$data['vegetable_status_radio'] = $this->Vegetable_fans_model->get_vegetable_status_radio();

		$this->load->view('header', $data);
		$this->load->view('vegetable_fans/vegetable_fans_detail_header_view', $data);
		$this->load->view('vegetable_fans/vegetable_fans_detail_view', $data);
		$this->load->view('footer', $data);
	}

	public function create()
	{
		$this->load->model('Vegetable_fans_model');

		// check if its a post (create)
		if ($update = $this->input->post()) {
			if ($id = $this->Vegetable_fans_model->create($update)) {
				// redirect to detail view for newly created entry
				$controller = strtolower('vegetable_fans');
				$view = base_url($controller . '/view/' . $id);
				redirect($view, 'refresh');
			}
		}

		$data['siteTitle'] 		= "CodeIgniter Bootshop";
		$data['title'] 			= $data['siteTitle'] . ' - Vegetable Fans';
		$data['javaScript'] 	= array(
									   );
		$data['styleSheets']    = array(
									   );

		$data['header'] = 'Create new vegetable_fans entry.';
		$data['controller'] = strtolower('vegetable_fans');
		$data['vegetable_id_dropdown'] = $this->Vegetable_fans_model->get_vegetable_id_dropdown();
		$data['vegetable_status_radio'] = $this->Vegetable_fans_model->get_vegetable_status_radio();

		$this->load->view('header', $data);
		$this->load->view('vegetable_fans/vegetable_fans_create_header_view', $data);
		$this->load->view('vegetable_fans/vegetable_fans_create_view', $data);
		$this->load->view('footer', $data);
	}

	public function delete($id)
	{
		$this->load->model('Vegetable_fans_model');
		$this->load->helper('url');
		$this->load->helper('ajax_helper');
		$controller = strtolower('vegetable_fans');

		if ($this->Vegetable_fans_model->delete($id)) {
			if ($this->input->is_ajax_request()) {
				echo ajax_success($id);
			}
			else {
				$to = base_url($controller);
				redirect($to, 'refresh');
			}
		}
		else {
			$msg = 'Could not delete record ' . $id . '.';
			if ($this->input->is_ajax_request()) {
				echo ajax_failure($msg);
			}
			else {
				$link = base_url($controller);
				$this->error->error_page($msg, $link);
			}
		}
	}

}

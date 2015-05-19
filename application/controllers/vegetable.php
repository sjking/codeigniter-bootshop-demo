<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vegetable extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index($page = null)
	{
		$this->load->model('Vegetable_model');
		$this->load->library('pagination');

		$data['siteTitle'] 		= "CodeIgniter Bootshop";
		$data['title'] 			= $data['siteTitle'] . ' - Vegetables';
		$data['javaScript'] 	= array('vegetable/vegetable_table.js',
										'alert.js'
									   );
		$data['styleSheets']    = array('alert.css',
										'lut_main.css'
									   );
		$data['header'] = 'Vegetables';

		$data['controller'] = strtolower('vegetable');
		$data['create_link'] = base_url($data['controller'] . '/create');
		$data['view_link'] = base_url($data['controller'] . '/view');
		$data['delete_link'] = base_url($data['controller'] . '/delete');
		$data['display_name'] = 'vegetable';

		$data['order_up_link'] = base_url($data['controller'] . '/re_order/up');
		$data['order_down_link'] = base_url($data['controller'] . '/re_order/down');

		$data['table_col_params'] = array('name' => 'class="col-xs-9"');
		$data['table_col_display_name_map'] = array('name' => 'Name');

		$is_filter_request = false;

		if ($this->input->post()) {
			$post_data = $this->input->post(null, true);

			if ($this->input->post('filter-submit') == 'submit') {
				unset($post_data['filter-submit']);
				$this->session->set_userdata('filter_data_vegetable', $post_data);
			}
			else if ($this->input->post('filter-submit') == 'clear') {
				$this->session->unset_userdata('filter_data_vegetable');
			}
			$is_filter_request = true;
		}
		$filter_data = $this->session->userdata('filter_data_vegetable') ? 
			$this->session->userdata('filter_data_vegetable') : null;

		$filter_fields = array_keys($data['table_col_params']);
		$data['filter_fields'] = array();
		foreach($filter_fields as $field) {
			$data['filter_fields'][$field] = $filter_data ? $filter_data[$field] : null;
		}

		// Pagination
		$config['base_url'] = base_url() . $data['controller'];
		$config['total_rows'] = $this->Vegetable_model->rowCount($filter_data);
		$config['per_page'] = 10;
		$this->pagination->initialize($config);
		$data['table_rows'] = $this->Vegetable_model
			->get_rows_pagination($config['per_page'], $page, $filter_data);
		$data['links'] = $this->pagination->create_links();
		$data['number_of_records'] = $config['total_rows'];

		if ($this->input->is_ajax_request()) {
			$this->load->helper('ajax_helper');
			$views = array();
			$views['links'] = $data['links'];
			if ($data['number_of_records'] > 0) {
				$views['table'] = $this->load->view('vegetable/vegetable_table_view', $data, true);
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
			$this->load->view('vegetable/vegetable_view', $data);
			$this->load->view('vegetable/vegetable_filter_panel_view', $data);
			$this->load->view('vegetable/vegetable_panel_header_view', $data);
			$this->load->view('vegetable/vegetable_table_view', $data);
			$this->load->view('vegetable/vegetable_panel_footer_view', $data);
			$this->load->view('universal_modal_view.php');
			$this->load->view('alerts_view.php');
			$this->load->view('footer', $data);
		}
	}

	public function view($id)
	{
		$this->load->model('Vegetable_model');

		// check if its a post (update)
		if ($update = $this->input->post()) {
			$this->Vegetable_model->update($id, $update);
		}

		$data['siteTitle'] 		= "CodeIgniter Bootshop";
		$data['title'] 			= $data['siteTitle'] . ' - Vegetables';
		$data['javaScript'] 	= array(
									   );
		$data['styleSheets']    = array(
									   );
		
		$data['vegetable_row'] = $this->Vegetable_model->get($id);
		$data['header'] = $data['vegetable_row']['name'];
		$data['detail_id'] = $id;
		$data['controller'] = strtolower('vegetable');
		

		$this->load->view('header', $data);
		$this->load->view('vegetable/vegetable_detail_header_view', $data);
		$this->load->view('vegetable/vegetable_detail_view', $data);
		$this->load->view('footer', $data);
	}

	public function create()
	{
		$this->load->model('Vegetable_model');

		// check if its a post (create)
		if ($update = $this->input->post()) {
			if ($id = $this->Vegetable_model->create($update)) {
				// redirect to detail view for newly created entry
				$controller = strtolower('vegetable');
				$view = base_url($controller . '/view/' . $id);
				redirect($view, 'refresh');
			}
		}

		$data['siteTitle'] 		= "CodeIgniter Bootshop";
		$data['title'] 			= $data['siteTitle'] . ' - Vegetables';
		$data['javaScript'] 	= array(
									   );
		$data['styleSheets']    = array(
									   );

		$data['header'] = 'Create new vegetable entry.';
		$data['controller'] = strtolower('vegetable');
		

		$this->load->view('header', $data);
		$this->load->view('vegetable/vegetable_create_header_view', $data);
		$this->load->view('vegetable/vegetable_create_view', $data);
		$this->load->view('footer', $data);
	}

	public function delete($id)
	{
		$this->load->model('Vegetable_model');
		$this->load->helper('url');
		$this->load->helper('ajax_helper');
		$controller = strtolower('vegetable');

		if ($this->Vegetable_model->delete($id)) {
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

	/* re-order the entry with $id in $direction (up or down)
	 * @param $direction
	 * @param $id
	 */
	public function re_order($direction, $id)
	{
		$controller = strtolower('vegetable');
		$this->load->helper('ajax_helper');

		$this->load->model('Vegetable_model');
		$success = $this->Vegetable_model->re_order($direction, $id);
		$to = base_url($controller);

		if ($success) {
			if ($this->input->is_ajax_request()) {
				echo ajax_success();
			}
			else {
				redirect($to, 'refresh');
			}
		}
		else {
			$msg = 'Could not re-order record ' . $id . '.';
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

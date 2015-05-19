<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vegetable_filter_model extends CI_Model
{


	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	/* returns all entries for table 
	 * @param $id the primary key name of the table
	 */
	function get_rows($id_name)
	{
		$this->db->select('name, occupation, vegetable_id, vegetable_status' . ', ' 
			. 'id as Vegetable_filter_model_id');
		$query = $this->db->get('vegetable_fans');

		return $query->result_array();
	}

	/* Return the count of all records matching select $data, or count of all
	 * rows for the table if $data is null
	 * @param $data
	 */
	function rowCount($data = null)
	{
		$this->db->from('vegetable_fans');
		if ($data) {
			foreach($data as $key => $val) {
				if ($val)
					$this->db->like($key, $val);
			}
		}

		return $this->db->count_all_results();
	}

	/* gets all rows for a pagination page
	 * @param $limit
	 * @param $start
	 * @param $filter_data option filter data
	 * @param $sort_data optional sort data
	 */
	function get_rows_pagination($limit, $start, $filter_data = null, $sort_data = null)
	{
		$this->db->limit($limit, $start);
		$this->db->select('name, occupation, vegetable_id, vegetable_status' . ', ' 
			. 'id as Vegetable_filter_model_id');
		$this->db->from('vegetable_fans');

		if ($filter_data) {
			foreach($filter_data as $key => $val) {
				if ($val)
					$this->db->like($key, $val);
			}
		}
		if ($sort_data) {
			$this->db->order_by($sort_data['col'], $sort_data['order']);
		}

		$query = $this->db->get();

		if ($query->num_rows() > 0)
            return $query->result_array();
        else 
            return false;
	}

	function get_vegetable_id_dropdown()
	{
		$this->db->select('id, name');
		$this->db->from('vegetable');
		$query = $this->db->get();
		$vals = array();
		$vals[""] = "";
		foreach($query->result_array() as $row)
			$vals[trim($row['name'])] = trim($row['id']);
		return $vals;
	}

	function get_vegetable_status_radio()
	{
		$enums = array(
			'Fresh' => 'Fresh',
			'Frozen' => 'Frozen',
			'Canned' => 'Canned',
			'Freeze Dried' => 'Freeze Dried');
		return $enums;
	}

	function get_results_per_page_dropdown()
	{
		$enums = array(
			'10' => '10',
			'20' => '20',
			'50' => '50',
			'100' => '100',
			'200' => '200',
			'all' => 'all');
		return $enums;
	}

	function get_results_per_page_default()
	{
		return '20';
	}

}
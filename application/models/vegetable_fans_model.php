<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vegetable_fans_model extends CI_Model
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
		$this->db->select('name, occupation' . ', ' 
			. 'id as Vegetable_fans_model_id');
		$query = $this->db->get('vegetable_fans');

		return $query->result_array();
	}

	/* Return fields name, occupation, vegetable_id, vegetarian, vegetable_status, notes
	 * from table vegetable_fans with primary key $id
	 * @param $id the primary key name of the table
	 */
	function get($id)
	{
		$this->db->select('name, occupation, vegetable_id, vegetarian, vegetable_status, notes' . ', ' 
			. 'id as Vegetable_fans_model_id');
		$this->db->where('id', $id);
		$query = $this->db->get('vegetable_fans');
		$result = $query->result_array();

		return array_pop($result);
	}

	/* Update field with primary key $id with data $data
	 * @param $id
	 * @param $data
	 */
	function update($id, $data)
	{
		$this->db->where('id', $id);
		$result = $this->db->update('vegetable_fans', $data);
		return $result;
	}

	/* Delete the field with primary key $id 
	 * @param $id
	 */
	function delete($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->delete('vegetable_fans');
		return $result;
	}

	/* Create a new entry with $data data, and return its id
	 * @params $data
	 */
	function create($data)
	{
    $id = isset($data['id']) ? 
    $data['id'] : null;
		
		$this->db->trans_start();
		if($this->db->insert('vegetable_fans', $data)) {
			$id = $id ? $id : $this->db->insert_id();
		}
		else {
			$id = null;
		}
		$this->db->trans_complete();

		return $id;
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
		$this->db->select('name, occupation' . ', ' 
			. 'id as Vegetable_fans_model_id');
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

}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vegetable_model extends CI_Model
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
		$this->db->select('name' . ', ' 
			. 'id as Vegetable_model_id');
		$query = $this->db->get('vegetable');

		return $query->result_array();
	}

	/* Return fields name
	 * from table vegetable with primary key $id
	 * @param $id the primary key name of the table
	 */
	function get($id)
	{
		$this->db->select('name' . ', ' 
			. 'id as Vegetable_model_id');
		$this->db->where('id', $id);
		$query = $this->db->get('vegetable');
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
		$result = $this->db->update('vegetable', $data);
		return $result;
	}

	/* Delete the field with primary key $id 
	 * @param $id
	 */
	function delete($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->delete('vegetable');
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
		if($this->db->insert('vegetable', $data)) {
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
		$this->db->from('vegetable');
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
	 * @param $data option filter data
	 */
	function get_rows_pagination($limit, $start, $data = null)
	{
		$this->db->limit($limit, $start);
		$this->db->select('name' . ', ' 
			. 'id as Vegetable_model_id');
		$this->db->order_by('order', 'ASC');
		$this->db->from('vegetable');

		if ($data) {
			foreach($data as $key => $val) {
				if ($val)
					$this->db->like($key, $val);
			}
		}

		$query = $this->db->get();

		if ($query->num_rows() > 0)
            return $query->result_array();
        else 
            return false;
	}

	/* re-order the entry with $id in $direction (up/down)
	 * @param $direction
	 * @param $id
	 */
	const TEMP_ORDER = 2147483647;
	function re_order($direction, $id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('vegetable', 1);
		$current_order = $query->row('order');
		$new_order = $direction == 'up' ? $current_order - 1 : $current_order + 1;

		// get id of new order and switch the orders
		$this->db->select('*');
		$this->db->where('order', $new_order);
		$query = $this->db->get('vegetable', 1);
		$other_id = $query->row('id');
		if ($other_id) {
			
			$this->db->where('id', $id);
			$this->db->set('order', self::TEMP_ORDER);
			if (!$this->db->update('vegetable'))
				return false;

			$this->db->where('id', $other_id);
			$this->db->set('order', $current_order);
			if (!$this->db->update('vegetable'))
				return false;

			$this->db->where('id', $id);
			$this->db->set('order', $new_order);
			if (!$this->db->update('vegetable'))
				return false;
		}
		return true;
	}

	

}
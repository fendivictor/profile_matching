<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subkriteria_model extends CI_Model {

	private $_table = 'sub_kriteria';

	public function get($condition = [])
	{
		if ($condition) {
			$this->db->where($condition);
		}

		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function count(){
		return $this->db->count_all($this->_table);
	}

	public function find($id)
	{
		if (!$id) {
			return;
		}

		$query = $this->db->get_where($this->_table, array('id' => $id));
		return $query->row();
	}

	public function insert($sub_kriteria)
	{
		return $this->db->insert($this->_table, $sub_kriteria);
	}

	public function update($sub_kriteria)
	{
		if (!isset($sub_kriteria['id'])) {
			return;
		}

		return $this->db->update($this->_table, $sub_kriteria, ['id' => $sub_kriteria['id']]);
	}

	public function delete($id)
	{
		if (!$id) {
			return;
		}

		return $this->db->delete($this->_table, ['id' => $id]);
	}

}

/* End of file Subkriteria_model.php */
/* Location: ./application/models/Subkriteria_model.php */
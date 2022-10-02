<?php

class Jenis_model extends CI_Model
{

	private $_table = 'jenis_kriteria';

	public function get()
	{
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

	public function update($jenis)
	{
		if (!isset($jenis['id'])) {
			return;
		}

		return $this->db->update($this->_table, $jenis, ['id' => $jenis['id']]);
	}

}

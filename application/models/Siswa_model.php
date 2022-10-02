<?php

class Siswa_model extends CI_Model
{

	private $_table = 'siswa';

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

	public function insert($siswa)
	{
		return $this->db->insert($this->_table, $siswa);
	}

	public function update($siswa)
	{
		if (!isset($siswa['id'])) {
			return;
		}

		return $this->db->update($this->_table, $siswa, ['id' => $siswa['id']]);
	}

	public function delete($id)
	{
		if (!$id) {
			return;
		}

		return $this->db->delete($this->_table, ['id' => $id]);
	}
}

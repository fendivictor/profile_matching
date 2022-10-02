<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kriteria_model extends CI_Model {

	private $_table = 'kriteria';

	public function get()
	{
		$this->db->select('a.*, b.jenis, b.nilai_factor');
		$this->db->from("$this->_table a");
		$this->db->join('jenis_kriteria b', 'a.id_jenis_kriteria = b.id', 'innner');

		$query = $this->db->get();
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

		$this->db->select('a.*, b.jenis');
		$this->db->from("$this->_table a");
		$this->db->join('jenis_kriteria b', 'a.id_jenis_kriteria = b.id', 'innner');
		$this->db->where('a.id', $id);

		$query = $this->db->get();
		return $query->row();
	}

	public function insert($kriteria)
	{
		return $this->db->insert($this->_table, $kriteria);
	}

	public function update($kriteria)
	{
		if (!isset($kriteria['id'])) {
			return;
		}

		return $this->db->update($this->_table, $kriteria, ['id' => $kriteria['id']]);
	}

	public function delete($id)
	{
		if (!$id) {
			return;
		}

		return $this->db->delete($this->_table, ['id' => $id]);
	}
}

/* End of file Kriteria_model.php */
/* Location: ./application/models/Kriteria_model.php */
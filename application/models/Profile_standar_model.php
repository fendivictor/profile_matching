<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_standar_model extends CI_Model {

	private $_table = 'profil_standar';

	public function get()
	{
		$this->db->select('a.*, b.kriteria, c.sub_kriteria, c.nilai_profile', FALSE);
		$this->db->join('kriteria b', 'b.id = a.id_kriteria', 'inner');
		$this->db->join('sub_kriteria c', 'c.id = a.id_sub_kriteria', 'inner');

		$query = $this->db->get("$this->_table a");
		return $query->result();
	}

	public function count(){
		return $this->db->count_all($this->_table);
	}

	public function find($id_kriteria)
	{
		if (!$id_kriteria) {
			return;
		}

		$query = $this->db->get_where($this->_table, array('id_kriteria' => $id_kriteria));
		return $query->row();
	}

	public function insert($profile)
	{
		return $this->db->insert($this->_table, $profile);
	}

	public function update($profile)
	{
		if (!isset($profile['id_kriteria'])) {
			return;
		}

		return $this->db->update($this->_table, $profile, ['id_kriteria' => $profile['id_kriteria']]);
	}

	public function delete($id)
	{
		if (!$id) {
			return;
		}

		return $this->db->delete($this->_table, ['id' => $id]);
	}

	public function findNilaiProfilStandar($id_kriteria)
	{
		$this->db->select('b.nilai_profile', FALSE);
		$this->db->where(['a.id_kriteria' => $id_kriteria]);
		$this->db->join('sub_kriteria b', 'a.id_sub_kriteria = b.id', 'inner');
		return $this->db->get("$this->_table a")->row();
	}
}

/* End of file Profile_standar_model.php */
/* Location: ./application/models/Profile_standar_model.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends CI_Model {

	private $_table = 'setting';

	public function find($condition = [])
	{
		if ($condition) {
			$this->db->where($condition);
		}

		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function update($setting)
	{
		if (!isset($setting['id'])) {
			return;
		}

		return $this->db->update($this->_table, $setting, ['id' => $setting['id']]);
	}
}

/* End of file Setting_model.php */
/* Location: ./application/models/Setting_model.php */
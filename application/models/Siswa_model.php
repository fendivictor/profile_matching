<?php

class Siswa_model extends CI_Model
{

	private $_table = 'siswa';
	const SESSION_KEY = 'user_id';
	const SESSION_NAME = 'username';
	const SESSION_EMAIL = 'email';
	const SESSION_NIS = 'nis';

	public function get($condition = [])
	{
		if ($condition) {
			$this->db->where($condition);
		}

		$this->db->order_by('nama', 'asc');
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

	public function login($nis, $password)
	{
		$this->db->where('nis', $nis);
		$query = $this->db->get($this->_table);
		$siswa = $query->row();

		// cek apakah siswa sudah terdaftar?
		if (!$siswa) {
			return FALSE;
		}

		// cek apakah passwordnya benar?
		$checkPassword = $this->db->where([
			'nis' => $nis,
			'password' => md5($password),
		])->get($this->_table)->row();
		
		if (! $checkPassword) {
			return FALSE;
		}

		// bikin session
		$this->session->set_userdata([
			self::SESSION_KEY => $siswa->id,
			self::SESSION_NAME => $siswa->nama,
			self::SESSION_EMAIL => $siswa->email,
			self::SESSION_NIS => $siswa->nis
		]);

		return $this->session->has_userdata(self::SESSION_KEY);
	}

	public function current_user()
	{
		if (!$this->session->has_userdata(self::SESSION_KEY)) {
			return null;
		}

		$user_id = $this->session->userdata(self::SESSION_KEY);
		$query = $this->db->get_where($this->_table, ['id' => $user_id]);
		return $query->row();
	}
}

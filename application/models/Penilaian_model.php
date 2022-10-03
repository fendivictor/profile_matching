<?php

class Penilaian_model extends CI_Model
{

	private $_table = 'penilaian';

	public function get($condition = [])
	{
		$this->db->select('a.*, b.kriteria, c.nama, d.jenis');
		$this->db->from("$this->_table a");
		$this->db->join('kriteria b', 'b.id = a.id_kriteria', 'inner');
		$this->db->join('siswa c', 'c.id = a.id_siswa', 'inner');
		$this->db->join('jenis_kriteria d', 'd.id = b.id_jenis_kriteria', 'innner');

		if ($condition) {
			$this->db->where($condition);
		}

		$this->db->order_by('c.nama asc, d.id asc');

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

		$query = $this->db->get_where($this->_table, array('id' => $id));
		return $query->row();
	}

	public function insert($penilaian)
	{
		return $this->db->insert($this->_table, $penilaian);
	}

	public function insertBulk($penilaian)
	{
		return $this->db->insert_batch($this->_table, $penilaian);
	}

	public function update($penilaian)
	{
		if (!isset($penilaian['id'])) {
			return;
		}

		return $this->db->update($this->_table, $penilaian, ['id' => $penilaian['id']]);
	}

	public function delete($id)
	{
		if (!$id) {
			return;
		}

		return $this->db->delete($this->_table, ['id' => $id]);
	}

	public function deletePenilaianSiswa($id_siswa)
	{
		if (!$id_siswa) {
			return;
		}

		return $this->db->delete($this->_table, ['id_siswa' => $id_siswa]);
	}

	public function findNilai($id_siswa, $id_kriteria)
	{
		return $this->db->get_where(
			$this->_table, [
				'id_siswa' => $id_siswa, 
				'id_kriteria' => $id_kriteria
			])->row();
	}

	public function findNilaiRataRata($id_siswa, $nilai_factor)
	{
		$this->db->select('a.id_siswa, a.nilai_factor, AVG(a.bobot) AS avg_gap');
		$this->db->from("$this->_table a");
		$this->db->where([
			'a.id_siswa' => $id_siswa,
			'a.nilai_factor' => $nilai_factor
		]);

		$this->db->group_by('a.id_siswa, a.nilai_factor');

		return $this->db->get()->row();
	}

	public function findRangking($id_siswa)
	{
		$kriteria = $this->db->get('jenis_kriteria')->result();

		$total = 0;
		if ($kriteria) {
			foreach ($kriteria as $k) {
				$findNilaiRataRata = $this->findNilaiRataRata($id_siswa, $k->nilai_factor);
				$nilaiRataRata = isset($findNilaiRataRata->avg_gap) ? $findNilaiRataRata->avg_gap : 0;
				$nilaiFactor = isset($findNilaiRataRata->nilai_factor) ? $findNilaiRataRata->nilai_factor : 0;

				$total += ($nilaiFactor/100) * $nilaiRataRata;
			}
		}

		return $total;
	}
}

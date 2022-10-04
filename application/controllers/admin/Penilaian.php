<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penilaian extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'auth_model', 'siswa_model', 
			'kriteria_model', 'profile_standar_model',
			'subkriteria_model', 'gap_model',
			'penilaian_model'
		]);
		$this->load->helper('form');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data['siswa'] = $this->penilaian_model->get_siswa(['verifikasi' => 1]);
		$data['kriteria'] = $this->kriteria_model->get();

		$this->load->view('admin/penilaian_list.php', $data);
	}

	public function findNilaiProfil($id_kriteria, $value)
	{
		$findAllSubkriteria = $this->subkriteria_model->get(['id_kriteria' => $id_kriteria]);
		if ($findAllSubkriteria) {
			foreach ($findAllSubkriteria as $s) {
				$operator = $s->operator;
				$nilai_1 = $s->nilai_1;
				$nilai_2 = $s->nilai_2;

				switch ($operator) {
					case 'DIANTARA':
						if ($value >= $nilai_1 && $value <= $nilai_2) {
							return $s->nilai_profile;
						}
						break;

					case 'KURANG DARI':
						if ($value < $nilai_1) {
							return $s->nilai_profile;
						}
						break;

					case 'KURANG DARI SAMA DENGAN':
						if ($value <= $nilai_1) {
							return $s->nilai_profile;
						}
						break;

					case 'LEBIH DARI':
						if ($value > $nilai_1) {
							return $s->nilai_profile;
						}
						break;

					case 'LEBIH DARI SAMA DENGAN':
						if ($value >= $nilai_1) {
							return $s->nilai_profile;
						}
						break;

					case 'SAMA DENGAN':
						if ($value == $nilai_1) {
							return $s->nilai_profile;
						}
						break;
					
					default:
						return 0;
						break;
				}
			}
		}
	}

	public function new()
	{
		$data = [];
		$dropdownSiswa = [];
		$data['kriteria'] = $this->kriteria_model->get();

		if ($this->input->method() === 'post') {
			$penilaian = [];

			$id_siswa = $this->input->post('siswa');
			// Delete Siswa
			$this->penilaian_model->deletePenilaianSiswa($id_siswa);

			if ($data['kriteria']) {
				foreach ($data['kriteria'] as $k) {
					$value = $this->input->post('kriteria['.$k->id.']');

					$findStandar = $this->profile_standar_model->find($k->id);
					$id_sub_kriteria = isset($findStandar->id_sub_kriteria) ? $findStandar->id_sub_kriteria : '';

					$findSubkriteria = $this->subkriteria_model->find($id_sub_kriteria);
					$nilai_profile = isset($findSubkriteria->nilai_profile) ? $findSubkriteria->nilai_profile : 0;

					$nilai = $this->findNilaiProfil($k->id, $value);

					$gap = ($nilai - $nilai_profile);

					$findGap = $this->gap_model->find($gap);
					$bobot = isset($findGap->bobot) ? $findGap->bobot : 0;

					$penilaian[] = [
						'id_siswa' => $id_siswa,
						'id_kriteria' => $k->id,
						'nilai' => $value,
						'nilai_profile' => $nilai,
						'nilai_ideal' => $nilai_profile,
						'gap' => $gap,
						'bobot' => $bobot,
						'nilai_factor' => $k->nilai_factor
					];
				}
			}

			$saved = false;
			if ($penilaian) {
				$saved = $this->penilaian_model->insertBulk($penilaian);
			}

			if ($saved) {
				$this->session->set_flashdata('message', 'Penilaian was created');
				return redirect('admin/penilaian');
			}
		}

		$siswa = $this->siswa_model->get();
		if ($siswa) {
			foreach ($siswa as $s) {
				$dropdownSiswa[$s->id] = $s->nama;
			}
		}

		$data['siswa'] = $dropdownSiswa;

		$this->load->view('admin/penilaian_new_form.php', $data);
	}

	public function edit($id_siswa = null)
	{
		$dropdownSiswa = [];
		$data['kriteria'] = $this->kriteria_model->get();
		$data['penilaian'] = $this->penilaian_model->get(['id_siswa' => $id_siswa]);

		if (!$data['penilaian'] || !$id_siswa) {
			show_404();
		}

		if ($this->input->method() === 'post') {
			$penilaian = [];

			$id_siswa_post = $this->input->post('siswa');
			// Delete Siswa
			$this->penilaian_model->deletePenilaianSiswa($id_siswa_post);
			$this->penilaian_model->deletePenilaianSiswa($id_siswa);

			if ($data['kriteria']) {
				foreach ($data['kriteria'] as $k) {
					$value = $this->input->post('kriteria['.$k->id.']');

					$findStandar = $this->profile_standar_model->find($k->id);
					$id_sub_kriteria = isset($findStandar->id_sub_kriteria) ? $findStandar->id_sub_kriteria : '';

					$findSubkriteria = $this->subkriteria_model->find($id_sub_kriteria);
					$nilai_profile = isset($findSubkriteria->nilai_profile) ? $findSubkriteria->nilai_profile : 0;

					$nilai = $this->findNilaiProfil($k->id, $value);

					$gap = ($nilai - $nilai_profile);

					$findGap = $this->gap_model->find($gap);
					$bobot = isset($findGap->bobot) ? $findGap->bobot : 0;

					$penilaian[] = [
						'id_siswa' => $id_siswa_post,
						'id_kriteria' => $k->id,
						'nilai' => $value,
						'nilai_profile' => $nilai,
						'nilai_ideal' => $nilai_profile,
						'gap' => $gap,
						'bobot' => $bobot,
						'nilai_factor' => $k->nilai_factor
					];
				}
			}

			$saved = false;
			if ($penilaian) {
				$saved = $this->penilaian_model->insertBulk($penilaian);
			}

			if ($saved) {
				$this->session->set_flashdata('message', 'Penilaian was updated');
				return redirect('admin/penilaian');
			}
		}

		$siswa = $this->siswa_model->get();
		if ($siswa) {
			foreach ($siswa as $s) {
				$dropdownSiswa[$s->id] = $s->nama;
			}
		}

		$data['siswa'] = $dropdownSiswa;
		$data['id_siswa'] = $id_siswa;

		$this->load->view('admin/penilaian_edit_form.php', $data);
	}

	public function delete($id_siswa = null)
	{
		if (!$id_siswa) {
			show_404();
		}

		$deleted = $this->penilaian_model->deletePenilaianSiswa($id_siswa);
		if ($deleted) {
			$this->session->set_flashdata('message', 'Penilaian was deleted');
			redirect('admin/penilaian');
		}
	}
}

/* End of file Penilaian.php */
/* Location: ./application/controllers/Penilaian.php */
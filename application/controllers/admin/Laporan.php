<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'auth_model', 'siswa_model', 
			'kriteria_model', 'profile_standar_model',
			'subkriteria_model', 'gap_model',
			'penilaian_model', 'jenis_model',
			'setting_model'
		]);
		$this->load->helper('form');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		$tahun = $this->input->get('tahun', TRUE);
		$kelas = $this->input->get('kelas', TRUE);

		$condition = [
			'verifikasi' => 1
		];

		if ($tahun != '') {
			$condition['c.tahun_masuk'] = $tahun;
		}

		if ($kelas != '') {
			$condition['c.kelas'] = $kelas;
		}

		$data['kriteria'] = $this->kriteria_model->get();
		$data['penilaian'] = $this->penilaian_model->get();
		$data['siswa'] = $this->penilaian_model->get_siswa($condition);
		$data['jenis'] = $this->jenis_model->get();
		$data['setting'] = $this->setting_model->find();

		$this->load->view('admin/laporan.php', $data);
	}

}

/* End of file Laporan.php */
/* Location: ./application/controllers/Laporan.php */
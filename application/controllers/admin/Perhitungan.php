<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perhitungan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'auth_model', 'siswa_model', 
			'kriteria_model', 'profile_standar_model',
			'subkriteria_model', 'gap_model',
			'penilaian_model', 'jenis_model'
		]);
		$this->load->helper('form');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data['kriteria'] = $this->kriteria_model->get();
		$data['penilaian'] = $this->penilaian_model->get();
		$data['siswa'] = $this->siswa_model->get(['verifikasi' => 1]);
		$data['jenis'] = $this->jenis_model->get();

		$this->load->view('admin/perhitungan_list.php', $data);
	}

}

/* End of file Perhitungan.php */
/* Location: ./application/controllers/Perhitungan.php */
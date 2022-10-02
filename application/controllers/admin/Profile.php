<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'auth_model', 'kriteria_model', 
			'subkriteria_model', 'profile_standar_model'
		]);
		$this->load->helper('form');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$kriteria = $this->kriteria_model->get();

			if ($kriteria) {
				foreach ($kriteria as $k) {
					$find = $this->profile_standar_model->find($k->id);

					$data = [
						'id_kriteria' => $k->id,
						'id_sub_kriteria' => $this->input->post('subkriteria['.$k->id.']', TRUE)
					];

					if (! $find) {
						$this->profile_standar_model->insert($data);
					} else {
						$this->profile_standar_model->update($data);
					}
				}
			}

			$this->session->set_flashdata('message', 'Profil was updated');
			return redirect('admin/profile');
		}

		$data['kriteria'] = $this->kriteria_model->get();

		$this->load->view('admin/profile_setting.php', $data);
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */
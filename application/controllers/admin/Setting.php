<?php

class Setting extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'auth_model',
			'setting_model'
		]);
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data = [
			'setting' => $this->setting_model->find()
		];

		if ($this->input->method() === 'post') {
			$data = [
				'id' => $this->input->post('id', TRUE),
				'jumlah_lolos' => $this->input->post('jumlah_lolos', TRUE)
			];

			$updated = $this->setting_model->update($data);
			if ($updated) {
				$this->session->set_flashdata('message', 'Setting was updated');
				redirect('admin/setting');
			}
		}

		$this->load->view('admin/setting', $data);
	}
}

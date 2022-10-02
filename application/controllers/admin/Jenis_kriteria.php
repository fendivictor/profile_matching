<?php

class Jenis_kriteria extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('jenis_model');
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data['jenis'] = $this->jenis_model->get();
		$data['current_user'] = $this->auth_model->current_user();

		$this->load->view('admin/jenis_list.php', $data);
	}

	public function edit($id = null)
	{
		$data['jenis'] = $this->jenis_model->find($id);

		if (!$data['jenis'] || !$id) {
			show_404();
		}

		if ($this->input->method() === 'post') {
			// TODO: lakukan validasi data seblum simpan ke model
			$jenis = [
				'id' => $id,
				'jenis' => $this->input->post('jenis'),
				'nilai_factor' => $this->input->post('nilai_factor'),
				
			];
			$updated = $this->jenis_model->update($jenis);
			if ($updated) {
				$this->session->set_flashdata('message', 'Jenis Kriteria berhasil diupdate');
				redirect('admin/jenis_kriteria');
			}
		}

		$this->load->view('admin/jenis_edit_form.php', $data);
	}

}

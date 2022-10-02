<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kriteria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['kriteria_model', 'jenis_model']);
		$this->load->model('auth_model');
		$this->load->helper('form');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data['kriteria'] = $this->kriteria_model->get();
		$data['current_user'] = $this->auth_model->current_user();

		$this->load->view('admin/kriteria_list.php', $data);
	}

	public function new()
	{
		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$kriteria = [
				'id_jenis_kriteria' => $this->input->post('jenis'),
				'kriteria' => $this->input->post('kriteria')
			];

			$saved = $this->kriteria_model->insert($kriteria);

			if ($saved) {
				$this->session->set_flashdata('message', 'Kriteria was created');
				return redirect('admin/Kriteria');
			}
		}

		$getJenis = $this->jenis_model->get();
		$dropdownJenis = [];

		if ($getJenis) {
			foreach ($getJenis as $jenis) {
				$dropdownJenis[$jenis->id] = $jenis->jenis;
			}
		}

		$data['jenis'] = $dropdownJenis;

		$this->load->view('admin/kriteria_new_form.php', $data);
	}

	public function edit($id = null)
	{
		$data['kriteria'] = $this->kriteria_model->find($id);

		if (!$data['kriteria'] || !$id) {
			show_404();
		}

		if ($this->input->method() === 'post') {
			// TODO: lakukan validasi data seblum simpan ke model
			$kriteria = [
				'id' => $id,
				'id_jenis_kriteria' => $this->input->post('jenis'),
				'kriteria' => $this->input->post('kriteria')
			];
			$updated = $this->kriteria_model->update($kriteria);
			if ($updated) {
				$this->session->set_flashdata('message', 'Kriteria was updated');
				redirect('admin/kriteria');
			}
		}

		$getJenis = $this->jenis_model->get();
		$dropdownJenis = [];

		if ($getJenis) {
			foreach ($getJenis as $jenis) {
				$dropdownJenis[$jenis->id] = $jenis->jenis;
			}
		}

		$data['jenis'] = $dropdownJenis;

		$this->load->view('admin/kriteria_edit_form.php', $data);
	}

	public function delete($id = null)
	{
		if (!$id) {
			show_404();
		}

		$deleted = $this->kriteria_model->delete($id);
		if ($deleted) {
			$this->session->set_flashdata('message', 'Kriteria was deleted');
			redirect('admin/kriteria');
		}
	}
}

/* End of file Kriteria.php */
/* Location: ./application/controllers/Kriteria.php */
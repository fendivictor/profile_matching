<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subkriteria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['subkriteria_model', 'kriteria_model']);
		$this->load->model('auth_model');
		$this->load->helper('form');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index($id_kriteria)
	{
		$data['id_kriteria'] = $id_kriteria;
		$data['kriteria'] = $this->kriteria_model->find($id_kriteria);

		if (! $data['kriteria']) {
			show_404();
		}

		$data['subkriteria'] = $this->subkriteria_model->get(['id_kriteria' => $id_kriteria]);
		$data['current_user'] = $this->auth_model->current_user();

		$this->load->view('admin/sub_kriteria_list.php', $data);
	}

	public function new($id_kriteria)
	{
		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$subkriteria = [
				'id_kriteria' => $this->input->post('id_kriteria'),
				'sub_kriteria' => $this->input->post('subkriteria'),
				'operator' => $this->input->post('operator'),
				'nilai_1' => $this->input->post('nilai_1'),
				'nilai_profile' => $this->input->post('nilai_profile')
			];

			if ($this->input->post('operator') === 'DIANTARA') {
				$subkriteria['nilai_2'] = $this->input->post('nilai_2');
			}

			$saved = $this->subkriteria_model->insert($subkriteria);

			if ($saved) {
				$this->session->set_flashdata('message', 'Subkriteria was created');
				return redirect('admin/subkriteria/index/' . $this->input->post('id_kriteria'));
			}
		}

		$data['id_kriteria'] = $id_kriteria;
		$data['kriteria'] = $this->kriteria_model->find($id_kriteria);

		$this->load->view('admin/sub_kriteria_new_form.php', $data);
	}

	public function edit($id_sub_kriteria)
	{
		$find = $this->subkriteria_model->find($id_sub_kriteria);

		if (! $find) {
			show_404();
		}

		$id_kriteria = $find->id_kriteria;

		if ($this->input->method() === 'post') {
			// TODO: Lakukan validasi sebelum menyimpan ke model

			$subkriteria = [
				'id' => $id_sub_kriteria,
				'id_kriteria' => $this->input->post('id_kriteria'),
				'sub_kriteria' => $this->input->post('subkriteria'),
				'operator' => $this->input->post('operator'),
				'nilai_1' => $this->input->post('nilai_1'),
				'nilai_profile' => $this->input->post('nilai_profile')
			];

			if ($this->input->post('operator') === 'DIANTARA') {
				$subkriteria['nilai_2'] = $this->input->post('nilai_2');
			}

			$saved = $this->subkriteria_model->update($subkriteria);

			if ($saved) {
				$this->session->set_flashdata('message', 'Subkriteria was updated');
				return redirect('admin/subkriteria/index/' . $this->input->post('id_kriteria'));
			}
		}

		$data['id_kriteria'] = $id_kriteria;
		$data['kriteria'] = $this->kriteria_model->find($id_kriteria);
		$data['sub_kriteria'] = $find;

		$this->load->view('admin/sub_kriteria_edit_form.php', $data);
	}

	public function delete($id = null)
	{
		if (!$id) {
			show_404();
		}

		$find = $this->subkriteria_model->find($id);

		if (!$find) {
			show_404();
		}

		$deleted = $this->subkriteria_model->delete($id);
		if ($deleted) {
			$this->session->set_flashdata('message', 'Subkriteria was deleted');
			redirect('admin/subkriteria/index/' . $find->id_kriteria);
		}
	}
}

/* End of file Subkriteria.php */
/* Location: ./application/controllers/Subkriteria.php */
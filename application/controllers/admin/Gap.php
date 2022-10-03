<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gap extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'gap_model', 'auth_model'
		]);
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index()
	{
		$data['gap'] = $this->gap_model->get();

		$this->load->view('admin/gap.php', $data);
	}

}

/* End of file Gap.php */
/* Location: ./application/controllers/Gap.php */
<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		} 
	}
	
	public function index()
	{
		$data = [];

		$this->load->view('admin/dashboard.php', $data);
	}
}

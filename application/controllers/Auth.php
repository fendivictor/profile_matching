<?php

class Auth extends CI_Controller
{
	public function index()
	{
		show_404();
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('admin');
		} else {
			redirect('auth/login');

		}
	}

	public function login()
	{
		$this->load->model(['auth_model', 'siswa_model']);
		$this->load->library('form_validation');

		$rules = $this->auth_model->rules();
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == FALSE){
			return $this->load->view('login_form');
		}

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if($this->auth_model->login($username, $password)){
			redirect('admin');
		} else {
			$isverifikasi = $this->siswa_model->get(['email' => $username, 'verifikasi' => 1]);

			if (! $isverifikasi) {
				if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
					$this->session->set_flashdata('message_login_error', 'Login Gagal, pastikan username dan password benar!');
				} else {
					$this->session->set_flashdata('message_login_error', 'User belum diverifikasi!');
				}
			} else {
				$siswa = $this->siswa_model->login($username, $password);
				if ($siswa) {
					redirect('admin/SiswaDashboard');
				}

				$this->session->set_flashdata('message_login_error', 'Login Gagal, pastikan username dan password benar!');
			}
		}

		$this->load->view('login_form');
	}

	public function logout()
	{
		$this->load->model('auth_model');
		$this->auth_model->logout();
		redirect(site_url());
	}

	public function daftar()
	{
		if ($this->input->method() === 'post') {
			$this->load->model('siswa_model');
			$this->load->library('form_validation');

			$nama = $this->input->post('nama', TRUE);
			$email = $this->input->post('email', TRUE);
			$telepon = $this->input->post('telepon', TRUE);
			$alamat = $this->input->post('alamat', TRUE);
			$password = $this->input->post('password', TRUE);
			$repassword = $this->input->post('repassword', TRUE);

			$this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', ['required' => 'Masukkan Nama Lengkap']);
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[siswa.email]', ['required' => 'Masukkan Email', 'valid_email' => 'Email tidak valid', 'is_unique' => 'Email sudah terdaftar']);
			$this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Masukkan Password']);
			$this->form_validation->set_rules('repassword', 'Ketik Ulang Password', 'required|matches[password]', ['required' => 'Ketik Ulang Password', 'matches' => 'Password tidak Cocok']);
			$this->form_validation->set_rules('telepon', 'Telepon', 'numeric', ['numeric' => 'Nomor Telepon Harus Angka']);

			if($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('message_register_error', validation_errors());
				return $this->load->view('register_form');
			}

			$simpan = $this->siswa_model->insert([
				'nama' => $nama,
				'email' => $email,
				'password' => md5($password),
				'telepon' => $telepon,
				'alamat' => $alamat
			]);

			if (! $simpan) {
				$this->session->set_flashdata('message_register_error', 'Pendaftaran Gagal');
				return $this->load->view('register_form');
			}

			$this->session->set_flashdata('message_register_success', 'Pendaftaran Berhasil');
			return $this->load->view('register_form');
		}

		$this->load->view('register_form');
	}
}

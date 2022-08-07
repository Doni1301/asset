<?php

class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		if($this->session->login) redirect('dashboard');
		$this->load->model('M_pengguna', 'm_pengguna');
	}

	public function index(){
		$this->load->view('login');
	}

	public function proses_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$get_pengguna = $this->m_pengguna->lihat_username($username);
		if($get_pengguna){
			$pass = $get_pengguna->password ;
			if(password_verify(	$password, $pass)){
				$session = [
					'id'   => $get_pengguna->id,
					'kode' => $get_pengguna->kode,
					'nama' => $get_pengguna->nama,
					'username' => $get_pengguna->username,
					'password' => $get_pengguna->password,
					'role' => $this->input->post('role'),
					'jam_masuk' => date('H:i:s')
				];

				$log_otomatis = ['Las_active_time'=>time()];

				$this->session->set_userdata('login', $session, $log_otomatis);
				$this->session->set_flashdata('success-login', '<strong>Login</strong> Berhasil!');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error-login', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error-login', 'Username Salah!');
			redirect();
		}
	}

}
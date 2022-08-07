<?php

class Dashboard extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['aktif'] = 'dashboard';
	}

	public function index(){
		$this->data['title'] = 'Halaman Dashboard';
		
		$this->load->view('dashboard', $this->data);
	}
}
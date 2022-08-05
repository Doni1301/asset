<?php

class Dashboard extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['aktif'] = 'dashboard';
		$this->load->database();
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_supplier', 'm_supplier');
		$this->load->model('M_petugas', 'm_petugas');
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
		$this->load->model('M_retur', 'm_retur');
		$this->load->model('M_pengguna', 'm_pengguna');
	}

	public function index(){
		$this->data['title'] = 'Halaman Dashboard';
		$this->load->view('dashboard', $this->data);
	}
}
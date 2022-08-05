<?php

use Dompdf\Dompdf;

class Pengguna extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->data['aktif'] = 'pengguna';
		$this->load->model('M_pengguna', 'm_pengguna');
	}

	public function index(){
		$this->data['title'] = 'Data Pengguna';
		$this->data['all_pengguna'] = $this->m_pengguna->lihat();
		$this->data['no'] = 1;

		$this->load->view('pengguna/lihat', $this->data);
	}

	public function tambah(){

		$this->data['title'] = 'Tambah Admin';

		$this->load->view('pengguna/tambah', $this->data);
	}

	public function proses_tambah(){
		$pass = $this->input->post('password');
		$password = password_hash($pass, PASSWORD_DEFAULT);
		$data = [
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'password' => $password,
		];

		if($this->m_pengguna->tambah($data)){
			$this->session->set_flashdata('success', 'Data Pengguna <strong>Berhasil</strong> Ditambahkan!');
			redirect('pengguna');
		} else {
			$this->session->set_flashdata('error', 'Data Pengguna <strong>Gagal</strong> Ditambahkan!');
			redirect('pengguna');
		}
	}

	public function ubah($id){

		$this->data['title'] = 'Ubah Pengguna';
		$this->data['pengguna'] = $this->m_pengguna->lihat_id($id);

		$this->load->view('pengguna/ubah', $this->data);
	}

	public function proses_ubah($id){
		$pass = $this->input->post('password');
		$password = password_hash($pass, PASSWORD_DEFAULT);

		$data = [
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'username' => $this->input->post('username'),
			'password' => $password,
		];

		if($this->m_pengguna->ubah($data, $id)){
			$this->session->set_flashdata('success', 'Data Pengguna <strong>Berhasil</strong> Diubah!');
			redirect('pengguna');
		} else {
			$this->session->set_flashdata('error', 'Data Pengguna <strong>Gagal</strong> Diubah!');
			redirect('pengguna');
		}
	}

	public function hapus($id){

		if($this->m_pengguna->hapus($id)){
			$this->session->set_flashdata('success', 'Data Pengguna <strong>Berhasil</strong> Dihapus!');
			redirect('pengguna');
		} else {
			$this->session->set_flashdata('error', 'Data Pengguna <strong>Gagal</strong> Dihapus!');
			redirect('pengguna');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		$this->data['all_pengguna'] = $this->m_pengguna->lihat();
		$this->data['title'] = 'Laporan Data Admin';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('pengguna/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Pengguna Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
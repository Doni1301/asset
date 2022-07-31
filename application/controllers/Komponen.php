<?php

use Dompdf\Dompdf;

class Komponen extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['aktif'] = 'komponen';
		$this->load->model('M_komponen', 'm_komponen');
	}

	public function index(){
		$this->data['title'] = 'Data Komponen';
		$this->data['all_komponen'] = $this->m_komponen->lihat();
		$this->data['no'] = 1;

		$this->load->view('komponen/lihat', $this->data);
	}
	
	public function tambah(){

		$this->data['title'] = 'Tambah Komponen';

		$this->load->view('komponen/tambah', $this->data);
	}

	public function proses_tambah(){

		$data = [
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
		];

		if($this->m_komponen->tambah($data)){
			$this->session->set_flashdata('success', 'Data Komponen <strong>Berhasil</strong> Ditambahkan!');
			redirect('komponen');
		} else {
			$this->session->set_flashdata('error', 'Data Komponen <strong>Gagal</strong> Ditambahkan!');
			redirect('komponen');
		}
	}

	public function ubah($kode_komponen){

		$this->data['title'] = 'Ubah Komponen';
		$this->data['komponen'] = $this->m_komponen->lihat_id($kode_komponen);

		$this->load->view('komponen/ubah', $this->data);
	}

	public function proses_ubah($kode_komponen){

		$data = [
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
		];

		if($this->m_komponen->ubah($data, $kode_komponen)){
			$this->session->set_flashdata('success', 'Data Komponen <strong>Berhasil</strong> Diubah!');
			redirect('komponen');
		} else {
			$this->session->set_flashdata('error', 'Data Komponen <strong>Gagal</strong> Diubah!');
			redirect('komponen');
		}
	}

	public function hapus($kode_komponen){
		
		if($this->m_komponen->hapus($kode_komponen)){
			$this->session->set_flashdata('success', 'Data Komponen <strong>Berhasil</strong> Dihapus!');
			redirect('komponen');
		} else {
			$this->session->set_flashdata('error', 'Data Komponen <strong>Gagal</strong> Dihapus!');
			redirect('komponen');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		$this->data['all_komponen'] = $this->m_komponen->lihat();
		$this->data['title'] = 'Laporan Data Komponen';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('komponen/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Komponen Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
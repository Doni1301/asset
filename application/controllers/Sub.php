<?php

use Dompdf\Dompdf;

class Sub extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['aktif'] = 'sub';
		$this->load->model('M_sub', 'm_sub');
	}

	public function index(){
		$this->data['title'] = 'Data Sub Komponen';
		$this->data['all_sub'] = $this->m_sub->lihat();
		$this->data['no'] = 1;

		$this->load->view('sub/lihat', $this->data);
	}
	
	public function tambah(){

		$this->data['title'] = 'Tambah Sub Komponen';

		$this->load->view('sub/tambah', $this->data);
	}

	public function proses_tambah(){

		$data = [
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
		];

		if($this->m_sub->tambah($data)){
			$this->session->set_flashdata('success', 'Data Sub Komponen <strong>Berhasil</strong> Ditambahkan!');
			redirect('sub');
		} else {
			$this->session->set_flashdata('error', 'Data Sub Komponen <strong>Gagal</strong> Ditambahkan!');
			redirect('sub');
		}
	}

	public function ubah($kode_sub){

		$this->data['title'] = 'Ubah Sub Komponen';
		$this->data['sub'] = $this->m_sub->lihat_id($kode_sub);

		$this->load->view('sub/ubah', $this->data);
	}

	public function proses_ubah($kode_sub){

		$data = [
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
		];

		if($this->m_sub->ubah($data, $kode_sub)){
			$this->session->set_flashdata('success', 'Data Sub Komponen <strong>Berhasil</strong> Diubah!');
			redirect('sub');
		} else {
			$this->session->set_flashdata('error', 'Data Sub Komponen <strong>Gagal</strong> Diubah!');
			redirect('sub');
		}
	}

	public function hapus($kode_sub){
		
		if($this->m_sub->hapus($kode_sub)){
			$this->session->set_flashdata('success', 'Data Sub Komponen <strong>Berhasil</strong> Dihapus!');
			redirect('sub');
		} else {
			$this->session->set_flashdata('error', 'Data Sub Komponen <strong>Gagal</strong> Dihapus!');
			redirect('sub');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		$this->data['all_sub'] = $this->m_sub->lihat();
		$this->data['title'] = 'Laporan Data Sub Komponen';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('sub/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Sub Komponen Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
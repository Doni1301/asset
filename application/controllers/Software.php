<?php

use Dompdf\Dompdf;

class Software extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['aktif'] = 'software';
		$this->load->model('M_software', 'm_software');
	}

	public function index(){
		$this->data['title'] = 'Data Software';
		$this->data['all_software'] = $this->m_software->lihat();
		$this->data['no'] = 1;

		$this->load->view('software/lihat', $this->data);
	}
	
	public function tambah(){

		$this->data['title'] = 'Tambah Software';

		$this->load->view('software/tambah', $this->data);
	}

	public function proses_tambah(){

		$data = [
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
		];

		if($this->m_software->tambah($data)){
			$this->session->set_flashdata('success', 'Data Software <strong>Berhasil</strong> Ditambahkan!');
			redirect('software');
		} else {
			$this->session->set_flashdata('error', 'Data Software <strong>Gagal</strong> Ditambahkan!');
			redirect('software');
		}
	}

	public function ubah($kode_software){

		$this->data['title'] = 'Ubah Software';
		$this->data['software'] = $this->m_software->lihat_id($kode_software);

		$this->load->view('software/ubah', $this->data);
	}

	public function proses_ubah($kode_software){

		$data = [
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
		];

		if($this->m_software->ubah($data, $kode_software)){
			$this->session->set_flashdata('success', 'Data Software <strong>Berhasil</strong> Diubah!');
			redirect('software');
		} else {
			$this->session->set_flashdata('error', 'Data Software <strong>Gagal</strong> Diubah!');
			redirect('software');
		}
	}

	public function hapus($kode_software){
		
		if($this->m_software->hapus($kode_software)){
			$this->session->set_flashdata('success', 'Data Software <strong>Berhasil</strong> Dihapus!');
			redirect('software');
		} else {
			$this->session->set_flashdata('error', 'Data Software <strong>Gagal</strong> Dihapus!');
			redirect('software');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		$this->data['all_software'] = $this->m_software->lihat();
		$this->data['title'] = 'Laporan Data Software';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('software/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Software Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
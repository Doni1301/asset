<?php

use Dompdf\Dompdf;

class User extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->data['aktif'] = 'user';
		$this->load->model('M_user', 'm_user');
	}

	public function index(){
		$this->data['title'] = 'Data User';
		$this->data['all_user'] = $this->m_user->lihat();
		$this->data['no'] = 1;

		$this->load->view('user/lihat', $this->data);
	}
	
	public function tambah(){

		$this->data['title'] = 'Tambah User';

		$this->load->view('user/tambah', $this->data);
	}

	public function proses_tambah(){

		$data = [
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'dept' => $this->input->post('dept'),
			'pic' => $this->input->post('pic'),
			'email' => $this->input->post('email'),
		];

		if($this->m_user->tambah($data)){
			$this->session->set_flashdata('success', 'Data User <strong>Berhasil</strong> Ditambahkan!');
			redirect('user');
		} else {
			$this->session->set_flashdata('error', 'Data User <strong>Gagal</strong> Ditambahkan!');
			redirect('user');
		}
	}

	public function ubah($kode_user){

		$this->data['title'] = 'Ubah User';
		$this->data['user'] = $this->m_user->lihat_id($kode_user);

		$this->load->view('user/ubah', $this->data);
	}

	public function proses_ubah($kode_user){

		$data = [
			'kode' => $this->input->post('kode'),
			'nama' => $this->input->post('nama'),
			'dept' => $this->input->post('dept'),
			'pic' => $this->input->post('pic'),
			'email' => $this->input->post ('email'),
		];

		if($this->m_user->ubah($data, $kode_user)){
			$this->session->set_flashdata('success', 'Data User <strong>Berhasil</strong> Diubah!');
			redirect('user');
		} else {
			$this->session->set_flashdata('error', 'Data User <strong>Gagal</strong> Diubah!');
			redirect('user');
		}
	}

	public function hapus($kode_user){
		
		if($this->m_user->hapus($kode_user)){
			$this->session->set_flashdata('success', 'Data User <strong>Berhasil</strong> Dihapus!');
			redirect('user');
		} else {
			$this->session->set_flashdata('error', 'Data User <strong>Gagal</strong> Dihapus!');
			redirect('user');
		}
	}

	public function lihat_nama_user($nama_user){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_user' => $nama_user]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function export(){
		$dompdf = new Dompdf();
		$this->data['all_user'] = $this->m_user->lihat();
		$this->data['title'] = 'Laporan Data User';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('user/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data User Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
<?php
use Dompdf\Dompdf;
class Retur extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->data['aktif'] = 'retur';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_retur', 'm_retur');
		$this->load->model('M_detail_retur', 'm_detail_retur');
		$this->load->model('M_user', 'm_user');
		$this->load->model('M_petugas', 'm_petugas');
	}

	public function index(){
		$this->data['title'] = 'Transaksi Pengembalian';
		$this->data['all_retur'] = $this->m_retur->lihat();
		$this->data['no'] = 1;

		$this->load->view('retur/lihat', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah Transaksi';
		$this->data['all_user'] = $this->m_user->lihat_user();

		$this->load->view('retur/tambah', $this->data);
	}

	public function proses_tambah(){

		$data_retur = [
			'no_iden' => $this->input->post('no_retur'),
			'tgl_iden' => $this->input->post('tgl_retur'),
			'jam_iden' => $this->input->post('jam_retur'),
			'user' => $this->input->post('user'),
			'kode' => $this->input->post('kode'),
		];

		$retur_id = $this->m_retur->tambah($data_retur);

		$data_detail_retur = [];

		for($i = 0; $i < $jumlah_barang_retur; $i++){
			$barang = $this->m_barang->lihat_nama_barang($this->input->post('nama_barang_hidden')[$i]);
			array_push($data_detail_retur, ['no_retur' => $this->input->post('no_retur')]);
			$data_detail_retur[$i]['retur_id'] = $retur_id;
			$data_detail_retur[$i]['barang_id'] = $barang->id;
			$data_detail_retur[$i]['nama_barang'] = $this->input->post('nama_barang_hidden')[$i];
			$data_detail_retur[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_retur[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
		}

		if($retur_id && $this->m_detail_retur->tambah($data_detail_retur)){
			for ($i=0; $i < $jumlah_barang_retur ; $i++) { 
				$this->m_barang->plus_stok($data_detail_retur[$i]['jumlah'], $data_detail_retur[$i]['nama_barang']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Pengembalian</strong> Berhasil Dibuat!');
			redirect('retur');
		}
	}

	public function proses_edit(){
		$jumlah_barang_retur = count($this->input->post('nama_barang_hidden'));
		$no_retur = $this->input->post('no_retur');
		$data_retur = [
			'keterangan' => $this->input->post('keterangan'),
		];

		$ubahdata = $this->m_retur->ubah($data_retur, $no_retur);
		$retur_id = $this->m_retur->lihat_no_retur($no_retur)->id;


		$details = $this->m_detail_retur->lihat_no_retur($no_retur);
		foreach ($details as $detail) {
			$this->m_barang->min_stok($detail->jumlah, $detail->nama_barang);
		}
		$this->m_detail_retur->hapus($no_retur);

		$data_detail_retur = [];

		for($i = 0; $i < $jumlah_barang_retur; $i++){
			$barang = $this->m_barang->lihat_nama_barang($this->input->post('nama_barang_hidden')[$i]);
			array_push($data_detail_retur, ['no_retur' => $this->input->post('no_retur')]);
			$data_detail_retur[$i]['retur_id'] = $retur_id;
			$data_detail_retur[$i]['barang_id'] = $barang->id;
			$data_detail_retur[$i]['nama_barang'] = $this->input->post('nama_barang_hidden')[$i];
			$data_detail_retur[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_retur[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
		}

		if($retur_id && $this->m_detail_retur->tambah($data_detail_retur)){
			for ($i=0; $i < $jumlah_barang_retur ; $i++) {
				$this->m_barang->plus_stok($data_detail_retur[$i]['jumlah'], $data_detail_retur[$i]['nama_barang']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Pengembalian</strong> Berhasil Diubah!');
			redirect('retur');
		}
	}

	public function detail($no_retur){
		$this->data['title'] = 'Detail Pengembalian';
		$this->data['retur'] = $this->m_retur->lihat_no_retur($no_retur);
		$this->data['all_detail_retur'] = $this->m_detail_retur->lihat_no_retur($no_retur);
		$this->data['no'] = 1;

		$this->load->view('retur/detail', $this->data);
	}

	public function hapus($no_retur){
		$details = $this->m_detail_retur->lihat_no_retur($no_retur);
		foreach ($details as $detail) {
			$this->m_barang->min_stok($detail->jumlah, $detail->nama_barang);
		}
		if($this->m_retur->hapus($no_retur) && $this->m_detail_retur->hapus($no_retur)){
			$this->session->set_flashdata('success', 'Invoice Pengembalian <strong>Berhasil</strong> Dihapus!');
			redirect('retur');
		}else {
			$this->session->set_flashdata('error', 'Invoice Pengembalian <strong>Gagal</strong> Dihapus!');
			redirect('retur');
		}
	}

	public function get_all_user(){
		$data = $this->m_user->lihat_nama_user($_POST['nama_user']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('retur/keranjang');
	}

	public function export(){
		$dompdf = new Dompdf();
		
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_retur'] = $this->m_retur->lihat();
		$this->data['title'] = 'Laporan Data Pengembalian';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Portrait');
		$html = $this->load->view('retur/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Pengembalian Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_detail($no_retur){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['retur'] = $this->m_retur->lihat_no_retur($no_retur);
		$this->data['all_detail_retur'] = $this->m_detail_retur->lihat_no_retur($no_retur);
		$this->data['title'] = 'Laporan Detail Pengembalian';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Portrait');
		$html = $this->load->view('retur/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Pengembalian Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function edit($no_retur){
		$this->data['title'] 			= 'Edit Pengembalian';
		$this->data['retur'] 			= $this->m_retur->lihat_no_retur($no_retur);
		$this->data['all_detail_retur'] = $this->m_detail_retur->get_detail_retur($no_retur);
		$this->data['no'] 				= 1;
		$this->data['petugas'] 			= $this->m_petugas->get_petugas($this->data['retur']->nama_petugas);
		$this->data['all_barang'] 		= $this->m_barang->lihat_stok_retur();

		$this->load->view('retur/edit', $this->data);
	}

	public function get_detail($no_retur){
		$this->data['all_detail_retur']	= $this->m_detail_retur->get_detail_retur($no_retur);
		return $this->data;
	}

	public function delete_detail($id,$no_retur){
		$jRetur = $this->m_detail_retur->get_by_id($id);
		$this->m_barang->min_stok($jRetur->jumlah, $jRetur->nama_barang) or die('gagal plus stok');
		$this->m_detail_retur->delete_id($id);
		redirect('retur/edit/'.$no_retur);
	}

	public function add_detail(){
		$data = array([
			'no_retur'		=> $this->input->post('no_retur'),
			'nama_barang'	=> $this->input->post('nama_barang'),
			'jumlah'		=> $this->input->post('jumlah'),
			'satuan'		=> $this->input->post('satuan')
		]);
		
		$this->m_detail_retur->tambah($data);
		$this->m_barang->plus_stok($this->input->post('jumlah'), $this->input->post('nama_barang')) or die('gagal min stok');
		
		redirect('retur/edit/'.$this->input->post('no_retur'));
	}
}
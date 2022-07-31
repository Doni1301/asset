<?php
use Dompdf\Dompdf;
class Penerimaan extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->data['aktif'] = 'penerimaan';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_supplier', 'm_supplier');
		$this->load->model('M_penerimaan', 'm_penerimaan');
		$this->load->model('M_detail_terima', 'm_detail_terima');
		$this->load->model('M_user', 'm_user');
		$this->load->model('M_petugas', 'm_petugas');
	}

	public function index(){
		$this->data['title'] = 'Transaksi Penerimaan';
		$this->data['all_penerimaan'] = $this->m_penerimaan->lihat();
		$this->data['no'] = 1;

		$this->load->view('penerimaan/lihat', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah Transaksi';
		$this->data['all_barang'] = $this->m_barang->lihat_stok_terima();
		$this->data['all_user'] = $this->m_user->lihat_user();

		$this->load->view('penerimaan/tambah', $this->data);
	}

	public function proses_tambah(){
		$jumlah_barang_diterima = count($this->input->post('nama_barang_hidden'));
		$supplier = $this->m_user->lihat_id_by_nama($this->input->post('nama_supplier'));

		$data_terima = [
			'supplier_id' => $supplier->id,
			'no_terima' => $this->input->post('no_terima'),
			'tgl_terima' => $this->input->post('tgl_terima'),
			'jam_terima' => $this->input->post('jam_terima'),
			'nama_supplier' => $this->input->post('nama_supplier'),
			'nama_petugas' => $this->input->post('nama_petugas'),
			'keterangan' => $this->input->post('keterangan'),
			'kode_petugas' => $this->input->post('kode_petugas'),
			'id_pengguna'   => $this->input->post('id_pengguna'),
		];

		$penerimaan_id = $this->m_penerimaan->tambah($data_terima);

		$data_detail_terima = [];

		for($i = 0; $i < $jumlah_barang_diterima; $i++){
			$barang = $this->m_barang->lihat_nama_barang($this->input->post('nama_barang_hidden')[$i]);
			array_push($data_detail_terima, ['no_terima' => $this->input->post('no_terima')]);
			$data_detail_terima[$i]['penerimaan_id'] = $penerimaan_id;
			$data_detail_terima[$i]['barang_id'] = $barang->id;
			$data_detail_terima[$i]['nama_barang'] = $this->input->post('nama_barang_hidden')[$i];
			$data_detail_terima[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_terima[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
		}

		if($penerimaan_id && $this->m_detail_terima->tambah($data_detail_terima)){
			for ($i=0; $i < $jumlah_barang_diterima ; $i++) { 
				$this->m_barang->plus_stok($data_detail_terima[$i]['jumlah'], $data_detail_terima[$i]['nama_barang']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Penerimaan</strong> Berhasil Dibuat!');
			redirect('penerimaan');
		}
	}

	public function proses_edit(){
		$jumlah_barang_terima = count($this->input->post('nama_barang_hidden'));
		$no_terima = $this->input->post('no_terima');
		$data_terima = [
			'keterangan' => $this->input->post('keterangan'),
		];

		$ubahdata = $this->m_penerimaan->ubah($data_terima, $no_terima);
		$penerimaan_id = $this->m_penerimaan->lihat_no_terima($no_terima)->id;


		$details = $this->m_detail_terima->lihat_no_terima($no_terima);
		foreach ($details as $detail) {
			$this->m_barang->min_stok($detail->jumlah, $detail->nama_barang);
		}
		$this->m_detail_terima->hapus($no_terima);

		$data_detail_terima = [];

		for($i = 0; $i < $jumlah_barang_terima; $i++){
			$barang = $this->m_barang->lihat_nama_barang($this->input->post('nama_barang_hidden')[$i]);
			array_push($data_detail_terima, ['no_terima' => $this->input->post('no_terima')]);
			$data_detail_terima[$i]['penerimaan_id'] = $penerimaan_id;
			$data_detail_terima[$i]['barang_id'] = $barang->id;
			$data_detail_terima[$i]['nama_barang'] = $this->input->post('nama_barang_hidden')[$i];
			$data_detail_terima[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_terima[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
		}

		if($penerimaan_id && $this->m_detail_terima->tambah($data_detail_terima)){
			for ($i=0; $i < $jumlah_barang_terima ; $i++) {
				$this->m_barang->plus_stok($data_detail_terima[$i]['jumlah'], $data_detail_terima[$i]['nama_barang']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Penerimaan</strong> Berhasil Diubah!');
			redirect('penerimaan');
		}
	}

	public function detail($no_terima){
		$this->data['title'] = 'Detail Penerimaan';
		$this->data['penerimaan'] = $this->m_penerimaan->lihat_no_terima($no_terima);
		$this->data['all_detail_terima'] = $this->m_detail_terima->lihat_no_terima($no_terima);
		$this->data['no'] = 1;

		$this->load->view('penerimaan/detail', $this->data);
	}

	public function hapus($no_terima){
		$details = $this->m_detail_terima->lihat_no_terima($no_terima);
		foreach ($details as $detail) {
			$this->m_barang->min_stok($detail->jumlah, $detail->nama_barang);
		}
		if($this->m_penerimaan->hapus($no_terima) && $this->m_detail_terima->hapus($no_terima)){
			$this->session->set_flashdata('success', 'Invoice Penerimaan <strong>Berhasil</strong> Dihapus!');
			redirect('penerimaan');
		}else {
			$this->session->set_flashdata('error', 'Invoice Penerimaan <strong>Gagal</strong> Dihapus!');
			redirect('penerimaan');
		}
	}

	public function get_all_user(){
		$data = $this->m_user->lihat_nama_user($_POST['nama']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('penerimaan/keranjang');
	}

	public function export(){
		$dompdf = new Dompdf();
		
		$this->data['all_penerimaan'] = $this->m_penerimaan->lihat();
		$this->data['title'] = 'Laporan Data Penerimaan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('penerimaan/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_detail($no_terima){
		$dompdf = new Dompdf();

		$this->data['penerimaan'] = $this->m_penerimaan->lihat_no_terima($no_terima);
		$this->data['all_detail_terima'] = $this->m_detail_terima->lihat_no_terima($no_terima);
		$this->data['title'] = 'Laporan Detail Penerimaan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Potrait');
		$html = $this->load->view('penerimaan/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function edit($no_terima){
		$this->data['title'] 			= 'Edit Penerimaan';
		$this->data['penerimaan'] 		= $this->m_penerimaan->lihat_no_terima($no_terima);
		$this->data['all_detail_terima'] = $this->m_detail_terima->get_detail_terima($no_terima);
		$this->data['no'] 				= 1;
		$this->data['petugas'] 			= $this->m_petugas->get_petugas($this->data['penerimaan']->nama_petugas);
		$this->data['all_barang'] 		= $this->m_barang->lihat_stok_terima();

		$this->load->view('penerimaan/edit', $this->data);
	}

	public function get_detail($no_terima){
		$this->data['all_detail_terima']	= $this->m_detail_terima->get_detail_terima($no_terima);
		return $this->data;
	}

	public function delete_detail($id,$no_terima){
		$jTerima = $this->m_detail_terima->get_by_id($id);
		$this->m_barang->min_stok($jTerima->jumlah, $jTerima->nama_barang) or die('gagal min stok');
		$this->m_detail_terima->delete_id($id);
		redirect('penerimaan/edit/'.$no_terima);
	}

	public function add_detail(){
		$data = array([
			'no_terima'		=> $this->input->post('no_terima'),
			'nama_barang'	=> $this->input->post('nama_barang'),
			'jumlah'		=> $this->input->post('jumlah'),
			'satuan'		=> $this->input->post('satuan')
		]);
		
		$this->m_detail_terima->tambah($data);
		$this->m_barang->plus_stok($this->input->post('jumlah'), $this->input->post('nama_barang')) or die('gagal plus stok');
		
		redirect('penerimaan/edit/'.$this->input->post('no_terima'));
	}
}
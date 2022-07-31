<?php
use Dompdf\Dompdf;
class Pengeluaran extends CI_Controller{
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'petugas' && $this->session->login['role'] != 'admin') redirect();
		date_default_timezone_set('Asia/Manila');
		$this->data['aktif'] = 'pengeluaran';
		$this->load->model('M_barang', 'm_barang');
		$this->load->model('M_pengeluaran', 'm_pengeluaran');
		$this->load->model('M_detail_keluar', 'm_detail_keluar');
		$this->load->model('M_petugas', 'm_petugas');
	}

	public function index(){
		$this->data['title'] = 'Transaksi Pengeluaran';
		$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihat();
		$this->data['no'] = 1;

		$this->load->view('pengeluaran/lihat', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah Transaksi';
		$this->data['all_barang'] = $this->m_barang->lihat_stok_keluar();

		$this->load->view('pengeluaran/tambah', $this->data);
	}

	public function proses_tambah(){
		$jumlah_barang_keluar = count($this->input->post('nama_barang_hidden'));

		$data_pengeluaran = [
			'no_keluar' => $this->input->post('no_keluar'),
			'tgl_keluar' => $this->input->post('tgl_keluar'),
			'jam_keluar' => $this->input->post('jam_keluar'),
			'keterangan' => $this->input->post('keterangan'),
			'kode_petugas' => $this->input->post('kode_petugas'),
			'nama_petugas' => $this->input->post('nama_petugas'),
			'id_petugas'   => $this->input->post('id_petugas'), 
		];

		$pengeluaran_id = $this->m_pengeluaran->tambah($data_pengeluaran);

		$data_detail_keluar = [];

		for($i = 0; $i < $jumlah_barang_keluar; $i++){
			$barang = $this->m_barang->lihat_nama_barang($this->input->post('nama_barang_hidden')[$i]);
			array_push($data_detail_keluar, ['no_keluar' => $this->input->post('no_keluar')]);
			$data_detail_keluar[$i]['pengeluaran_id'] = $pengeluaran_id;
			$data_detail_keluar[$i]['barang_id'] = $barang->id;
			$data_detail_keluar[$i]['nama_barang'] = $this->input->post('nama_barang_hidden')[$i];
			$data_detail_keluar[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_keluar[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
		}

		if($pengeluaran_id && $this->m_detail_keluar->tambah($data_detail_keluar)){
			for ($i=0; $i < $jumlah_barang_keluar ; $i++) { 
				$this->m_barang->min_stok($data_detail_keluar[$i]['jumlah'], $data_detail_keluar[$i]['nama_barang']) or die('gagal min stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Pengeluaran</strong> Berhasil Dibuat!');
			redirect('pengeluaran');
		}
	}

	public function proses_edit(){
		$jumlah_barang_keluar = count($this->input->post('nama_barang_hidden'));
		$no_keluar = $this->input->post('no_keluar');
		$data_keluar = [
			'keterangan' => $this->input->post('keterangan'),
		];

		$ubahdata = $this->m_pengeluaran->ubah($data_keluar, $no_keluar);
		$pengeluaran_id = $this->m_pengeluaran->lihat_no_keluar($no_keluar)->id;


		$details = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		foreach ($details as $detail) {
			$this->m_barang->plus_stok($detail->jumlah, $detail->nama_barang);
		}
		$this->m_detail_keluar->hapus($no_keluar);

		$data_detail_keluar = [];

		for($i = 0; $i < $jumlah_barang_keluar; $i++){
			$barang = $this->m_barang->lihat_nama_barang($this->input->post('nama_barang_hidden')[$i]);
			array_push($data_detail_keluar, ['no_keluar' => $this->input->post('no_keluar')]);
			$data_detail_keluar[$i]['pengeluaran_id'] = $pengeluaran_id;
			$data_detail_keluar[$i]['barang_id'] = $barang->id;
			$data_detail_keluar[$i]['nama_barang'] = $this->input->post('nama_barang_hidden')[$i];
			$data_detail_keluar[$i]['jumlah'] = $this->input->post('jumlah_hidden')[$i];
			$data_detail_keluar[$i]['satuan'] = $this->input->post('satuan_hidden')[$i];
		}

		if($pengeluaran_id && $this->m_detail_keluar->tambah($data_detail_keluar)){
			for ($i=0; $i < $jumlah_barang_keluar ; $i++) {
				$this->m_barang->min_stok($data_detail_keluar[$i]['jumlah'], $data_detail_keluar[$i]['nama_barang']) or die('gagal plus stok');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>Pengeluaran</strong> Berhasil Diubah!');
			redirect('pengeluaran');
		}
	}

	public function detail($no_keluar){
		$this->data['title'] = 'Detail Pengeluaran';
		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_no_keluar($no_keluar);
		$this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['no'] = 1;

		$this->load->view('pengeluaran/detail', $this->data);
	}

	public function hapus($no_keluar){
		$details = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		foreach ($details as $detail) {
			$this->m_barang->plus_stok($detail->jumlah, $detail->nama_barang);
		}
		if($this->m_pengeluaran->hapus($no_keluar) && $this->m_detail_keluar->hapus($no_keluar)){
			$this->session->set_flashdata('success', 'Invoice Pengeluaran <strong>Berhasil</strong> Dihapus!');
			redirect('pengeluaran');
		}else {
			$this->session->set_flashdata('error', 'Invoice Pengeluaran <strong>Gagal</strong> Dihapus!');
			redirect('pengeluaran');
		}
	}

	public function get_all_barang(){
		$data = $this->m_barang->lihat_nama_barang($_POST['nama_barang']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('pengeluaran/keranjang');
	}

	public function export(){
		$dompdf = new Dompdf();
		
		$this->data['all_pengeluaran'] = $this->m_pengeluaran->lihat();
		$this->data['title'] = 'Laporan Data Pengeluaran';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Portrait');
		$html = $this->load->view('pengeluaran/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Pengeluaran Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_detail($no_keluar){
		$dompdf = new Dompdf();

		$this->data['pengeluaran'] = $this->m_pengeluaran->lihat_no_keluar($no_keluar);
		$this->data['all_detail_keluar'] = $this->m_detail_keluar->lihat_no_keluar($no_keluar);
		$this->data['title'] = 'Laporan Detail Pengeluaran';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Portrait');
		$html = $this->load->view('pengeluaran/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Pengeluaran Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function edit($no_keluar){
		$this->data['title'] 			= 'Edit Pengeluaran';
		$this->data['pengeluaran'] 			= $this->m_pengeluaran->lihat_no_keluar($no_keluar);
		$this->data['all_detail_keluar'] = $this->m_detail_keluar->get_detail_keluar($no_keluar);
		$this->data['no'] 				= 1;
		$this->data['petugas'] 			= $this->m_petugas->get_petugas($this->data['pengeluaran']->nama_petugas);
		$this->data['all_barang'] 		= $this->m_barang->lihat_stok_keluar();

		$this->load->view('pengeluaran/edit', $this->data);
	}

	public function get_detail($no_keluar){
		$this->data['all_detail_keluar']	= $this->m_detail_keluar->get_detail_keluar($no_keluar);
		return $this->data;
	}

	public function delete_detail($id,$no_keluar){
		$jKeluar = $this->m_detail_keluar->get_by_id($id);
		$this->m_barang->plus_stok($jKeluar->jumlah, $jKeluar->nama_barang) or die('gagal plus stok');
		$this->m_detail_keluar->delete_id($id);
		redirect('pengeluaran/edit/'.$no_keluar);
	}

	public function add_detail(){
		$data = array([
			'no_keluar'		=> $this->input->post('no_keluar'),
			'nama_barang'	=> $this->input->post('nama_barang'),
			'jumlah'		=> $this->input->post('jumlah'),
			'satuan'		=> $this->input->post('satuan')
		]);
		
		$this->m_detail_keluar->tambah($data);
		$this->m_barang->min_stok($this->input->post('jumlah'), $this->input->post('nama_barang')) or die('gagal plus stok');
		
		redirect('pengeluaran/edit/'.$this->input->post('no_keluar'));
	}
}
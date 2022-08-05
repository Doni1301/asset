<?php
use Dompdf\Dompdf;
class Det_soft extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->data['aktif'] = 'det_soft';
		$this->load->model('M_user', 'm_user');
		$this->load->model('M_komponen', 'm_komponen');
		$this->load->model('M_sub', 'm_sub');
		$this->load->model('M_software', 'm_software');
		$this->load->model('M_identifikasi', 'm_identifikasi');
		$this->load->model('M_detail_iden', 'm_detail_iden');
		$this->load->model('M_det_soft', 'm_det_soft');
		$this->load->model('M_detail_soft', 'm_detail_soft');
	}

	public function index(){
		$this->data['title'] = 'Transaksi Detail Soft';
		$this->data['all_det_soft'] = $this->m_det_soft->lihat();
		$this->data['no'] = 1;

		$this->load->view('det_soft/lihat', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah Software';
		$this->data['all_identifikasi'] = $this->m_identifikasi->lihat();
		$this->data['all_software'] = $this->m_software->lihat_software();
		$this->data['all_user'] = $this->m_user->lihat_user();

		$this->load->view('det_soft/tambah', $this->data);
	}

	public function proses_tambah(){
		$jumlah_komponen_diterima = count($this->input->post('komponen_hidden'));

		$data_det_soft = [
			'id_iden' => $this->input->post('id_iden'),
			'no_input' => $this->input->post('no_input'),
			'no_iden' => $this->input->post('no_iden'),
			'nama' => $this->input->post('nama'),
			'kode' => $this->input->post('kode'),
			'dept' => $this->input->post('dept'),
			'pic' => $this->input->post('pic'),
		];

		$det_soft_id = $this->m_det_soft->tambah($data_det_soft);

		$data_detail_soft = [];

		for($i = 0; $i < $jumlah_komponen_diterima; $i++){
			array_push($data_detail_soft, ['no_input' => $this->input->post('no_input')]);
			$data_detail_soft[$i]['id_input'] = $det_soft_id;
			$data_detail_soft[$i]['komponen'] = $this->input->post('komponen_hidden')[$i];
			$data_detail_soft[$i]['keterangan'] = $this->input->post('keterangan_hidden')[$i];
			$data_detail_soft[$i]['produk'] = $this->input->post('produk_hidden')[$i];
			$data_detail_soft[$i]['vendor'] = $this->input->post('vendor_hidden')[$i];
		}
		
		if($det_soft_id && $this->m_detail_soft->tambah($data_detail_soft)){
			$this->session->set_flashdata('success', 'Invoice <strong>Detail Software</strong> Berhasil Dibuat!');
			redirect('det_soft');
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

	public function detail($no_input){
		$this->data['title'] = 'Detail Identifikasi Software';
		$this->data['all_detail_soft'] = $this->m_detail_soft->lihat_no_input($no_input);
		$this->data['det_soft'] = $this->m_det_soft->lihat_no_input($no_input);
		$this->data['no'] = 1;

		$this->load->view('det_soft/detail', $this->data);
	}

	public function hapus($no_input){
		if($this->m_det_soft->hapus($no_input) && $this->m_detail_soft->hapus($no_input)){
			$this->session->set_flashdata('success', 'Identifikasi <strong>Berhasil</strong> Dihapus!');
			redirect('det_soft');
		}else {
			$this->session->set_flashdata('error', 'Invoice Identifikasi <strong>Gagal</strong> Dihapus!');
			redirect('det_soft');
		}
	}

	public function get_all_identifikasi(){
		$data = $this->m_identifikasi->lihat_no_iden($_POST['no_iden']);
		echo json_encode($data);
	}

	public function get_all_iden(){
		$data = $this->m_detail_iden->lihat_nama_iden($_POST['komponen']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('det_soft/keranjang');
	}

	public function export(){
		$dompdf = new Dompdf();
		
		$this->data['all_identifikasi'] = $this->m_identifikasi->lihat();
		$this->data['title'] = 'Laporan Data Identifikasi';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('identifikasi/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data Identifikasi Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_detail($no_identifikasi){
		$dompdf = new Dompdf();

		$this->data['identifikasi'] = $this->m_identifikasi->lihat_no_iden($no_iden);
		$this->data['all_detail_iden'] = $this->m_detail_iden->lihat_no_iden($no_iden);
		$this->data['title'] = 'Laporan Detail Penerimaan';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Potrait');
		$html = $this->load->view('penerimaan/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail Penerimaan Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function edit($no_iden){
		$this->data['title'] 			= 'Edit Identifikasi';
		$this->data['identifikasi'] 	= $this->m_identifikasi->lihat_no_iden($no_iden);
		$this->data['all_detail_iden'] = $this->m_detail_iden->lihat_no_iden($no_iden);
		$this->data['all_user'] = $this->m_user->lihat_user();
		$this->data['all_komponen'] = $this->m_komponen->lihat_komponen();
		$this->data['all_sub'] = $this->m_sub->lihat_sub();
		$this->data['no'] 				= 1;

		$this->load->view('identifikasi/edit', $this->data);
	}

	public function get_detail($no_iden){
		$this->data['all_detail_iden']	= $this->m_detail_iden->get_detail_terima($no_iden);
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
<?php
use Dompdf\Dompdf;
class Identifikasi extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->data['aktif'] = 'identifikasi';
		$this->load->model('M_user', 'm_user');
		$this->load->model('M_komponen', 'm_komponen');
		$this->load->model('M_sub', 'm_sub');
		$this->load->model('M_software', 'm_software');
		$this->load->model('M_identifikasi', 'm_identifikasi');
		$this->load->model('M_detail_iden', 'm_detail_iden');
	}

	public function index(){
		$this->data['title'] = 'Identifikasi User';
		$this->data['all_identifikasi'] = $this->m_identifikasi->lihat();
		$this->data['no'] = 1;

		$this->load->view('identifikasi/lihat', $this->data);
	}

	public function tambah(){
		$this->data['title'] = 'Tambah Identifikasi User';
		$this->data['all_user'] = $this->m_user->lihat_user();
		$this->data['all_komponen'] = $this->m_komponen->lihat_komponen();
		$this->data['all_sub'] = $this->m_sub->lihat_sub();

		$this->load->view('identifikasi/tambah', $this->data);
	}

	public function proses_tambah(){
		$jumlah_komponen_diterima = count($this->input->post('komponen_hidden'));

		$data_iden = [
			'no_iden' => $this->input->post('no_iden'),
			'tgl_iden' => $this->input->post('tgl_iden'),
			'jam_iden' => $this->input->post('jam_iden'),
			'nama' => $this->input->post('nama'),
			'kode' => $this->input->post('kode'),
			'dept' => $this->input->post('dept'),
			'pic' => $this->input->post('pic'),
		];

		$identifikasi_id = $this->m_identifikasi->tambah($data_iden);

		$data_detail_iden = [];

		for($i = 0; $i < $jumlah_komponen_diterima; $i++){
			array_push($data_detail_iden, ['no_iden' => $this->input->post('no_iden')]);
			$data_detail_iden[$i]['id_iden'] = $identifikasi_id;
			$data_detail_iden[$i]['komponen'] = $this->input->post('komponen_hidden')[$i];
			$data_detail_iden[$i]['sub'] = $this->input->post('sub_hidden')[$i];
			$data_detail_iden[$i]['keterangan'] = $this->input->post('keterangan_hidden')[$i];
			$data_detail_iden[$i]['sn'] = $this->input->post('sn_hidden')[$i];
			$data_detail_iden[$i]['exp'] = $this->input->post('exp_hidden')[$i];
			$data_detail_iden[$i]['vendor'] = $this->input->post('vendor_hidden')[$i];
		}
		
		if($identifikasi_id && $this->m_detail_iden->tambah($data_detail_iden)){
			$this->session->set_flashdata('success', 'Invoice <strong>Identifikasi</strong> Berhasil Dibuat!');
			redirect('identifikasi');
		}
	
	}

	public function proses_edit(){
		$jumlah_komponen_diterima = count($this->input->post('komponen_hidden'));

		$identifikasi_id = $this->m_identifikasi->lihat_no_iden($no_iden)->id;

		$data_detail_iden = [];

		for($i = 0; $i < $jumlah_komponen_diterima; $i++){
			array_push($data_detail_iden, ['no_iden' => $this->input->post('no_iden')]);
			$data_detail_iden[$i]['id_iden'] = $identifikasi_id;
			$data_detail_iden[$i]['komponen'] = $this->input->post('komponen_hidden')[$i];
			$data_detail_iden[$i]['sub'] = $this->input->post('sub_hidden')[$i];
			$data_detail_iden[$i]['keterangan'] = $this->input->post('keterangan_hidden')[$i];
			$data_detail_iden[$i]['sn'] = $this->input->post('sn_hidden')[$i];
			$data_detail_iden[$i]['exp'] = $this->input->post('exp_hidden')[$i];
			$data_detail_iden[$i]['vendor'] = $this->input->post('vendor_hidden')[$i];
		}
		
		if( $this->m_detail_iden->tambah($data_detail_iden)){
			$this->session->set_flashdata('success', 'Invoice <strong>Identifikasi</strong> Berhasil Dibuat!');
			redirect('identifikasi');
		}
	}

	public function detail($no_iden){
		$this->data['title'] = 'Detail Identifikasi User';
		$this->data['all_detail_iden'] = $this->m_detail_iden->lihat_no_iden($no_iden);
		$this->data['identifikasi'] = $this->m_identifikasi->lihat_no_iden($no_iden);
		$this->data['no'] = 1;

		$this->load->view('identifikasi/detail', $this->data);
	}

	public function hapus($no_iden){
		if($this->m_identifikasi->hapus($no_iden) && $this->m_detail_iden->hapus($no_iden)){
			$this->session->set_flashdata('success', 'Identifikasi User <strong>Berhasil</strong> Dihapus!');
			redirect('identifikasi');
		}else {
			$this->session->set_flashdata('error', 'Identifikasi User <strong>Gagal</strong> Dihapus!');
			redirect('identifikasi');
		}
	}

	public function get_all_user(){
		$data = $this->m_user->lihat_nama_user($_POST['nama']);
		echo json_encode($data);
	}

	public function get_all_iden(){
		$data = $this->m_detail_iden->lihat_nama_iden($_POST['komponen']);
		echo json_encode($data);
	}

	public function keranjang_barang(){
		$this->load->view('identifikasi/keranjang');
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

	// public function get_detail($no_iden){
	// 	$this->data['all_detail_iden']	= $this->m_detail_iden->get_detail_terima($no_iden);
	// 	return $this->data;
	// }

	// public function delete_detail($id,$no_terima){
	// 	$jTerima = $this->m_detail_terima->get_by_id($id);
	// 	$this->m_barang->min_stok($jTerima->jumlah, $jTerima->nama_barang) or die('gagal min stok');
	// 	$this->m_detail_terima->delete_id($id);
	// 	redirect('penerimaan/edit/'.$no_terima);
	// }

	// public function add_detail(){
	// 	$data = array([
	// 		'no_terima'		=> $this->input->post('no_terima'),
	// 		'nama_barang'	=> $this->input->post('nama_barang'),
	// 		'jumlah'		=> $this->input->post('jumlah'),
	// 		'satuan'		=> $this->input->post('satuan')
	// 	]);
		
	// 	$this->m_detail_terima->tambah($data);
	// 	$this->m_barang->plus_stok($this->input->post('jumlah'), $this->input->post('nama_barang')) or die('gagal plus stok');
		
	// 	redirect('penerimaan/edit/'.$this->input->post('no_terima'));
	// }
}
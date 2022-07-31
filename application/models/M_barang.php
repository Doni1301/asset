<?php

class M_barang extends CI_Model{
	protected $_table = 'barang';

	public function custom_query($sql)
	{
	  $query = $this->db->query($sql);
	  return $query;
	}

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_stok_terima(){
		$query = $this->db->get_where($this->_table, 'stok > -1');
		return $query->result();
	}

	public function lihat_stok_keluar(){
		$query = $this->db->get_where($this->_table, 'stok > 0');
		return $query->result();
	}

	public function lihat_stok_retur(){
		$query = $this->db->get_where($this->_table, 'stok > -1');
		return $query->result();
	}

	public function lihat_id($kode_barang){
		$query = $this->db->get_where($this->_table, ['kode_barang' => $kode_barang]);
		return $query->row();
	}
	
	public function detail_penerimaan($kode_barang)
	{
		$query = $this->db->select(['barang.nama_barang', 'barang.satuan', 'detail_terima.jumlah', 'detail_terima.no_terima', 'penerimaan.no_terima as no_trans', 'penerimaan.tgl_terima as tanggal_trans', 'penerimaan.jam_terima']);
		$query = $this->db->join('detail_terima', 'barang.id = detail_terima.barang_id');
		$query = $this->db->join('penerimaan', 'detail_terima.penerimaan_id = penerimaan.id');
		$query = $this->db->where('kode_barang', $kode_barang);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function detail_pengeluaran($kode_barang)
	{
		$query = $this->db->select(['barang.nama_barang', 'barang.satuan', 'detail_keluar.jumlah', 'detail_keluar.no_keluar', 'pengeluaran.no_keluar as no_trans', 'pengeluaran.tgl_keluar as tanggal_trans', 'pengeluaran.jam_keluar']);
		$query = $this->db->join('detail_keluar', 'barang.id = detail_keluar.barang_id');
		$query = $this->db->join('pengeluaran', 'detail_keluar.pengeluaran_id = pengeluaran.id');
		$query = $this->db->where('kode_barang', $kode_barang);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function detail_retur($kode_barang)
	{
		$query = $this->db->select(['barang.nama_barang', 'barang.satuan', 'detail_retur.jumlah', 'detail_retur.no_retur', 'retur.no_retur as no_trans', 'retur.tgl_retur as tanggal_trans', 'retur.jam_retur']);
		$query = $this->db->join('detail_retur', 'barang.id = detail_retur.barang_id');
		$query = $this->db->join('retur', 'detail_retur.retur_id = retur.id');
		$query = $this->db->where('kode_barang', $kode_barang);
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_nama_barang($nama_barang){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama_barang' => $nama_barang]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function plus_stok($stok, $nama_barang){
		$query = $this->db->set('stok', 'stok+' . $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function min_stok($stok, $nama_barang){
		$query = $this->db->set('stok', 'stok-' . $stok, false);
		$query = $this->db->where('nama_barang', $nama_barang);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function ubah($data, $kode_barang){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode_barang' => $kode_barang]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode_barang){
		return $this->db->delete($this->_table, ['kode_barang' => $kode_barang]);
	}
}
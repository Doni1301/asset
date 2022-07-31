<?php

class M_user extends CI_Model{
	protected $_table = 'user';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_user(){
		$query = $this->db->select('nama');
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_id($kode){
		$query = $this->db->get_where($this->_table, ['kode' => $kode]);
		return $query->row();
	}

	public function lihat_id_by_nama($nama){
		$query = $this->db->get_where($this->_table, ['nama' => $nama]);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $kode){
		$query = $this->db->set($data);
		$query = $this->db->where(['kode' => $kode]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($kode){
		return $this->db->delete($this->_table, ['kode' => $kode]);
	}

	public function lihat_nama_user($nama){
		$query = $this->db->select('*');
		$query = $this->db->where(['nama' => $nama]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

}
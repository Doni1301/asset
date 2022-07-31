<?php

class M_retur extends CI_Model {
	protected $_table = 'retur';

	public function lihat(){
		return $this->db->get($this->_table)->result();
	} 

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function list()
	{
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_no_retur($no_retur){
		return $this->db->get_where($this->_table, ['no_retur' => $no_retur])->row();
	}

	public function tambah($data){
		$this->db->insert($this->_table, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function ubah($data, $no_retur){
		$query = $this->db->set($data);
		$query = $this->db->where(['no_retur' => $no_retur]);
		$query = $this->db->update($this->_table);
		return $query;
	}


	public function hapus($no_retur){
		return $this->db->delete($this->_table, ['no_retur' => $no_retur]);
	}
}
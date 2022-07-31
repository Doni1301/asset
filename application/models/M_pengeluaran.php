<?php 

class M_pengeluaran extends CI_Model {
	protected $_table = 'pengeluaran';

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

	public function lihat_no_keluar($no_keluar){
		return $this->db->get_where($this->_table, ['no_keluar' => $no_keluar])->row();
	}

	public function tambah($data){
		$this->db->insert($this->_table, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function ubah($data, $no_keluar){
		$query = $this->db->set($data);
		$query = $this->db->where(['no_keluar' => $no_keluar]);
		$query = $this->db->update($this->_table);
		return $query;
	}


	public function hapus($no_keluar){
		return $this->db->delete($this->_table, ['no_keluar' => $no_keluar]);
	}
}
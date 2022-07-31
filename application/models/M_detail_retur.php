<?php

class M_detail_retur extends CI_Model {
	protected $_table = 'detail_retur';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_no_retur($no_retur){
		return $this->db->get_where($this->_table, ['no_retur' => $no_retur])->result();
	}

	public function hapus($no_retur){
		return $this->db->delete($this->_table, ['no_retur' => $no_retur]);
	}

	public function get_detail_retur($no_retur){
		$this->db->select('barang.kode_barang, detail_retur.*');
		$this->db->from('detail_retur');
		$this->db->join('barang', 'detail_retur.nama_barang=barang.nama_barang');
		$this->db->where(['no_retur' => $no_retur]);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_by_id($id){
		$query = $this->db->get_where($this->_table, ['id'=>$id]);
		return $query->row();
	}

	public function delete_id($id){
		$this->db->where('id',$id);
		return $this->db->delete($this->_table);
	}
}
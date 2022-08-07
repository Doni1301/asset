<?php 

class M_detail_iden extends CI_Model {
	protected $_table = 'detail_iden';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function tambah_id($data){
		return $this->db->insert($this->_table, $data);
	}

	public function lihat_no_iden($no_iden){
		$query = $this->db->get_where($this->_table, ['no_iden'=>$no_iden]);
		return $query->result();
	}

	public function hapus($no_iden){
		return $this->db->delete($this->_table, ['no_iden' => $no_iden]);
	}

	public function get_detail_iden($no_iden){
		$this->db->select('identifikasi.id, detail_iden.*');
		$this->db->from('detail_iden');
		$this->db->join('identifikasi', 'detail_iden.id_iden=identifikasi.id');
		$this->db->where(['no_iden' => $no_iden]);
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

	public function lihat_nama_iden($komponen){
		$query = $this->db->select('*');
		$query = $this->db->where(['komponen' => $komponen]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

}
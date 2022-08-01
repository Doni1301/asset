<?php 

class M_detail_iden extends CI_Model {
	protected $_table = 'detail_iden';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_no_iden($no_iden){
		$query = $this->db->get_where($this->_table, ['no_iden'=>$no_iden]);
		return $query->result();
	}

	public function hapus($no_iden){
		return $this->db->delete($this->_table, ['no_iden' => $no_iden]);
	}

	public function get_detail_iden($no_iden){
		$this->db->select('barang.kode_barang, detail_terima.*');
		$this->db->from('detail_terima');
		$this->db->join('barang', 'detail_terima.nama_barang=barang.nama_barang');
		$this->db->where(['no_terima' => $no_terima]);
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
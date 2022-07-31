<?php 

class M_detail_terima extends CI_Model {
	protected $_table = 'detail_terima';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_no_terima($no_terima){
		return $this->db->get_where($this->_table, ['no_terima' => $no_terima])->result();
	}

	public function hapus($no_terima){
		return $this->db->delete($this->_table, ['no_terima' => $no_terima]);
	}

	public function get_detail_terima($no_terima){
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
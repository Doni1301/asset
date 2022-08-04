<?php 

class M_detail_soft extends CI_Model {
	protected $_table = 'detail_soft';

	public function tambah($data){
		return $this->db->insert_batch($this->_table, $data);
	}

	public function lihat_no_input($no_input){
		$query = $this->db->get_where($this->_table, ['no_input'=>$no_input]);
		return $query->result();
	}

	public function hapus($no_input){
		return $this->db->delete($this->_table, ['no_input' => $no_input]);
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

	public function lihat_nama_iden($komponen){
		$query = $this->db->select('*');
		$query = $this->db->where(['komponen' => $komponen]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

}
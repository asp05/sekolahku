<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_crud extends CI_Model {

	public function get_where($table,$id){
		return $this->db->get_where($table, $id);
	}
	public function get($table){
		return $this->db->get($table);
	}	
	public function masukan($table,$data){
		return $this->db->insert($table, $data);
	}
	public function hapus($table,$id){
		$this->db->where($id);
		return $this->db->delete($table);
	}
	public function ubah($table,$data,$id){
		$this->db->where($id);
		return $this->db->update($table, $data);
	}
}

/* End of file Mod_crud.php */
/* Location: ./application/models/Mod_crud.php */
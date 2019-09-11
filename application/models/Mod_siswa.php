<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_siswa extends CI_Model {

var $table 			= 'tbl_siswa';
var $column_order	= array('nis','nama_siswa','agama','tempat','status', null);
var $column_search	= array('nis','nama_siswa','agama','tempat','status');

	private function _get_datatables(){
		if ($this->input->post('jurusan') != '' || $this->input->post('jurusan') != null) {
			$this->db->where('id_jurusan', $this->input->post('jurusan'));
		}
		if ($this->input->post('nama') != '' || $this->input->post('nama') != null ) {
			$this->db->like('nama_siswa', $this->input->post('nama'));
		}

		$this->db->join('tbl_kelas', 'tbl_siswa.kelas = tbl_kelas.id_kelas');
		$this->db->join('tbl_jurusan', 'tbl_siswa.jurusan = tbl_jurusan.id_jurusan');
		$this->db->from($this->table);
		$i = 0;

		foreach ($this->column_search as $item) {
			if ($_POST['search']['value']) {
				if ($i === 0) {
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}else{
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if(count($this->column_search)-1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}elseif (isset($this->order)) {
			$order 	= $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	function get_datatables(){
		$this->_get_datatables();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'],$_POST['start']);
			$query 	= $this->db->get();
			return $query->result();
	}

	function count_filtered(){
		$this->_get_datatables();
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function count_all(){
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}


}

/* End of file Mod_siswa.php */
/* Location: ./application/models/Mod_siswa.php */
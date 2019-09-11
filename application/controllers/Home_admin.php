<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_admin extends CI_Controller {
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('user') == false) {
			redirect('login');
		};
	}

	public function index()
	{
		$data['siswa']		= $this->mc->get('tbl_siswa')->num_rows();
		$data['jurusan']	= $this->mc->get('tbl_jurusan')->num_rows();
		$data['kelas']		= $this->mc->get('tbl_kelas')->num_rows();
		$data['pendaftar']	= $this->mc->get_where('tbl_siswa',['status' == 1])->num_rows();
		$data['user']		= $this->mc->get_where('tbl_admin',['nama_admin' => $this->session->userdata('user')])->row_array();
		$data['judul']	= 'dashboard admin';
		$this->andi->sugara('home_admin',$data);		
	}

}

/* End of file Home_admin.php */
/* Location: ./application/controllers/admin/Home_admin.php */
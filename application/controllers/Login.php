<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		
	}
	public function index(){
		if ($this->session->userdata('user')) {
			redirect('home_admin');
		}
		$this->form_validation->set_rules('username', 'username', 'trim|required',[
			'required'	=> 'username tidak boleh kosong'
		]);
		$this->form_validation->set_rules('password', 'password', 'trim|required',[
			'required'	=> 'password tidak boleh kosong'
		]);
		if ($this->form_validation->run() == false) {
			$data['judul']		= 'login';
			$this->load->view('login', $data);
		}else{
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			$user 		= $this->mc->get_where('tbl_admin',['nama_admin' => $username])->row_array();
			if ($user) {
				if (password_verify($password, $user['password'])) {
					$data = array(
						'user' => $user['nama_admin']
					);
					$this->session->set_userdata( $data );
					redirect('home_admin');
				}else{
					$this->session->set_flashdata('berhasil','<div class="alert alert-warning alert-dismissible">
			        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        <h4><i class="icon fa fa-close"></i> gagal!</h4>
			        username/password salah
			        </div>');
				redirect('login');
				}
			}else{
				$this->session->set_flashdata('berhasil','<div class="alert alert-warning alert-dismissible">
			        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			        <h4><i class="icon fa fa-close"></i> gagal!</h4>
			        username/password salah
			        </div>');
				redirect('login');
			}
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */
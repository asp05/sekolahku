<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('mod_siswa');
		if (!$this->session->userdata('user')) {
			redirect('login');
		}
	}
	public function index()
	{
		$data['user']	= $this->mc->get_where('tbl_admin',['nama_admin' => $this->session->userdata('user')])->row_array();
		$data['judul']	= 'siswa'; 
		$data['jurusan']= $this->mc->get('tbl_jurusan')->result();
		$this->andi->sugara('siswa/index',$data);		
	}
	public function ajax_list(){
		$list = $this->mod_siswa->get_datatables();
		$no   = $_POST['start'];
		$data = array();
		foreach ($list as $x) {
			$no++;
			$button = '<div class="btn-group">';
            $button .= '<button type="button" class="btn btn-danger btn-flat dropdown-toggle" data-toggle="dropdown">';
            $button .= 'Aksi';
            $button .= '</button>';
            $button .= '<ul class="dropdown-menu" role="menu">';
            $button .= '<li><a href="' . site_url('master/siswa/edit/' . $x->nis) . '">Edit</a></li>';
            $button .= '<li class="divider"></li>';
            $button .= '<li><a onclick="return confirm(' . "'Apakah Anda Yakin?'" . ')" href="' . site_url('master/siswa/hapus/' . $x->nis) . '">Hapus</a></li>';
            $button .= '</ul>';
            $button .= '</div>';
			$row 	= array();
			$row[]	= $no;
			$row[]	= $x->nis;		
			$row[]	= $x->nama_siswa;		
			$row[]	= $x->nama_kelas;		
			$row[]	= $x->nama_jurusan;
			$row[]	= '<img class="img-thumbnail" src="'. base_url('assets/dist/img/' .$x->foto) .'">';	
			$row[]	= $x->tempat.','.date_indo($x->tgl_lahir);
			$row[]	= $x->alamat;
			$row[]	= $button;
			$data[]	= $row;		
		}	
		$output = array(
			"draw"			=> $_POST['draw'],
			"recordsTotal"	=> $this->mod_siswa->count_all(),
			"recorsFiltered"=> $this->mod_siswa->count_filtered(),
			"data"			=> $data
		);

		echo json_encode($output);
	}
	public function edit($id){
		$this->auth_edit();
		if ($this->form_validation->run() == false) {
			$data['kelas']		= $this->mc->get('tbl_kelas')->result();
			$data['jurusan']	= $this->mc->get('tbl_jurusan')->result();
			$data['judul']		= "Tambah Siswa";
			$data['provinsi']	= $this->mc->get('province')->result();
			$data['user']		= $this->mc->get_where('tbl_admin',['nama_admin' => $this->session->userdata('user')])->row_array();
			$data['siswa']		= $this->mc->get_where('tbl_siswa',['nis' => $id])->row();
			$this->andi->sugara('siswa/edit_siswa',$data);
		}else {
			$config['upload_path'] = './assets/dist/img/';
			$config['allowed_types'] = 'jpeg|jpg|png';
			$config['max_size']  = '2000';
			$this->upload->initialize($config);
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('foto')){
				$foto = $this->upload->data();
			}
			$data = array(
				'nis'			=> $this->input->post('nis'),
				'nama_siswa'	=> $this->input->post('nama_siswa'),
				'email'			=> $this->input->post('email'),
				'kelas'			=> $this->input->post('kelas'),
				'jurusan'		=> $this->input->post('jurusan'),
				'jk'			=> $this->input->post('jk'),
				'agama'			=> $this->input->post('agama'),
				'alamat'		=> $this->input->post('alamat'),
				'kecamatan'		=> $this->input->post('kecamatan'),
				'kota'			=> $this->input->post('city_id'),
				'provinsi'		=> $this->input->post('province_id'),
				'tempat'		=> $this->input->post('tempat'),
				'tgl_lahir'		=> $this->input->post('tgl_lahir'),
				'tahun_mulai'	=> $this->input->post('tahun_mulai'),
				'tahun_selesai'	=> $this->input->post('tahun_selesai'),
				'masuk'			=> $this->input->post('masuk'),
			);

			 if ($foto['file_name'] != null) {
                $data['foto'] = $foto['file_name'];
            }
            	
			$this->mc->ubah('tbl_siswa',$data,['nis' => $id]);
			redirect('master/siswa');
		}
	}
	public function tambah(){
		$this->auth_siswa();
		if ($this->form_validation->run() == FALSE) {
			$data['kelas']		= $this->mc->get('tbl_kelas')->result();
			$data['jurusan']	= $this->mc->get('tbl_jurusan')->result();
			$data['judul']		= "Tambah Siswa";
			$data['provinsi']	= $this->mc->get('province')->result();
			$data['user']		= $this->mc->get_where('tbl_admin',['nama_admin' => $this->session->userdata('user')])->row_array();
			$this->andi->sugara('siswa/tambah_siswa',$data);
		} else {
			$config['upload_path'] = './assets/dist/img/';
			$config['allowed_types'] = 'jpeg|jpg|png';
			$config['max_size']  = '2000';
			$this->upload->initialize($config);
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('foto')){
				$error = $this->upload->display_errors();
				echo $error; return false;
			}
			else{
				$foto = $this->upload->data();
			}
			$data = array(
				'nis'			=> $this->input->post('nis'),
				'nama_siswa'	=> $this->input->post('nama_siswa'),
				'email'			=> $this->input->post('email'),
				'kelas'			=> $this->input->post('kelas'),
				'jurusan'		=> $this->input->post('jurusan'),
				'jk'			=> $this->input->post('jk'),
				'agama'			=> $this->input->post('agama'),
				'alamat'		=> $this->input->post('alamat'),
				'kecamatan'		=> $this->input->post('kecamatan'),
				'kota'			=> $this->input->post('city_id'),
				'provinsi'		=> $this->input->post('province_id'),
				'tempat'		=> $this->input->post('tempat'),
				'tgl_lahir'		=> $this->input->post('tgl_lahir'),
				'foto'			=> $foto['file_name'],
				'tahun_mulai'	=> $this->input->post('tahun_mulai'),
				'tahun_selesai'	=> $this->input->post('tahun_selesai'),
				'masuk'			=> time(),
				'password'		=> password_hash($this->input->post('password'), PASSWORD_DEFAULT)
			);
			$this->mc->masukan('tbl_siswa',$data);
			redirect('master/siswa');
		}
	}
	public function hapus($id){
		$this->mc->hapus('tbl_siswa',['nis' => $id]);
		redirect('master/siswa');
	}
	public function auth_siswa(){
		$this->form_validation->set_rules('nis', 'nis', 'trim|required|is_unique[tbl_siswa.nis]',[
			'required'		=> 'Nis tidak boleh kosong',
			'is_unique'	=> 'Nis sudah terdaftar'
		]);
		$this->form_validation->set_rules('nama_siswa', 'nama', 'trim|required',[
			'required'		=> 'nama tidak boleh kosong'
		]);
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email',[
			'required'		=> 'email tidak boleh kosong',
			'valid_email'	=> 'masukan alamat email yang valid'
		]);
		$this->form_validation->set_rules('agama', 'agama', 'trim|required',[
			'required'		=> 'agama tidak boleh kosong',
		]);
		$this->form_validation->set_rules('tempat', 'tempat', 'trim|required',[
			'required'		=> 'tempat tidak boleh kosong'
		]);
		$this->form_validation->set_rules('tgl_lahir', 'tgl_lahir', 'trim|required',[
			'required'		=> 'tanggal lahir tidak boleh kosong',
		]);
		$this->form_validation->set_rules('tahun_mulai', 'tahun_mulai', 'trim|required',[
			'required'		=> 'tahun tidak boleh kosong'
		]);
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[5]',[
			'required'		=> 'password tidak boleh kosong',
			'min_length'	=> 'password minimal 5 karakter',
		]);
		$this->form_validation->set_rules('password1', 'password', 'trim|required|matches[password]',[
			'required'		=> 'password tidak boleh kosong',
			'matches'		=> 'password tidak sama'
		]);
		$this->form_validation->set_rules('province_id', 'province_id', 'trim|required',[
			'required'		=> 'provinsi tidak boleh kosong'
		]);
		$this->form_validation->set_rules('city_id', 'city_id', 'trim|required',[
			'required'		=> 'Kota tidak boleh kosong'
		]);
		$this->form_validation->set_rules('kecamatan', 'kecamatan', 'trim|required',[
			'required'		=> 'kecamatan tidak boleh kosong'
		]);
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required',[
			'required'		=> 'alamat tidak boleh kosong'
		]);
	}
	public function auth_edit(){
		$this->form_validation->set_rules('nis', 'nis', 'trim|required',[
			'required'		=> 'Nis tidak boleh kosong',
			'is_unique'	=> 'Nis sudah terdaftar'
		]);
		$this->form_validation->set_rules('nama_siswa', 'nama', 'trim|required',[
			'required'		=> 'nama tidak boleh kosong'
		]);
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email',[
			'required'		=> 'email tidak boleh kosong',
			'valid_email'	=> 'masukan alamat email yang valid'
		]);
		$this->form_validation->set_rules('agama', 'agama', 'trim|required',[
			'required'		=> 'agama tidak boleh kosong',
		]);
		$this->form_validation->set_rules('tempat', 'tempat', 'trim|required',[
			'required'		=> 'tempat tidak boleh kosong'
		]);
		$this->form_validation->set_rules('tgl_lahir', 'tgl_lahir', 'trim|required',[
			'required'		=> 'tanggal lahir tidak boleh kosong',
		]);
		$this->form_validation->set_rules('tahun_mulai', 'tahun_mulai', 'trim|required',[
			'required'		=> 'tahun tidak boleh kosong'
		]);
		$this->form_validation->set_rules('alamat', 'alamat', 'trim|required',[
			'required'		=> 'alamat tidak boleh kosong'
		]);
	}

	public function kota()
	{
		$input = $this->input->post();
		$q  = $this->mc->get_where('city', $input);
		echo json_encode(array(
			'data' => $q->result()
			)
		);
	}
	public function kecamatan(){
		$input 	= $this->input->post();
		$q 		= $this->mc->get_where('subdistrict',$input);
		echo json_encode(array(
			'data' => $q->result()
			)
		);
	}

}

/* End of file Siswa.php */
/* Location: ./application/controllers/admin/master/Siswa.php */
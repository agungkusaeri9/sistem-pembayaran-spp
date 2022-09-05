<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

use Carbon\Carbon;
Carbon::setLocale('id');
class siswa extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_siswa','siswa');
		$this->load->model('M_kelas','kelas');
		$this->load->model('M_jurusan','jurusan');
		$this->load->model('M_user','user');
		$this->load->model('M_tahun_pelajaran','tahun_pelajaran');
        $this->load->library('form_validation');
		$this->load->library('session');
		auth();
    }
    public function index()
    {
        $data['title'] = 'Siswa';
		$data['content'] = 'pages/siswa/index';
		$data['menu'] = 'Siswa';
		$data['submenu'] = 'Data';
        $data['siswa'] = $this->siswa->get()->result();
        $this->load->view('layouts/app',$data);
    }

    public function create()
    {
        $data['title'] = 'Tambah siswa';
		$data['content'] = 'pages/siswa/create';
		$data['menu'] = 'siswa';
		$data['submenu'] = 'Tambah';
		$data['jurusan'] = $this->jurusan->get()->result();
		$data['tahun_pelajaran'] = $this->tahun_pelajaran->get()->result();
        $this->load->view('layouts/app',$data);
    }

    public function store()
    {
        $data = $this->input->post();
        $this->form_validation->set_rules('nama_siswa', 'Nama', 'required');
		$this->form_validation->set_rules('nis', 'NIS', 'required');
		$this->form_validation->set_rules('nisn', 'NISN', 'required');
		$this->form_validation->set_rules('id_tahun_pelajaran', 'Tahun Pelajaran', 'required');
		$this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('agama', 'Agama', 'required');
		$this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
		if($this->input->post('id_siswa'))
		{
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','siswa gagal diupdate.');
				redirect('siswa');
			}

			// update data
			$data = array(
				'nis' => $this->input->post('nis'),
				'nisn' => $this->input->post('nisn'),
				'nama_siswa' => $this->input->post('nama_siswa'),
				'id_kelas' => $this->input->post('id_kelas'),
				'id_tahun_pelajaran' => $this->input->post('id_tahun_pelajaran'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'agama' => $this->input->post('agama'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'nama_ayah' => $this->input->post('nama_ayah'),
				'nama_ibu' => $this->input->post('nama_ibu'),
				'alamat_orang_tua' => $this->input->post('alamat_orang_tua'),
			);

			$id_siswa = $this->input->post('id_siswa');

			$action = $this->siswa->update($id_siswa,$data);
			if($action)
			{
				$this->session->set_flashdata('success','Siswa berhasil di update.');
            	redirect('siswa');
			}else{
				$this->session->set_flashdata('error','Siswa gagal di update.');
            	redirect('siswa');
			}
			
		}else{
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$data = array(
				'nis' => $this->input->post('nis'),
				'nisn' => $this->input->post('nisn'),
				'nama_siswa' => $this->input->post('nama_siswa'),
				'id_kelas' => $this->input->post('id_kelas'),
				'id_tahun_pelajaran' => $this->input->post('id_tahun_pelajaran'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'agama' => $this->input->post('agama'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'nama_ayah' => $this->input->post('nama_ayah'),
				'nama_ibu' => $this->input->post('nama_ibu'),
				'alamat_orang_tua' => $this->input->post('alamat_orang_tua'),
			);
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','Siswa gagal di tambahkan.');
				redirect('siswa');
			}
			$ceksiswa = $this->siswa->find(array('nisn' => $data['nisn']));
			if($ceksiswa->num_rows() > 0)
			{
				$this->session->set_flashdata('error','Siswa dengan NISN tersebut sudah ada.');
				redirect('siswa');
			}
            $id_siswa = $this->siswa->create($data);
			$siswa = $this->siswa->find(array('id_siswa' => $id_siswa))->row();
			if($id_siswa)
			{
				$dataUser = array(
					'nama' => $siswa->nama_siswa,
					'username' => $this->input->post('username'),
					'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
					'level' => 'siswa',
					'id_siswa' => $id_siswa
				);
				// akun siswa
				$this->user->create($dataUser);
				$this->session->set_flashdata('success','Siswa berhasil di tambahkan.');
            	redirect('siswa');
			}else{
				$this->session->set_flashdata('error','Siswa gagal di tambahkan.');
            	redirect('siswa');
			}
		}
    }

	public function edit($id)
    {
		$siswa = $this->siswa->find(array('id_siswa' => $id))->row();
		if(!$siswa)
		{
			$this->session->set_flashdata('error','siswa tidak ditemukan.');
			redirect('siswa');
		}
        $data['title'] = 'Edit siswa';
		$data['content'] = 'pages/siswa/edit';
		$data['menu'] = 'siswa';
		$data['submenu'] = 'Edit';
		$data['siswa'] = $siswa;
		$data['jurusan'] = $this->jurusan->get()->result();
		$data['kelas'] = $this->kelas->get()->result();
		$data['tahun_pelajaran'] = $this->tahun_pelajaran->get()->result();
        $this->load->view('layouts/app',$data);
    }

	public function delete($id)
	{
		if(!$id)
		{
			$this->session->set_flashdata('error','siswa gagal di hapus.');
			redirect('siswa');
		}
		$siswa = $this->siswa->find(array('id_siswa' => $id))->row();

		$this->siswa->delete($id);
		$this->session->set_flashdata('success','siswa berhasil dihapus.');
		redirect('siswa');
	}

	public function getByKelas($id_kelas = NULL)
	{
		if(!$this->input->is_ajax_request()){
			redirect('/');
		}

		$siswa = $this->siswa->find(array('sis.id_kelas' => $id_kelas))->result();
		echo json_encode($siswa);
	}

}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class User extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user','user');
        $this->load->library('form_validation');
		$this->load->library('session');
		auth();
    }
    public function index()
    {
        $data['title'] = 'User';
		$data['content'] = 'pages/user/index';
		$data['menu'] = 'User';
		$data['submenu'] = 'Data';
        $data['user'] = $this->user->get()->result();
        $this->load->view('layouts/app',$data);
    }

    public function create()
    {
        $data['title'] = 'Tambah User';
		$data['content'] = 'pages/user/create';
		$data['menu'] = 'User';
		$data['submenu'] = 'Tambah';
        $this->load->view('layouts/app',$data);
    }

    public function store()
    {
        $data = $this->input->post();
        $this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('level', 'Level', 'required');
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$level = $this->input->post('level');
		$konfirmasi_password = $this->input->post('konfirmasi_password');
		if($this->input->post('id_user'))
		{
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','User gagal diupdate.');
				redirect('user');
			}
			$id_user = $this->input->post('id_user');
			$cekUser = $this->user->find(array('username' => $username));
			if($password)
			{
				$passwordBaru = password_hash($password,PASSWORD_DEFAULT);
			}else{
				$passwordBaru = $cekUser->row()->password;
			}
			$dataUser = array(
				'nama' => $nama,
				'username' => $username,
				'password' => $passwordBaru,
				'level' => $level
			);

			$action = $this->user->update($id_user,$dataUser);
			if($action)
			{
				$this->session->set_flashdata('success','User berhasil di update.');
            	redirect('user');
			}else{
				$this->session->set_flashdata('error','User gagal di update.');
            	redirect('user');
			}
			
		}else{
			$this->form_validation->set_rules('password', 'Password', 'required');
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','User gagal di tambahkan.');
				redirect('user');
			}
			if($password !== $konfirmasi_password)
			{
				$this->session->set_flashdata('error','Password dan Konfirmasi Password tidak sesuai.');
				redirect('user');
			}
			$cekUser = $this->user->find(array('username' => $username))->num_rows();
			if($cekUser > 0)
			{
				$this->session->set_flashdata('error','Username yang anda masukan sudah terdaftar sebelumnya.');
				redirect('user');
			}
			$dataUser = array(
				'nama' => $nama,
				'username' => $username,
				'password' => password_hash($password,PASSWORD_DEFAULT),
				'level' => $level
			);
            $action = $this->user->create($dataUser);
			if($action)
			{
				$this->session->set_flashdata('success','User berhasil di tambahkan.');
            	redirect('user');
			}else{
				$this->session->set_flashdata('error','User gagal di tambahkan.');
            	redirect('user');
			}
		}
    }

	public function edit($id)
    {
		$user = $this->user->find(array('id_user' => $id))->row();
		if(!$user)
		{
			$this->session->set_flashdata('error','User tidak ditemukan.');
			redirect('user');
		}
        $data['title'] = 'Edit User';
		$data['content'] = 'pages/user/edit';
		$data['menu'] = 'User';
		$data['submenu'] = 'Edit';
		$data['user'] = $user;
        $this->load->view('layouts/app',$data);
    }

	public function delete($id)
	{
		if(!$id)
		{
			$this->session->set_flashdata('error','User gagal di hapus.');
			redirect('user');
		}
		$user = $this->user->find(array('id_user' => $id))->row();

		$this->user->delete($id);
		$this->session->set_flashdata('success','User berhasil dihapus.');
		redirect('user');
	}

}


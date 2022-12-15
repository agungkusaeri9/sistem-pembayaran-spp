<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
		$this->load->model('M_auth','auth');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Login | SMK Citeko Kaler';
        $data['content'] = 'auth/pages/login';
        $this->load->view('auth/layouts/app',$data);
    }

    public function process_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', 'Username dan Password tidak boleh kosong!');
            redirect('auth');
        }else{
            $this->_process_login();
        }
    }

    private function _process_login()
    {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$cekEmail = $this->auth->check(array('username' => $username))->row();
		if($cekEmail)
		{
			if(password_verify($password,$cekEmail->password))
			{
				$session = array(
					'id' => $cekEmail->id_user,
					'nama' => $cekEmail->nama,
					'username' => $cekEmail->username,
					'level' => $cekEmail->level,
					'id_siswa' => $cekEmail->id_siswa
				);
				$this->session->set_userdata($session);
				
				redirect('dashboard');
			}else{
				$this->session->set_flashdata('error', 'Username yang anda masukan salah');
            	redirect('auth');
			}
		}else{
			$this->session->set_flashdata('error', 'Username yang anda masukan salah');
            redirect('auth');
		}

    }

    public function register()
    {
        $data['title'] = 'Register | SMK Citeko Kaler';
        $data['content'] = 'auth/pages/register';
        $this->load->view('auth/layouts/app',$data);
    }

    public function process_register()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('password_confirmation', 'Konfirmasi Password', 'required');
        if($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('error', 'Pastikan semua diisi.');
            redirect('auth/register');
        }else{
            $this->_process_register();
        }
    }

    private function _process_register()
    {
        $this->load->model('M_user','user');
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $password = $this->input->post('password');
        $password_confirmation = $this->input->post('password_confirmation');

		if(strlen($password) < 5)
		{
			$this->session->set_flashdata('error', 'Password minimal 5 karakter.');
            redirect('auth/register');
		}

        if($password !== $password_confirmation)
        {
            $this->session->set_flashdata('error', 'Password dan Konfirmasi Password tidak sama.');
            redirect('auth/register');
        }

        $cekEmail = $this->auth->check(array('email' => $email))->num_rows();
        if($cekEmail)
        {
            $this->session->set_flashdata('error', 'Email sudah terdaftar.');
            redirect('auth/register');
        }

        // proses register
        $data = [
            'name' => $name,
            'email' => $email,
            'username' => strtolower(str_replace(" ","",$name)),
            'password' => password_hash($password,PASSWORD_BCRYPT),
            'role_id' => 2,
            'created_at' => date('Y-m-d')
        ];
        $action = $this->user->create($data);
        if($action)
        {
            $this->session->set_flashdata('success', 'Anda berhasil registrasi.');
            redirect('auth');
        }

    }

	function logout(){
		$this->session->sess_destroy();
		$session = array(
			'id' => '',
			'nama' => '',
			'username' => '',
			'level' => ''
		);
		$this->session->unset_userdata($session);
		redirect('/');
	}

}

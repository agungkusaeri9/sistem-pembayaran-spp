<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Tenaga_kependidikan extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tenaga_kependidikan','tenaga_kependidikan');
        $this->load->library('form_validation');
		$this->load->library('session');
		auth();
    }
    public function index()
    {
        $data['title'] = 'Tenaga Pendidikan';
		$data['content'] = 'pages/tenaga_kependidikan/index';
		$data['menu'] = 'Tenaga Pendidikan';
		$data['submenu'] = 'Data';
        $data['tenaga_kependidikan'] = $this->tenaga_kependidikan->get()->result();
        $this->load->view('layouts/app',$data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Tenaga Kependidikan';
		$data['content'] = 'pages/tenaga_kependidikan/create';
		$data['menu'] = 'Tenaga Kependidikan';
		$data['submenu'] = 'Tambah';
        $this->load->view('layouts/app',$data);
    }

    public function store()
    {
        $data = $this->input->post();
        $this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('no_induk', 'No. Induk', 'required');
		if($this->input->post('id_tenaga_kependidikan'))
		{
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','tenaga_kependidikan gagal diupdate.');
				redirect('tenaga_kependidikan');
			}

			// update data
			$data = array(
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'jabatan' => $this->input->post('jabatan'),
				'no_induk' => $this->input->post('no_induk')
			);
			$id_tenaga_kependidikan = $this->input->post('id_tenaga_kependidikan');

			$action = $this->tenaga_kependidikan->update($id_tenaga_kependidikan,$data);
			if($action)
			{
				$this->session->set_flashdata('success','tenaga_kependidikan berhasil di update.');
            	redirect('tenaga_kependidikan');
			}else{
				$this->session->set_flashdata('error','tenaga_kependidikan gagal di update.');
            	redirect('tenaga_kependidikan');
			}
			
		}else{
			$data = array(
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'jabatan' => $this->input->post('jabatan'),
				'no_induk' => $this->input->post('no_induk')
			);
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','Tenaga Kependidikan gagal di tambahkan.');
				redirect('tenaga_kependidikan');
			}
            $action = $this->tenaga_kependidikan->create($data);
			if($action)
			{
				$this->session->set_flashdata('success','Tenaga Kependidikan berhasil di tambahkan.');
            	redirect('tenaga_kependidikan');
			}else{
				$this->session->set_flashdata('error','Tenaga Kependidikan gagal di tambahkan.');
            	redirect('tenaga_kependidikan');
			}
		}
    }

	public function edit($id)
    {
		$tenaga_kependidikan = $this->tenaga_kependidikan->find(array('id_tenaga_kependidikan' => $id))->row();
		if(!$tenaga_kependidikan)
		{
			$this->session->set_flashdata('error','Tenaga Kependidikan tidak ditemukan.');
			redirect('tenaga_kependidikan');
		}
        $data['title'] = 'Edit Tenaga Kependidikan';
		$data['content'] = 'pages/tenaga_kependidikan/edit';
		$data['menu'] = 'Tenaga Kependidikan';
		$data['submenu'] = 'Edit';
		$data['tenaga_kependidikan'] = $tenaga_kependidikan;
        $this->load->view('layouts/app',$data);
    }

	public function delete($id)
	{
		if(!$id)
		{
			$this->session->set_flashdata('error','tenaga_kependidikan gagal di hapus.');
			redirect('tenaga_kependidikan');
		}
		$tenaga_kependidikan = $this->tenaga_kependidikan->find(array('id_tenaga_kependidikan' => $id))->row();

		$this->tenaga_kependidikan->delete($id);
		$this->session->set_flashdata('success','tenaga_kependidikan berhasil dihapus.');
		redirect('tenaga_kependidikan');
	}

}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Jurusan extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_jurusan','jurusan');
        $this->load->library('form_validation');
		$this->load->library('session');
		auth();
    }
    public function index()
    {
        $data['title'] = 'Jurusan';
		$data['content'] = 'pages/jurusan/index';
		$data['menu'] = 'Jurusan';
		$data['submenu'] = 'Data';
        $data['jurusan'] = $this->jurusan->get()->result();
        $this->load->view('layouts/app',$data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Jurusan';
		$data['content'] = 'pages/jurusan/create';
		$data['menu'] = 'Jurusan';
		$data['submenu'] = 'Tambah';
        $this->load->view('layouts/app',$data);
    }

    public function store()
    {
        $data = $this->input->post();
        $this->form_validation->set_rules('nama_jurusan', 'Nama', 'required');
		if($this->input->post('id_jurusan'))
		{
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','Jurusan gagal diupdate.');
				redirect('jurusan');
			}

			// update data
			$data = array(
				'nama_jurusan' => $this->input->post('nama_jurusan')
			);
			$id_jurusan = $this->input->post('id_jurusan');

			$action = $this->jurusan->update($id_jurusan,$data);
			if($action)
			{
				$this->session->set_flashdata('success','Jurusan berhasil di update.');
            	redirect('jurusan');
			}else{
				$this->session->set_flashdata('error','Jurusan gagal di update.');
            	redirect('jurusan');
			}
			
		}else{
			$data = $this->input->post();
			$this->form_validation->set_rules('nama_jurusan', 'Nama Jurusan', 'required');
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','Jurusan gagal di tambahkan.');
				redirect('jurusan');
			}
            $action = $this->jurusan->create($data);
			if($action)
			{
				$this->session->set_flashdata('success','Jurusan berhasil di tambahkan.');
            	redirect('jurusan');
			}else{
				$this->session->set_flashdata('error','Jurusan gagal di tambahkan.');
            	redirect('jurusan');
			}
		}
    }

	public function edit($id)
    {
		$jurusan = $this->jurusan->find(array('id_jurusan' => $id))->row();
		if(!$jurusan)
		{
			$this->session->set_flashdata('error','Jurusan tidak ditemukan.');
			redirect('jurusan');
		}
        $data['title'] = 'Edit Jurusan';
		$data['content'] = 'pages/jurusan/edit';
		$data['menu'] = 'Jurusan';
		$data['submenu'] = 'Edit';
		$data['jurusan'] = $jurusan;
        $this->load->view('layouts/app',$data);
    }

	public function delete($id)
	{
		if(!$id)
		{
			$this->session->set_flashdata('error','Jurusan gagal di hapus.');
			redirect('jurusan');
		}
		$jurusan = $this->jurusan->find(array('id_jurusan' => $id))->row();

		$this->jurusan->delete($id);
		$this->session->set_flashdata('success','Jurusan berhasil dihapus.');
		redirect('jurusan');
	}

}


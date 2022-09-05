<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Tahun_pelajaran extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_tahun_pelajaran','tahun_pelajaran');
        $this->load->library('form_validation');
		$this->load->library('session');
		auth();
    }
    public function index()
    {
        $data['title'] = 'Tahun Pelajaran';
		$data['content'] = 'pages/tahun_pelajaran/index';
		$data['menu'] = 'Tahun Pelajaran';
		$data['submenu'] = 'Data';
        $data['tahun_pelajaran'] = $this->tahun_pelajaran->get()->result();
        $this->load->view('layouts/app',$data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Tahun Pelajaran';
		$data['content'] = 'pages/tahun_pelajaran/create';
		$data['menu'] = 'Tahun Pelajaran';
		$data['submenu'] = 'Tambah';
        $this->load->view('layouts/app',$data);
    }

    public function store()
    {
        $data = $this->input->post();
        $this->form_validation->set_rules('tahun', 'Nama', 'required');
		if($this->input->post('id_tahun_pelajaran'))
		{
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','tahun_pelajaran gagal diupdate.');
				redirect('tahun_pelajaran');
			}

			// update data
			$data = array(
				'tahun' => $this->input->post('tahun')
			);
			$id_tahun_pelajaran = $this->input->post('id_tahun_pelajaran');

			$action = $this->tahun_pelajaran->update($id_tahun_pelajaran,$data);
			if($action)
			{
				$this->session->set_flashdata('success','Tahun Pelajaran berhasil di update.');
            	redirect('tahun_pelajaran');
			}else{
				$this->session->set_flashdata('error','Tahun Pelajaran gagal di update.');
            	redirect('tahun_pelajaran');
			}
			
		}else{
			$data = $this->input->post();
			$this->form_validation->set_rules('tahun', 'Tahun tahun_pelajaran', 'required');
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','Tahun Pelajaran gagal di tambahkan.');
				redirect('tahun_pelajaran');
			}
            $action = $this->tahun_pelajaran->create($data);
			if($action)
			{
				$this->session->set_flashdata('success','Tahun Pelajaran berhasil di tambahkan.');
            	redirect('tahun_pelajaran');
			}else{
				$this->session->set_flashdata('error','Tahun Pelajaran gagal di tambahkan.');
            	redirect('tahun_pelajaran');
			}
		}
    }

	public function edit($id)
    {
		$tahun_pelajaran = $this->tahun_pelajaran->find(array('id_tahun_pelajaran' => $id))->row();
		if(!$tahun_pelajaran)
		{
			$this->session->set_flashdata('error','Tahun Pelajaran tidak ditemukan.');
			redirect('tahun_pelajaran');
		}
        $data['title'] = 'Edit Tahun Pelajaran';
		$data['content'] = 'pages/tahun_pelajaran/edit';
		$data['menu'] = 'Tahun Pelajaran';
		$data['submenu'] = 'Edit';
		$data['tahun_pelajaran'] = $tahun_pelajaran;
        $this->load->view('layouts/app',$data);
    }

	public function delete($id)
	{
		if(!$id)
		{
			$this->session->set_flashdata('error','tahun_pelajaran gagal di hapus.');
			redirect('tahun_pelajaran');
		}
		$tahun_pelajaran = $this->tahun_pelajaran->find(array('id_tahun_pelajaran' => $id))->row();

		$this->tahun_pelajaran->delete($id);
		$this->session->set_flashdata('success','tahun_pelajaran berhasil dihapus.');
		redirect('tahun_pelajaran');
	}

}


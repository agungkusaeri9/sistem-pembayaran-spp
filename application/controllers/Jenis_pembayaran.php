<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class jenis_pembayaran extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_jenis_pembayaran','jenis_pembayaran');
		$this->load->model('M_tahun_pelajaran','tahun_pelajaran');
        $this->load->library('form_validation');
		$this->load->library('session');
		auth();
    }
    public function index()
    {
        $data['title'] = 'Jenis Pembayaran';
		$data['content'] = 'pages/jenis_pembayaran/index';
		$data['menu'] = 'Jenis Pembayaran';
		$data['submenu'] = 'Data';
        $data['jenis_pembayaran'] = $this->jenis_pembayaran->get()->result();
		// var_dump($data['jenis_pembayaran']);
		// die();
        $this->load->view('layouts/app',$data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Jenis Pembayaran';
		$data['content'] = 'pages/jenis_pembayaran/create';
		$data['menu'] = 'Jenis Pembayaran';
		$data['submenu'] = 'Tambah';
		$data['tahun_pelajaran'] = $this->tahun_pelajaran->get()->result();
        $this->load->view('layouts/app',$data);
    }

    public function store()
    {
        $data = $this->input->post();
        $this->form_validation->set_rules('nama_jenis', 'Nama Jenis', 'required');
		$this->form_validation->set_rules('nominal', 'Nominal', 'required');
		$this->form_validation->set_rules('id_tahun_pelajaran', 'Tahun Pelajaran', 'required');
		if($this->input->post('id_jenis_pembayaran'))
		{
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','jenis_pembayaran gagal diupdate.');
				redirect('jenis_pembayaran');
			}

			// update data
			$data = array(
				'nama_jenis' => $this->input->post('nama_jenis'),
				'nominal' => $this->input->post('nominal'),
				'id_tahun_pelajaran' => $this->input->post('id_tahun_pelajaran')
			);

			$id_jenis_pembayaran = $this->input->post('id_jenis_pembayaran');

			$action = $this->jenis_pembayaran->update($id_jenis_pembayaran,$data);
			if($action)
			{
				$this->session->set_flashdata('success','Jenis Pembayaran berhasil di update.');
            	redirect('jenis_pembayaran');
			}else{
				$this->session->set_flashdata('error','Jenis Pembayaran gagal di update.');
            	redirect('jenis_pembayaran');
			}
			
		}else{
			$data = array(
				'nama_jenis' => $this->input->post('nama_jenis'),
				'nominal' => $this->input->post('nominal'),
				'id_tahun_pelajaran' => $this->input->post('id_tahun_pelajaran')
			);
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','Jenis Pembayaran gagal di tambahkan.');
				redirect('jenis_pembayaran');
			}
			$cekjenis_pembayaran = $this->jenis_pembayaran->find(array('nama_jenis' => $data['nama_jenis'],'id_tahun_pelajaran' => $data['id_tahun_pelajaran']));
			if($cekjenis_pembayaran->num_rows() > 0)
			{
				$this->session->set_flashdata('error','Jenis Pembayaran dengan jurusan tersebut sudah ada.');
				redirect('jenis_pembayaran');
			}
            $action = $this->jenis_pembayaran->create($data);
			if($action)
			{
				$this->session->set_flashdata('success','Jenis Pembayaran berhasil di tambahkan.');
            	redirect('jenis_pembayaran');
			}else{
				$this->session->set_flashdata('error','Jenis Pembayaran gagal di tambahkan.');
            	redirect('jenis_pembayaran');
			}
		}
    }

	public function edit($id)
    {
		$jenis_pembayaran = $this->jenis_pembayaran->find(array('id_jenis_pembayaran' => $id))->row();
		if(!$jenis_pembayaran)
		{
			$this->session->set_flashdata('error','Jenis Pembayaran tidak ditemukan.');
			redirect('jenis_pembayaran');
		}
        $data['title'] = 'Edit Jenis Pembayaran';
		$data['content'] = 'pages/jenis_pembayaran/edit';
		$data['menu'] = 'Jenis Pembayaran';
		$data['submenu'] = 'Edit';
		$data['jenis_pembayaran'] = $jenis_pembayaran;
		$data['tahun_pelajaran'] = $this->tahun_pelajaran->get()->result();
        $this->load->view('layouts/app',$data);
    }

	public function delete($id)
	{
		if(!$id)
		{
			$this->session->set_flashdata('error','jenis_pembayaran gagal di hapus.');
			redirect('jenis_pembayaran');
		}
		$jenis_pembayaran = $this->jenis_pembayaran->find(array('id_jenis_pembayaran' => $id))->row();

		$this->jenis_pembayaran->delete($id);
		$this->session->set_flashdata('success','jenis_pembayaran berhasil dihapus.');
		redirect('jenis_pembayaran');
	}

	public function getByTahunPelajaran($id_tahun_pelajaran)
	{
		if(!$this->input->is_ajax_request()){
			redirect('/');
		}

		$jenis_pembayaran = $this->jenis_pembayaran->find(array('id_tahun_pelajaran' => $id_tahun_pelajaran))->result();
		echo json_encode($jenis_pembayaran);
	}

}


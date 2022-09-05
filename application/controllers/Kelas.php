<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Kelas extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_kelas','kelas');
		$this->load->model('M_jurusan','jurusan');
        $this->load->library('form_validation');
		$this->load->library('session');
		auth();
    }
    public function index()
    {
        $data['title'] = 'Kelas';
		$data['content'] = 'pages/kelas/index';
		$data['menu'] = 'kelas';
		$data['submenu'] = 'Data';
        $data['kelas'] = $this->kelas->get()->result();
		// var_dump($data['kelas']);
		// die();
        $this->load->view('layouts/app',$data);
    }

    public function create()
    {
        $data['title'] = 'Tambah kelas';
		$data['content'] = 'pages/kelas/create';
		$data['menu'] = 'kelas';
		$data['submenu'] = 'Tambah';
		$data['jurusan'] = $this->jurusan->get()->result();
        $this->load->view('layouts/app',$data);
    }

    public function store()
    {
        $data = $this->input->post();
        $this->form_validation->set_rules('nama_kelas', 'Nama', 'required');
		$this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required');
		if($this->input->post('id_kelas'))
		{
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','kelas gagal diupdate.');
				redirect('kelas');
			}

			// update data
			$data = array(
				'nama_kelas' => $this->input->post('nama_kelas'),
				'id_jurusan' => $this->input->post('id_jurusan')
			);

			$id_kelas = $this->input->post('id_kelas');

			$action = $this->kelas->update($id_kelas,$data);
			if($action)
			{
				$this->session->set_flashdata('success','kelas berhasil di update.');
            	redirect('kelas');
			}else{
				$this->session->set_flashdata('error','kelas gagal di update.');
            	redirect('kelas');
			}
			
		}else{
			$data = array(
				'nama_kelas' => $this->input->post('nama_kelas'),
				'id_jurusan' => $this->input->post('id_jurusan')
			);
			$this->form_validation->set_rules('nama_kelas', 'Nama kelas', 'required');
			$this->form_validation->set_rules('id_jurusan', 'Jurusan', 'required');
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','kelas gagal di tambahkan.');
				redirect('kelas');
			}
			$cekKelas = $this->kelas->find(array('nama_kelas' => $data['nama_kelas'],'id_jurusan' => $data['id_jurusan']));
			if($cekKelas->num_rows() > 0)
			{
				$this->session->set_flashdata('error','kelas dengan jurusan tersebut sudah ada.');
				redirect('kelas');
			}
            $action = $this->kelas->create($data);
			if($action)
			{
				$this->session->set_flashdata('success','kelas berhasil di tambahkan.');
            	redirect('kelas');
			}else{
				$this->session->set_flashdata('error','kelas gagal di tambahkan.');
            	redirect('kelas');
			}
		}
    }

	public function edit($id)
    {
		$kelas = $this->kelas->find(array('id_kelas' => $id))->row();
		if(!$kelas)
		{
			$this->session->set_flashdata('error','kelas tidak ditemukan.');
			redirect('kelas');
		}
        $data['title'] = 'Edit kelas';
		$data['content'] = 'pages/kelas/edit';
		$data['menu'] = 'kelas';
		$data['submenu'] = 'Edit';
		$data['kelas'] = $kelas;
		$data['jurusan'] = $this->jurusan->get()->result();
        $this->load->view('layouts/app',$data);
    }

	public function delete($id)
	{
		if(!$id)
		{
			$this->session->set_flashdata('error','kelas gagal di hapus.');
			redirect('kelas');
		}
		$kelas = $this->kelas->find(array('id_kelas' => $id))->row();

		$this->kelas->delete($id);
		$this->session->set_flashdata('success','kelas berhasil dihapus.');
		redirect('kelas');
	}

	public function geByJurusan($id_jurusan = NULL)
	{
		if(!$this->input->is_ajax_request()){
			redirect('/');
		}

		if($id_jurusan)
		{
			$kelas = $this->kelas->find(array('id_jurusan' => $id_jurusan))->result();
		}else{
			$kelas = $this->kelas->get()->result();
		}
		echo json_encode($kelas);
	}

	public function getKelas($id_kelas)
	{
		if(!$this->input->is_ajax_request()){
			redirect('/');
		}

		$kelas = $this->kelas->find(array('id_kelas' => $id_kelas))->row();
		echo json_encode($kelas);
	}

}


<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Pembayaran extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pembayaran','pembayaran');
		$this->load->model('M_kelas','kelas');
		$this->load->model('M_siswa','siswa');
		$this->load->model('M_jurusan','jurusan');
		$this->load->model('M_tahun_pelajaran','tahun_pelajaran');
		$this->load->model('M_jenis_pembayaran','jenis_pembayaran');
		$this->load->model('M_pembayaran_tahun_pelajaran','pembayaran_tahun_pelajaran');
        $this->load->library('form_validation');
		$this->load->library('session');
		auth();
		$this->load->helper('my');
    }
    public function index()
    {
        $data['title'] = 'Pembayaran';
		$data['content'] = 'pages/pembayaran/index';
		$data['menu'] = 'Pembayaran';
		$data['submenu'] = 'Data';
       if($this->session->userdata('level') === 'admin' || $this->session->userdata('level') === 'bendahara')
	   {
		$data['pembayaran'] = $this->pembayaran->get()->result();
	   }else{
		$id_tahun_pelajaran = $this->input->post('id_tahun_pelajaran');
		if($id_tahun_pelajaran)
		{
			$data['pembayaran'] = $this->pembayaran->find(array('pmb.id_siswa' => $this->session->userdata('id_siswa'),'tp.id_tahun_pelajaran' => $id_tahun_pelajaran))->result();
			$data['id_tahun_pelajaran'] = $id_tahun_pelajaran;
			$data['id_siswa'] = $this->session->userdata('id_siswa');
		}else{

			$data['pembayaran'] = $this->pembayaran->find(array('pmb.id_siswa' => $this->session->userdata('id_siswa')))->result();
			$data['id_siswa'] = $this->session->userdata('id_siswa');
		}
		$data['tahun_pelajaran'] = $this->tahun_pelajaran->get()->result();
	   }
        $this->load->view('layouts/app',$data);
    }

	public function create()
    {
        $data['title'] = 'Tambah Pembayaran';
		$data['content'] = 'pages/pembayaran/create';
		$data['menu'] = 'Pembayaran';
		$data['submenu'] = 'Tambah';
		$data['siswa'] = $this->siswa->get()->result();
		$data['jenis_pembayaran'] = $this->jenis_pembayaran->get()->result();
		$data['jurusan'] = $this->jurusan->get()->result();
		$data['tahun_pelajaran'] = $this->tahun_pelajaran->get()->result();
		$data['pembayaran_tahun_pelajaran'] = $this->pembayaran_tahun_pelajaran->get()->result();
        $this->load->view('layouts/app',$data);
    }

    public function store()
    {
		if($this->input->post('id_pembayaran'))
		{
			$this->form_validation->set_rules('id_pembayaran', 'ID Pembayaran', 'required');
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','Pembayaran gagal diupdate.');
				redirect('pembayaran');
			}

			// update data
			$data = array(
				'status' => $this->input->post('status')
			);

			$id_pembayaran = $this->input->post('id_pembayaran');

			$action = $this->pembayaran->update($id_pembayaran,$data);
			if($action)
			{
				$this->session->set_flashdata('success','Pembayaran berhasil di update.');
            	redirect('pembayaran');
			}else{
				$this->session->set_flashdata('error','Pembayaran gagal di update.');
            	redirect('pembayaran');
			}
			
		}else{
			$this->form_validation->set_rules('id_siswa', 'Siswa', 'required');
			// $this->form_validation->set_rules('id_pembayaran_tahun_pelajaran', 'Pembayaran Tahun Pelajaran', 'required');
			$jenis_pembayaran = $this->jenis_pembayaran->find(array('id_jenis_pembayaran' => $this->input->post('id_jenis_pembayaran')))->row();
			$nominal = $jenis_pembayaran->nominal;
			if($this->form_validation->run() == false)
			{
				$this->session->set_flashdata('error','Pembayaran gagal di tambahkan.');
				redirect('pembayaran');
			}
			$ptp = $this->input->post('id_pembayaran_tahun_pelajaran');
			foreach($ptp as $pt)
			{
				$data = array(
					'id_siswa' => $this->input->post('id_siswa'),
					'id_pembayaran_tahun_pelajaran' => $pt,
					'nominal' => $nominal,
					'status' => 1,
					'tanggal_pembayaran' => date('Y-m-d')
				);
				$action = $this->pembayaran->create($data);
			}
			if($action)
			{
				$this->session->set_flashdata('success','Pembayaran berhasil di tambahkan.');
            	redirect('pembayaran');
			}else{
				$this->session->set_flashdata('error','Pembayaran gagal di tambahkan.');
            	redirect('pembayaran');
			}
		}
    }

	public function edit($id)
    {
		$pembayaran = $this->pembayaran->find(array('id_pembayaran' => $id))->row();
		if(!$pembayaran)
		{
			$this->session->set_flashdata('error','Pembayaran tidak ditemukan.');
			redirect('pembayaran');
		}
        $data['title'] = 'Edit Pembayaran';
		$data['content'] = 'pages/pembayaran/edit';
		$data['menu'] = 'Pembayaran';
		$data['submenu'] = 'Edit';
		$data['pembayaran'] = $pembayaran;
		$data['jurusan'] = $this->jurusan->get()->result();
        $this->load->view('layouts/app',$data);
    }

	public function delete($id)
	{
		if(!$id)
		{
			$this->session->set_flashdata('error','Pembayaran gagal di hapus.');
			redirect('pembayaran');
		}
		$pembayaran = $this->pembayaran->find(array('id_pembayaran' => $id))->row();

		$this->pembayaran->delete($id);
		$this->session->set_flashdata('success','Pembayaran berhasil dihapus.');
		redirect('pembayaran');
	}

	public function geByJurusan($id_jurusan)
	{
		if(!$this->input->is_ajax_request()){
			redirect('/');
		}

		$kelas = $this->kelas->find(array('id_jurusan' => $id_jurusan))->result();
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

<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pembayaran_tahun_pelajaran extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_pembayaran_tahun_pelajaran', 'pembayaran_tahun_pelajaran');
		$this->load->model('M_jenis_pembayaran', 'jenis_pembayaran');
		$this->load->model('M_tahun_pelajaran', 'tahun_pelajaran');
		$this->load->library('form_validation');
		$this->load->library('session');
		auth();

		$this->load->helper('my');
	}
	public function index()
	{
		$data['title'] = 'Pembayaran Tahun Pelajaran';
		$data['content'] = 'pages/pembayaran_tahun_pelajaran/index';
		$data['menu'] = 'Pembayaran Tahun Pelajaran';
		$data['submenu'] = 'Data';
		$data['pembayaran_tahun_pelajaran'] = $this->pembayaran_tahun_pelajaran->get()->result();
		$this->load->view('layouts/app', $data);
	}

	public function create()
	{
		$data['title'] = 'Tambah Pembayaran Tahun Pelajaran';
		$data['content'] = 'pages/pembayaran_tahun_pelajaran/create';
		$data['menu'] = 'Pembayaran Tahun Pelajaran';
		$data['submenu'] = 'Tambah';
		$data['tahun_pelajaran'] = $this->tahun_pelajaran->get()->result();
		$data['jenis_pembayaran'] = $this->jenis_pembayaran->get()->result();
		$data['bulan'] = data_bulan();

		$this->load->view('layouts/app', $data);
	}

	public function store()
	{
		$data = $this->input->post();
		$this->form_validation->set_rules('id_tahun_pelajaran', 'Tahun Pelajaran', 'required');
		$this->form_validation->set_rules('id_jenis_pembayaran', 'Jenis Pembayaran', 'required');
		
		if ($this->input->post('id_pembayaran_tahun_pelajaran')) {
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('error', 'pembayaran_tahun_pelajaran gagal diupdate.');
				redirect('pembayaran_tahun_pelajaran');
			}

			// update data
			$data = array(
				'id_tahun_pelajaran' => $this->input->post('id_tahun_pelajaran'),
				'id_jenis_pembayaran' => $this->input->post('id_jenis_pembayaran'),
				'bulan' => $this->input->post('bulan'),
			);

			$id_pembayaran_tahun_pelajaran = $this->input->post('id_pembayaran_tahun_pelajaran');

			$action = $this->pembayaran_tahun_pelajaran->update($id_pembayaran_tahun_pelajaran, $data);
			if ($action) {
				$this->session->set_flashdata('success', 'Pembayaran Tahun Pelajaran berhasil di update.');
				redirect('pembayaran_tahun_pelajaran');
			} else {
				$this->session->set_flashdata('error', 'Pembayaran Tahun Pelajaran gagal di update.');
				redirect('pembayaran_tahun_pelajaran');
			}
		} else {
			$semua_bulan = $this->input->post('semua_bulan');
			if ($this->form_validation->run() == false) {
				$this->session->set_flashdata('error', 'Pembayaran Tahun Pelajaran gagal di tambahkan.');
				redirect('pembayaran_tahun_pelajaran');
			}
			if($semua_bulan)
			{
				foreach(data_bulan() as $bulan)
				{
					// var_dump($bulan['no']);
					// die();
					$data = array(
						'id_tahun_pelajaran' => $this->input->post('id_tahun_pelajaran'),
						'id_jenis_pembayaran' => $this->input->post('id_jenis_pembayaran'),
						'bulan' => $bulan['no'],
					);
					$action = $this->pembayaran_tahun_pelajaran->create($data);
				}
			}else{
				$this->form_validation->set_rules('bulan', 'Bulan', 'required');
				$data = array(
					'id_tahun_pelajaran' => $this->input->post('id_tahun_pelajaran'),
					'id_jenis_pembayaran' => $this->input->post('id_jenis_pembayaran'),
					'bulan' => $this->input->post('bulan'),
				);
				$action = $this->pembayaran_tahun_pelajaran->create($data);
			}
			
			
			if ($action) {
				$this->session->set_flashdata('success', 'Pembayaran Tahun Pelajaran berhasil di tambahkan.');
				redirect('pembayaran_tahun_pelajaran');
			} else {
				$this->session->set_flashdata('error', 'Pembayaran Tahun Pelajaran gagal di tambahkan.');
				redirect('pembayaran_tahun_pelajaran');
			}
		}
	}

	public function edit($id)
	{
		$pembayaran_tahun_pelajaran = $this->pembayaran_tahun_pelajaran->find(array('id_pembayaran_tahun_pelajaran' => $id))->row();
		if (!$pembayaran_tahun_pelajaran) {
			$this->session->set_flashdata('error', 'Pembayaran Tahun Pelajaran tidak ditemukan.');
			redirect('pembayaran_tahun_pelajaran');
		}
		$data['title'] = 'Edit Pembayaran Tahun Pelajaran';
		$data['content'] = 'pages/pembayaran_tahun_pelajaran/edit';
		$data['menu'] = 'Pembayaran Tahun Pelajaran';
		$data['submenu'] = 'Edit';
		$data['data'] = $pembayaran_tahun_pelajaran;
		$data['tahun_pelajaran'] = $this->tahun_pelajaran->get()->result();
		$data['jenis_pembayaran'] = $this->jenis_pembayaran->get()->result();
		$data['bulan'] = data_bulan();
		$this->load->view('layouts/app', $data);
	}

	public function delete($id)
	{
		if (!$id) {
			$this->session->set_flashdata('error', 'pembayaran_tahun_pelajaran gagal di hapus.');
			redirect('pembayaran_tahun_pelajaran');
		}
		$pembayaran_tahun_pelajaran = $this->pembayaran_tahun_pelajaran->find(array('id_pembayaran_tahun_pelajaran' => $id))->row();

		$this->pembayaran_tahun_pelajaran->delete($id);
		$this->session->set_flashdata('success', 'Pembayaran Tahun Pelajaran berhasil dihapus.');
		redirect('pembayaran_tahun_pelajaran');
	}

	public function geByJurusan($id_jurusan)
	{
		if (!$this->input->is_ajax_request()) {
			redirect('/');
		}

		$pembayaran_tahun_pelajaran = $this->pembayaran_tahun_pelajaran->find(array('id_jurusan' => $id_jurusan))->result();
		echo json_encode($pembayaran_tahun_pelajaran);
	}

	public function getpembayaran_tahun_pelajaran($id_pembayaran_tahun_pelajaran)
	{
		if (!$this->input->is_ajax_request()) {
			redirect('/');
		}

		$pembayaran_tahun_pelajaran = $this->pembayaran_tahun_pelajaran->find(array('id_pembayaran_tahun_pelajaran' => $id_pembayaran_tahun_pelajaran))->row();
		echo json_encode($pembayaran_tahun_pelajaran);
	}

	public function getByJenisPembayaran($id_jenis_pembayaran)
	{
		if (!$this->input->is_ajax_request()) {
			redirect('/');
		}

		$pembayaran_tahun_pelajaran = $this->pembayaran_tahun_pelajaran->find(array('id_jenis_pembayaran' => $id_jenis_pembayaran))->result();
		echo json_encode($pembayaran_tahun_pelajaran);
	}
	
}

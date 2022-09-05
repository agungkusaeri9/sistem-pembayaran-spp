<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Tagihan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_tahun_pelajaran', 'tahun_pelajaran');
		$this->load->model('M_pembayaran', 'pembayaran');
		$this->load->model('M_pembayaran_tahun_pelajaran', 'pembayaran_tahun_pelajaran');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('my');
		auth();
	}
	public function index()
	{
		$id_tahun_pelajaran = $this->tahun_pelajaran->get()->row()->id_tahun_pelajaran;
		$data['title'] = 'Tagihan';
		$data['content'] = 'pages/tagihan/index';
		$data['menu'] = 'Tagihan';
		$data['submenu'] = 'Data';
		$data['pembayaran_tahun_pelajaran'] = $this->pembayaran_tahun_pelajaran->find2(array('pem.id_tahun_pelajaran' => $id_tahun_pelajaran))->result();
		$this->load->view('layouts/app', $data);
	}

	public function upload_bukti()
	{
		if (!$this->input->post()) {
			redirect('tagihan');
		}

		$id_siswa = $this->input->post('id_siswa');
		$id_pembayaran_tahun_pelajaran = $this->input->post('id_pembayaran_tahun_pelajaran');
		$nominal = $this->input->post('nominal');
		$tanggal_pembayaran = date('Y-m-d');
		$bukti_pembayaran = $_FILES['bukti_pembayaran'];

		if ($bukti_pembayaran['name'] !== '') {
			$config['upload_path']          = './uploads/bukti_pembayaran/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|svg';
			$config['max_size']             = 10000;
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('bukti_pembayaran')) {
				$uploaded_data = $this->upload->data();
				$bukti_pembayaran = $uploaded_data['file_name'];
			}
		} else {
			$this->session->set_flashdata('error', 'Bukti Pembayaran Gagal Diupload');
			redirect('tagihan');
		}

		$data = array(
			'id_siswa' => $id_siswa,
			'id_pembayaran_tahun_pelajaran' => $id_pembayaran_tahun_pelajaran,
			'nominal' => $nominal,
			'bukti_pembayaran' => $bukti_pembayaran,
			'status' => 0,
			'tanggal_pembayaran' => $tanggal_pembayaran
		);

		$action = $this->pembayaran->create($data);
		if ($action) {
			$this->session->set_flashdata('success', 'Bukti Pembayaran berhasil diupload.');
			redirect('tagihan');
		} else {
			$this->session->set_flashdata('error', 'Bukti Pembayaran gagal diupload.');
			redirect('tagihan');
		}
	}
}

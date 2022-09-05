<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Dashboard extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
		auth();
		$this->load->model('M_tahun_pelajaran', 'tahun_pelajaran');
		$this->load->model('M_siswa');
		$this->load->model('M_pembayaran','pembayaran');
		$this->load->model('M_jurusan');
		$this->load->model('M_kelas');
		$this->load->model('M_tenaga_kependidikan');
		$this->load->model('M_jenis_pembayaran');
		$this->load->model('M_pembayaran_tahun_pelajaran', 'pembayaran_tahun_pelajaran');
    }

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['content'] = 'pages/dashboard';
		$data['menu'] = 'Master';
		$data['submenu'] = 'Dashboard';
		$data['count'] = array(
			'siswa' => $this->M_siswa->get()->num_rows(),
			'jurusan' => $this->M_jurusan->get()->num_rows(),
			'kelas' => $this->M_kelas->get()->num_rows(),
			'tenaga_kependidikan' => $this->M_tenaga_kependidikan->get()->num_rows(),
			'jenis_pembayaran' => $this->M_jenis_pembayaran->get()->num_rows(),
		);
		if($this->session->userdata('level') === 'siswa')
		{
			$id_tahun_pelajaran = $this->tahun_pelajaran->get()->row()->id_tahun_pelajaran;
			$data['count'] = array(
				'tagihan' => $this->pembayaran_tahun_pelajaran->find2(array('pem.id_tahun_pelajaran' => $id_tahun_pelajaran))->num_rows(),
				'pembayaran' => $this->pembayaran->find(array('pmb.id_siswa' => $this->session->userdata('id_siswa')))->num_rows()
			);
		}
        $this->load->view('layouts/app',$data);
	}

}


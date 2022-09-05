<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use Carbon\Carbon;
Carbon::setLocale('id');
class Laporan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_siswa', 'siswa');
		$this->load->model('M_kelas', 'kelas');
		$this->load->model('M_jurusan', 'jurusan');
		$this->load->model('M_pembayaran', 'pembayaran');
		$this->load->model('M_tahun_pelajaran', 'tahun_pelajaran');
		$this->load->library('form_validation');
		$this->load->model('M_pembayaran_tahun_pelajaran','pembayaran_tahun_pelajaran');
		$this->load->library('session');
		$this->load->helper('my');
		auth();
	}
	public function siswa()
	{
		$id_jurusan = $this->input->post('id_jurusan');
		$id_kelas = $this->input->post('id_kelas');
		if ($this->input->post()) {
			if ($id_jurusan && $id_kelas) {
				$array = array('jrs.id_jurusan' => $id_jurusan, 'kls.id_kelas' => $id_kelas);
				$data['id_jurusan'] = $id_jurusan;
				$data['id_kelas'] = $id_kelas;
			} else if ($id_jurusan && !$id_kelas) {
				$array = array('jrs.id_jurusan' => $id_jurusan);
				$data['id_jurusan'] = $id_jurusan;
				$data['id_kelas'] = NULL;
			} else if (!$id_jurusan && $id_kelas) {
				$array = array('kls.id_kelas' => $id_kelas);
				$data['id_jurusan'] = NULL;
				$data['id_kelas'] = $id_kelas;
			} else {
				$array = 'all';
				$data['id_jurusan'] = NULL;
				$data['id_kelas'] = NULL;
			}
			if ($array === 'all') {
				$data['siswa'] = $this->siswa->get()->result();
			} else {
				$data['siswa'] = $this->siswa->find($array)->result();
			}
		}else{
			$data['siswa'] = $this->siswa->get()->result();
			$data['id_jurusan'] = NULL;
			$data['id_kelas'] = NULL;
		}

		
		$data['title'] = 'laporan Siswa';
		$data['content'] = 'pages/siswa/laporan';
		$data['menu'] = 'Laporan Siswa';
		$data['submenu'] = 'Data';
		$data['jurusan'] = $this->jurusan->get()->result();
		$this->load->view('layouts/app', $data);
	}

	public function pembayaran()
	{
		$id_tahun_pelajaran = $this->input->post('id_tahun_pelajaran');
		$id_jurusan = $this->input->post('id_jurusan');
		$id_kelas = $this->input->post('id_kelas');
		$id_siswa = $this->input->post('id_siswa');
		if($this->input->post())
		{
			if($id_tahun_pelajaran && $id_jurusan && $id_kelas && $id_siswa)
			{
				$data['pembayaran'] = $this->pembayaran->find(array('tp.id_tahun_pelajaran' => $id_tahun_pelajaran,'sw.id_siswa' => $id_siswa))->result();
				$data['id_tahun_pelajaran'] = $id_tahun_pelajaran;
				$data['id_jurusan'] = $id_jurusan;
				$data['id_kelas'] = $id_kelas;
				$data['id_siswa'] = $id_siswa;
			}elseif($id_tahun_pelajaran && $id_jurusan && $id_kelas){
				// id_tahun_pelajaran,$id_jurusan,$id_kelas
				$data['pembayaran'] = $this->pembayaran->find(array('tp.id_tahun_pelajaran' => $id_tahun_pelajaran,'sw.id_kelas' => $id_kelas))->result();
				$data['id_tahun_pelajaran'] = $id_tahun_pelajaran;
				$data['id_jurusan'] = $id_jurusan;
				$data['id_kelas'] = $id_kelas;
			}elseif($id_tahun_pelajaran && $id_jurusan){
				// id_tahun_pelajara,$id_jurusan
				$data['pembayaran'] = $this->pembayaran->find(array('tp.id_tahun_pelajaran' => $id_tahun_pelajaran,'jrs.id_jurusan' => $id_jurusan))->result();
				$data['id_tahun_pelajaran'] = $id_tahun_pelajaran;
				$data['id_jurusan'] = $id_jurusan;
			}elseif($id_tahun_pelajaran){
				// id_tahun_pelajara,$id_jurusan
				$data['pembayaran'] = $this->pembayaran->find(array('tp.id_tahun_pelajaran' => $id_tahun_pelajaran))->result();
				$data['id_tahun_pelajaran'] = $id_tahun_pelajaran;
			}else{
			// 	var_dump('tidak ada inputan');
			// die();
				$data['pembayaran'] = $this->pembayaran->get()->result();
				$data['id_tahun_pelajaran'] = $id_tahun_pelajaran;
			}
			
		}else{
			$data['pembayaran'] = $this->pembayaran->getGroupBy()->result();
			$data['id_tahun_pelajaran'] = $id_tahun_pelajaran;
		}

		$data['title'] = 'Laporan Pembayaran';
		$data['content'] = 'pages/pembayaran/laporan';
		$data['menu'] = 'Laporan Pembayaran';
		$data['submenu'] = 'Data';
		$data['tahun_pelajaran'] = $this->tahun_pelajaran->get()->result();
		$data['jurusan'] = $this->jurusan->get()->result();
		$this->load->view('layouts/app', $data);
	}

	public function detail_pembayaran($id_siswa)
	{
		$data['id_siswa'] =  $id_siswa;
		$data['pembayaran']  = $this->pembayaran->find(array('pmb.id_siswa' => $id_siswa))->result();
		$this->load->view('pages/pembayaran/detail',$data);
	}

	public function print_siswa()
	{
		$id_jurusan = $this->input->get('id_jurusan');
		$id_kelas = $this->input->get('id_kelas');

		if ($id_jurusan && $id_kelas) {
			$array = array('jrs.id_jurusan' => $id_jurusan, 'kls.id_kelas' => $id_kelas);
			$data['jurusan'] = $this->jurusan->find(array('id_jurusan' => $id_jurusan))->row();
			$data['kelas'] = $this->kelas->find(array('id_kelas' => $id_kelas))->row();
		} else if ($id_jurusan && !$id_kelas) {
			$array = array('jrs.id_jurusan' => $id_jurusan);
			$data['jurusan'] = $this->jurusan->find(array('id_jurusan' => $id_jurusan))->row();
			$data['kelas'] = NULL;
		} else if (!$id_jurusan && $id_kelas) {
			$array = array('kls.id_kelas' => $id_kelas);
			$data['jurusan'] = NULL;
			$data['kelas'] = $this->kelas->find(array('id_kelas' => $id_kelas))->row();
		} else {
			$array = 'all';
			$data['jurusan'] = NULL;
			$data['kelas'] = NULL;
		}
		if ($array === 'all') {
			$data['siswa'] = $this->siswa->get()->result();
		} else {
			$data['siswa'] = $this->siswa->find($array)->result();
		}
		$data['tahun_pelajaran'] = $this->tahun_pelajaran->get()->row()->tahun;
		$data['tanggal'] = Carbon::now()->translatedFormat('d F Y');
		$this->load->view('pages/laporan/print_siswa', $data);
	}

	public function print_pembayaran()
	{
		$id_tahun_pelajaran = $this->input->get('id_tahun_pelajaran');
		$id_jurusan = $this->input->get('id_jurusan');
		$id_kelas = $this->input->get('id_kelas');
		$id_siswa = $this->input->get('id_siswa');

		// tahun pelajara, id_jurusan, id_kelas, id_siswa
		if($id_tahun_pelajaran && $id_jurusan && $id_kelas && $id_siswa)
		{
			$data['pembayaran'] = $this->pembayaran->find(array('tp.id_tahun_pelajaran' => $id_tahun_pelajaran,'sw.id_siswa' => $id_siswa,'pmb.status' => 1))->result();
			$data['id_tahun_pelajaran'] = $id_tahun_pelajaran;
			$data['id_jurusan'] = $id_jurusan;
			$data['id_kelas'] = $id_kelas;
			$data['id_siswa'] = $id_siswa;
			$data['pembayaran_tahun_pelajaran'] = $this->pembayaran_tahun_pelajaran->find2(array('pem.id_tahun_pelajaran' => $id_tahun_pelajaran))->result();
		}elseif($id_tahun_pelajaran && $id_jurusan && $id_kelas){
			// id_tahun_pelajaran,$id_jurusan,$id_kelas
			$data['pembayaran'] = $this->pembayaran->find(array('tp.id_tahun_pelajaran' => $id_tahun_pelajaran,'sw.id_kelas' => $id_kelas))->result();
			$data['id_tahun_pelajaran'] = $id_tahun_pelajaran;
			$data['id_jurusan'] = $id_jurusan;
			$data['id_kelas'] = $id_kelas;
			$data['pembayaran_tahun_pelajaran'] = $this->pembayaran_tahun_pelajaran->find2(array('pem.id_tahun_pelajaran' => $id_tahun_pelajaran))->result();
		}elseif($id_tahun_pelajaran && $id_jurusan){
			// id_tahun_pelajara,$id_jurusan
			$data['pembayaran'] = $this->pembayaran->find(array('tp.id_tahun_pelajaran' => $id_tahun_pelajaran,'jrs.id_jurusan' => $id_jurusan))->result();
			$data['id_tahun_pelajaran'] = $id_tahun_pelajaran;
			$data['id_jurusan'] = $id_jurusan;
			$data['id_kelas'] = $id_kelas;
			$data['pembayaran_tahun_pelajaran'] = $this->pembayaran_tahun_pelajaran->find2(array('pem.id_tahun_pelajaran' => $id_tahun_pelajaran))->result();
		}elseif($id_tahun_pelajaran){
			// id_tahun_pelajara,$id_jurusan
			$data['pembayaran'] = $this->pembayaran->find(array('tp.id_tahun_pelajaran' => $id_tahun_pelajaran))->result();
			$data['id_tahun_pelajaran'] = $id_tahun_pelajaran;
			$data['pembayaran_tahun_pelajaran'] = $this->pembayaran_tahun_pelajaran->find2(array('pem.id_tahun_pelajaran' => $id_tahun_pelajaran))->result();
		}else{
			$data['pembayaran'] = $this->pembayaran->get()->result();
			$data['id_tahun_pelajaran'] = $this->tahun_pelajaran->get()->row()->id_tahun_pelajaran;
			$data['id_jurusan'] = $id_jurusan;
			$data['id_kelas'] = $id_kelas;
		}
		// if($id_tahun_pelajaran)
		// {
		// 	$data['ptp'] = $this->pembayaran_tahun_pelajaran->find2(array('pem.id_tahun_pelajaran' => $id_tahun_pelajaran));
		// }
		// if($this->session->userdata('level') === 'siswa')
		// {
		// 	$data['pembayaran_tahun_pelajaran'] = $this->pembayaran_tahun_pelajaran->find2(array('pem.id_tahun_pelajaran' => $id_tahun_pelajaran))->result();
		// }

		$data['jurusan'] = $this->jurusan->find(array('id_jurusan' => $id_jurusan))->row();
		$data['kelas'] = $this->kelas->find(array('id_kelas' => $id_kelas))->row();
		$data['tahun_pelajaran'] = $this->tahun_pelajaran->find(array('id_tahun_pelajaran' => $data['id_tahun_pelajaran']))->row()->tahun;
		if($id_siswa)
		{
			$data['siswa'] = $this->siswa->find(array('id_siswa' => $id_siswa))->row();
			$data['tahun_pelajaran'] = $this->tahun_pelajaran->find(array('id_tahun_pelajaran' => $id_tahun_pelajaran))->row();
		}

		$this->load->view('pages/laporan/print_pembayaran', $data);
	}
}

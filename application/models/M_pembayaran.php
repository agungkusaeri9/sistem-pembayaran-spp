<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_pembayaran extends CI_Model{

    public $table = 'pembayaran';
    public function get()
    {
		$this->db->select('pmb.*,sw.nama_siswa as nama_siswa,sw.nisn as nisn,kls.nama_kelas as nama_kelas,jrs.nama_jurusan as nama_jurusan,tp.tahun as tahun_pelajaran,jp.nama_jenis as nama_jenis,ptp.bulan as bulan,tp.id_tahun_pelajaran');
		$this->db->from('pembayaran pmb');
		$this->db->join('siswa sw','sw.id_siswa=pmb.id_siswa');
		$this->db->join('kelas kls','kls.id_kelas=sw.id_kelas');
		$this->db->join('jurusan jrs','jrs.id_jurusan=kls.id_jurusan');
		$this->db->join('pembayaran_tahun_pelajaran ptp','ptp.id_pembayaran_tahun_pelajaran=pmb.id_pembayaran_tahun_pelajaran');
		$this->db->join('tahun_pelajaran tp','tp.id_tahun_pelajaran=ptp.id_tahun_pelajaran');
		$this->db->join('jenis_pembayaran jp','jp.id_jenis_pembayaran=ptp.id_jenis_pembayaran');
		$this->db->order_by('pmb.tanggal_pembayaran','DESC');
        return $this->db->get();
    }

	public function create($data)
	{
		$this->db->insert($this->table,$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function find($arr)
	{
		$this->db->select('pmb.*,sw.nama_siswa as nama_siswa,sw.nisn as nisn,kls.nama_kelas as nama_kelas,jrs.nama_jurusan as nama_jurusan,tp.tahun as tahun_pelajaran,jp.nama_jenis as nama_jenis,ptp.bulan as bulan');
		$this->db->from('pembayaran pmb');
		$this->db->join('siswa sw','sw.id_siswa=pmb.id_siswa');
		$this->db->join('kelas kls','kls.id_kelas=sw.id_kelas');
		$this->db->join('jurusan jrs','jrs.id_jurusan=kls.id_jurusan');
		$this->db->join('pembayaran_tahun_pelajaran ptp','ptp.id_pembayaran_tahun_pelajaran=pmb.id_pembayaran_tahun_pelajaran');
		$this->db->join('tahun_pelajaran tp','tp.id_tahun_pelajaran=ptp.id_tahun_pelajaran');
		$this->db->join('jenis_pembayaran jp','jp.id_jenis_pembayaran=ptp.id_jenis_pembayaran');
		$this->db->where($arr);
		$this->db->order_by('pmb.id_pembayaran','DESC');
		return $this->db->get();
	}

	// public function findGroupBy($arr)
	// {
	// 	$this->db->select('pmb.*,sw.nama_siswa as nama_siswa,sw.nisn as nisn,tp.tahun as tahun_pelajaran');
	// 	$this->db->from('pembayaran pmb');
	// 	$this->db->join('siswa sw','sw.id_siswa=pmb.id_siswa');
	// 	$this->db->join('pembayaran_tahun_pelajaran ptp','ptp.id_pembayaran_tahun_pelajaran=pmb.id_pembayaran_tahun_pelajaran');
	// 	$this->db->join('tahun_pelajaran tp','tp.id_tahun_pelajaran=ptp.id_tahun_pelajaran');
	// 	$this->db->where($arr);
	// 	$this->db->group_by('tp.id_tahun_pelajaran');
	// 	return $this->db->get();
	// }


	public function update($id,$data)
	{
		$this->db->where('id_pembayaran',$id);
		$this->db->set($data);
		return $this->db->update($this->table);
	}

	public function getGroupBy()
	{
		$this->db->select('pmb.id_siswa,sw.nama_siswa,sw.nisn,sw.nis,kls.nama_kelas as nama_kelas,jrs.nama_jurusan as nama_jurusan');
		$this->db->join('siswa sw','sw.id_siswa=pmb.id_siswa');
		$this->db->join('kelas kls','kls.id_kelas=sw.id_kelas');
		$this->db->join('jurusan jrs','jrs.id_jurusan=kls.id_jurusan');
		$this->db->from('pembayaran pmb');
		$this->db->group_by('pmb.id_siswa');
		return $this->db->get();
	}

	public function delete($id)
	{
		$this->db->where('id_pembayaran',$id);
		$this->db->delete($this->table);
	}

}

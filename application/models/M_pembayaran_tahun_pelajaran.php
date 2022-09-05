<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_pembayaran_tahun_pelajaran extends CI_Model{

    public $table = 'pembayaran_tahun_pelajaran';
    public function get()
    {
		$this->db->select('pem.*,tp.tahun as tahun_pelajaran,jp.nama_jenis as nama_jenis');
		$this->db->from('pembayaran_tahun_pelajaran pem');
		$this->db->join('tahun_pelajaran tp','tp.id_tahun_pelajaran=pem.id_tahun_pelajaran');
		$this->db->join('jenis_pembayaran jp','jp.id_jenis_pembayaran=pem.id_jenis_pembayaran');
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
		$this->db->where($arr);
		return $this->db->get($this->table);
	}

	public function find2($arr)
	{
		$this->db->select('pem.*,tp.tahun as tahun_pelajaran,jp.nama_jenis as nama_jenis,jp.nominal as nominal');
		$this->db->from('pembayaran_tahun_pelajaran pem');
		$this->db->join('tahun_pelajaran tp','tp.id_tahun_pelajaran=pem.id_tahun_pelajaran');
		$this->db->join('jenis_pembayaran jp','jp.id_jenis_pembayaran=pem.id_jenis_pembayaran');
		$this->db->where($arr);
		return $this->db->get();
	}

	public function update($id,$data)
	{
		$this->db->where('id_pembayaran_tahun_pelajaran',$id);
		$this->db->set($data);
		return $this->db->update($this->table);
	}

	public function delete($id)
	{
		$this->db->where('id_pembayaran_tahun_pelajaran',$id);
		$this->db->delete($this->table);
	}

}

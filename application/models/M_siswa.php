<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_siswa extends CI_Model{

    public $table = 'siswa';
    public function get()
    {
		$this->db->select('sis.*,kls.nama_kelas as kelas,jrs.nama_jurusan as jurusan,jrs.id_jurusan as id_jurusan');
		$this->db->from('siswa sis');
		$this->db->join('kelas kls','kls.id_kelas=sis.id_kelas','inner');
		$this->db->join('jurusan jrs','jrs.id_jurusan=kls.id_jurusan');
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
		$this->db->select('sis.*,kls.nama_kelas as kelas,jrs.nama_jurusan as jurusan,jrs.id_jurusan as id_jurusan');
		$this->db->from('siswa sis');
		$this->db->join('kelas kls','kls.id_kelas=sis.id_kelas','inner');
		$this->db->join('jurusan jrs','jrs.id_jurusan=kls.id_jurusan');
		$this->db->where($arr);
		return $this->db->get();
	}

	public function update($id,$data)
	{
		$this->db->where('id_siswa',$id);
		$this->db->set($data);
		return $this->db->update($this->table);
	}

	public function delete($id)
	{
		$this->db->where('id_siswa',$id);
		$this->db->delete($this->table);
	}

}

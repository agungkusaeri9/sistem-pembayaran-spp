<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_kelas extends CI_Model{

    public $table = 'kelas';
    public function get()
    {
		$this->db->select('kls.*,jrs.nama_jurusan as jurusan');
		$this->db->from('kelas kls');
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
		$this->db->where($arr);
		return $this->db->get($this->table);
	}

	public function update($id,$data)
	{
		$this->db->where('id_kelas',$id);
		$this->db->set($data);
		return $this->db->update($this->table);
	}

	public function delete($id)
	{
		$this->db->where('id_kelas',$id);
		$this->db->delete($this->table);
	}

}

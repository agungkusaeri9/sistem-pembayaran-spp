<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_jurusan extends CI_Model{

    public $table = 'jurusan';
    public function get()
    {
        return $this->db->get($this->table);
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
		$this->db->where('id_jurusan',$id);
		$this->db->set($data);
		return $this->db->update($this->table);
	}

	public function delete($id)
	{
		$this->db->where('id_jurusan',$id);
		$this->db->delete($this->table);
	}

}

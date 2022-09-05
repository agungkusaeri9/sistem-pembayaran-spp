<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_jenis_pembayaran extends CI_Model{

    public $table = 'jenis_pembayaran';
    public function get()
    {
		$this->db->select('jp.*,ta.tahun as tahun_pelajaran');
		$this->db->from('jenis_pembayaran jp');
		$this->db->join('tahun_pelajaran ta','ta.id_tahun_pelajaran=jp.id_tahun_pelajaran');
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
		$this->db->where('id_jenis_pembayaran',$id);
		$this->db->set($data);
		return $this->db->update($this->table);
	}

	public function delete($id)
	{
		$this->db->where('id_jenis_pembayaran',$id);
		$this->db->delete($this->table);
	}

}

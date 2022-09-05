<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class M_auth extends CI_Model{

	public $table = 'user';

	public function check($where)
	{
		$this->db->where($where);
		$this->db->from($this->table);
		return $this->db->get();
	}

	public function user()
	{
		$user_id = $this->session->has_userdata('id');
		if($user_id)
		{
			$user = $this->db->get_where($this->table,array('id' => $user_id))->row();
			return $user;
		}else{
			return false;
		}
	}
	
}

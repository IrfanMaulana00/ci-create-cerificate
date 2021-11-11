<?php

class M_user extends CI_Model{
	protected $_table = 'user';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_username($username){
		$query = $this->db->get_where($this->_table, ['username' => $username]);
		return $query->row();
	}
}
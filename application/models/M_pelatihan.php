<?php

class M_pelatihan extends CI_Model{
	protected $_table = 'pelatihan';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function getById($id, $idUser){
		$query = $this->db->get_where($this->_table, ['id' => $id, 'id_user' => $idUser]);
		return $query->row();
	}

	public function update($data, $id, $idUser){
		$query = $this->db->set($data);
		$query = $this->db->where(['id' => $id, 'id_user' => $idUser]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function add($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($id, $idUser){
		return $this->db->delete($this->_table, ['id' => $id, 'id_user' => $idUser]);
	}
}
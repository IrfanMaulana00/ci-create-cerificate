<?php

class M_peserta extends CI_Model{
	protected $_table = 'peserta';

	public function lihat(){
		//$query = $this->db->get($this->_table);
        $query = $this->db->query("SELECT pelatihan.judul, peserta.* FROM $this->_table INNER JOIN pelatihan ON peserta.id_pelatihan = pelatihan.id");
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
<?php

class Pelatihan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if ( !$this->session->login['username'] ) {
			redirect('login'); exit;
		} else {
			$this->load->model('m_user', 'm_user');
			$this->load->model('m_pelatihan', 'm_pelatihan');
			if ( !$this->m_user->lihat_username( $this->session->login['username'] ) ) {
				redirect('logout'); exit;
			}
		}
		$this->data['aktif'] = 'pelatihan';
	}


	public function index( $id = '' ){
		
		$this->data['title'] = 'Pelatihan';
		$this->data['profile'] = $this->m_user->lihat_username( $this->session->login['username'] );
		$this->data['listPelatihan'] = $this->m_pelatihan->lihat();
        if ( $id != "" ) {
            if ( !$this->m_pelatihan->getById( $id, $this->session->login['id'] ) ) {
                redirect('dashboard'); exit;
            }
            $this->data['getPelatihan'] = $this->m_pelatihan->getById( $id, $this->session->login['id'] );
        }
		
		$this->load->view('pelatihan/index', $this->data);
	}

	public function hapus( $id ){
		
		$this->data['title'] = 'Kuis';
		$this->data['profile'] = $this->m_user->lihat_username( $this->session->login['username'] );
		if ( !$this->m_pelatihan->getById( $id, $this->session->login['id'] ) ) {
			redirect('dashboard'); exit;
		}
		if ( $this->m_pelatihan->hapus( $id, $this->session->login['id'] ) ) {
			//$this->m_peserta->hapus_idkuis( $id, $this->session->login['id'] );
			$this->session->set_flashdata('success', '<strong>Delete</strong> Berhasil!');
		} else {
			$this->session->set_flashdata('error', 'Gagal hapus data.');
		}
		redirect($_SERVER['HTTP_REFERER']); exit;
	}

    public function tambah() {

		$id = $this->input->post('id');
		$judul = $this->input->post('judul');
		$tanggal = $this->input->post('tanggal');
        
		if ( !$judul || !$tanggal ) {
			$this->session->set_flashdata('error', 'data tidak lengkap.');
			redirect($_SERVER['HTTP_REFERER']);
		} else {

			if ( isset($id) && $id != "" ) {

				if ( !$this->m_pelatihan->getById( $id, $this->session->login['id'] ) ) {
					$this->session->set_flashdata('error', 'data tidak ditemukan.');
					redirect($_SERVER['HTTP_REFERER']);
				}

				$update = [
					'judul' => $judul,
					'tanggal' => $tanggal,
				];

				if ( $this->m_pelatihan->update($update, $id, $this->session->login['id']) ) {
					$this->session->set_flashdata('success', '<strong>Update</strong> Berhasil!');
					redirect($_SERVER['HTTP_REFERER']);
				} else {
					$this->session->set_flashdata('error', 'Update gagal.');
					redirect($_SERVER['HTTP_REFERER']);
				}

			} else {

				$new = [
					'id_user' => $this->session->login['id'],
					'judul' => $judul,
					'tanggal' => $tanggal,
				];

				if ( $this->m_pelatihan->add($new) ) {
					$this->session->set_flashdata('success', '<strong>Tambah Data</strong> Berhasil!');
					redirect($_SERVER['HTTP_REFERER']);
				} else {
					$this->session->set_flashdata('error', 'gagal tambah data.');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}
	}

}
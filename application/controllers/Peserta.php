<?php

class Peserta extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if ( !$this->session->login['username'] ) {
			redirect('login'); exit;
		} else {
			$this->load->model('m_user', 'm_user');
			$this->load->model('m_pelatihan', 'm_pelatihan');
			$this->load->model('m_peserta', 'm_peserta');
			if ( !$this->m_user->lihat_username( $this->session->login['username'] ) ) {
				redirect('logout'); exit;
			}
		}
		$this->data['aktif'] = 'peserta';
        $this->data['title'] = 'Peserta';
	}


	public function index( $id = '' ){

		$this->data['profile'] = $this->m_user->lihat_username( $this->session->login['username'] );
		$this->data['listPeserta'] = $this->m_peserta->lihat();
		$this->data['listPelatihan'] = $this->m_pelatihan->lihat();
        if ( $id != "" ) {
            if ( !$this->m_peserta->getById( $id, $this->session->login['id'] ) ) {
                redirect('dashboard'); exit;
            }
            $this->data['getPeserta'] = $this->m_peserta->getById( $id, $this->session->login['id'] );
        }
		
		$this->load->view('peserta/index', $this->data);
	}

	public function hapus( $id ){
        
		$this->data['profile'] = $this->m_user->lihat_username( $this->session->login['username'] );
		if ( !$this->m_peserta->getById( $id, $this->session->login['id'] ) ) {
			redirect('dashboard'); exit;
		}
		if ( $this->m_peserta->hapus( $id, $this->session->login['id'] ) ) {
			$this->session->set_flashdata('success', '<strong>Delete</strong> Berhasil!');
		} else {
			$this->session->set_flashdata('error', 'Gagal hapus data.');
		}
		redirect($_SERVER['HTTP_REFERER']); exit;
	}

    public function tambah() {

		$id = $this->input->post('id');
        $pelatihan = $this->input->post('pelatihan');
		$nama = $this->input->post('nama');
		$bisnis = $this->input->post('bisnis');
		$email = $this->input->post('email');
		$nomor = $this->input->post('nomor');
        
		if ( !$pelatihan || !$nama || !$bisnis || !$email || !$nomor ) {
			$this->session->set_flashdata('error', 'data tidak lengkap.');
			redirect($_SERVER['HTTP_REFERER']);
		} else {

			if ( isset($id) && $id != "" ) {

				if ( !$this->m_peserta->getById( $id, $this->session->login['id'] ) ) {
					$this->session->set_flashdata('error', 'data tidak ditemukan.');
					redirect($_SERVER['HTTP_REFERER']);
				}

				$update = [
					'id_pelatihan' => $pelatihan,
					'nama' => $nama,
					'bisnis' => $bisnis,
					'email' => $email,
					'nomor' => $nomor,
				];

				if ( $this->m_peserta->update($update, $id, $this->session->login['id']) ) {
					$this->session->set_flashdata('success', '<strong>Update</strong> Berhasil!');
					redirect($_SERVER['HTTP_REFERER']);
				} else {
					$this->session->set_flashdata('error', 'Update gagal.');
					redirect($_SERVER['HTTP_REFERER']);
				}

			} else {

				$new = [
					'id_user' => $this->session->login['id'],
					'id_pelatihan' => $pelatihan,
					'nama' => $nama,
					'bisnis' => $bisnis,
					'email' => $email,
					'nomor' => $nomor,
				];

				if ( $this->m_peserta->add($new) ) {
					$this->session->set_flashdata('success', '<strong>Tambah Data</strong> Berhasil!');
					redirect($_SERVER['HTTP_REFERER']);
				} else {
					$this->session->set_flashdata('error', 'gagal tambah data.');
					redirect($_SERVER['HTTP_REFERER']);
				}
			}
		}
	}

	public function sertifikat ( $id = '' ) {
		if ( !$id ) die(json_encode(['status' => false, 'message' => 'data tidak lengkap']));
		if ( !$this->m_peserta->getById( $id, $this->session->login['id'] ) ) die(json_encode(['status' => false, 'message' => 'data tidak ditemukan']));

		$dir = "./upload/";
		$filename = random_string('sha1').".pdf";

		$this->load->library('dompdf_gen');
		$data['peserta'] = $this->m_peserta->getById( $id, $this->session->login['id'] );
		$data['pelatihan'] = $this->m_pelatihan->getById( $data['peserta']->id_pelatihan, $this->session->login['id'] );

		$this->load->view('template-sertifikat', $data);

		$paperSize = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paperSize, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$output = $this->dompdf->output();
		file_put_contents($dir.$filename, $output);

		die(json_encode(['status' => true, 'message' => 'Berhasil membuat sertifikat', 'url' => base_url('upload/').$filename]));
	}

	

	public function idcard ( $id = '' ) {
		if ( !$id ) die(json_encode(['status' => false, 'message' => 'data tidak lengkap']));
		if ( !$this->m_peserta->getById( $id, $this->session->login['id'] ) ) die(json_encode(['status' => false, 'message' => 'data tidak ditemukan']));

		$dir = "./upload/";
		$filename = random_string('sha1').".pdf";

		$this->load->library('dompdf_gen');
		$data['peserta'] = $this->m_peserta->getById( $id, $this->session->login['id'] );
		$data['pelatihan'] = $this->m_pelatihan->getById( $data['peserta']->id_pelatihan, $this->session->login['id'] );

		$this->load->view('template-idcard', $data);

		$paperSize = 'A4';
		$orientation = 'portrait';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paperSize, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$output = $this->dompdf->output();
		file_put_contents($dir.$filename, $output);

		die(json_encode(['status' => true, 'message' => 'Berhasil membuat id card', 'url' => base_url('upload/').$filename]));
	}
    
}
<?php

class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if($this->session->login) redirect('dashboard');
		$this->load->model('m_user', 'm_user');
	}

	public function index(){
		$this->load->view('login');
	}

	public function proses_login(){
		if($this->input->post('username') && $this->input->post('password')) $this->_proses_login($this->input->post('username'));
		else {
			?>
			<script>
				alert('role tidak tersedia!')
			</script>
			<?php
		}
	}

	protected function _proses_login($username){
		$get_pengguna = $this->m_user->lihat_username($username);
		if($get_pengguna){
			if($get_pengguna->password == $this->input->post('password')){
				$session = [
					'id' => $get_pengguna->id,
					'nama' => $get_pengguna->nama,
					'username' => $get_pengguna->username,
					'password' => $get_pengguna->password,
					'jam_masuk' => date('H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Username Salah!');
			redirect();
		}
	}
}
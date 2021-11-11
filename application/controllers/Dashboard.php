<?php

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if( !$this->session->login['username'] ) redirect();
		$this->data['aktif'] = 'dashboard';
		$this->load->model('m_user', 'm_user');
		$this->load->model('m_pelatihan', 'm_pelatihan');
		$this->load->model('m_peserta', 'm_peserta');
		if ( !$this->m_user->lihat_username($this->session->login['username']) ) redirect('logout');

	}
	public function index(){
		$this->data['title'] = 'Dashboard';
		$this->data['user'] =  $this->m_user->lihat_username( $this->session->login['username'] );
		$this->data['listPelatihan'] = $this->m_pelatihan->lihat();
		$this->data['listPeserta'] = $this->m_peserta->lihat();
		$this->load->view('dashboard', $this->data);
	}
}
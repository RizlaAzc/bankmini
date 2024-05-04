<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Dashboard extends CI_Controller {

	public function __construct() {

		parent::__construct();
		if (!$this->session->userdata('nisn')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please login!</div>');
            redirect('');
        }
		
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$profil['profil'] = $this->db->get_where('siswa', ['nisn' => $this->session->userdata('nisn')])->row_array();

		$title['title'] = 'Dashboard - Pembayaran SPP';
		
		$year['year'] = date('Y');

		$this->load->view('siswa/_partials/_head', $title);
		$this->load->view('siswa/_partials/_navbar', $profil);
		$this->load->view('siswa/_partials/_settings-panel');
		$this->load->view('siswa/_partials/_sidebar');
		$this->load->view('siswa/V_Dashboard');
		$this->load->view('siswa/_partials/_footer', $year);
	}
}

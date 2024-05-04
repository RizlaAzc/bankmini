<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Histori extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->model('M_Pembayaran');

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

		$title['title'] = 'Histori Pembayaran - Pembayaran SPP';

		$year['year'] = date('Y');

		$nisn = $this->session->userdata('nisn');
		// $id_spp = $this->session->userdata('id_spp');

		$pembayaran = $this->db->query("SELECT * FROM pembayaran WHERE nisn='$nisn'")->result();

		$data['pembayaran'] = $pembayaran;

		$this->load->view('siswa/_partials/_head', $title);
		$this->load->view('siswa/_partials/_navbar', $profil);
		$this->load->view('siswa/_partials/_settings-panel');
		$this->load->view('siswa/_partials/_sidebar');
		$this->load->view('siswa/payment/V_Histori', $data);
		$this->load->view('siswa/_partials/_footer', $year);
	}
}

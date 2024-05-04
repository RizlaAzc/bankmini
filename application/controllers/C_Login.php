<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Login extends CI_Controller {

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
		if ($this->session->userdata('nisn')) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please logout!</div>');
			redirect('dashboard');
		}

		$title['title'] = 'Pembayaran SPP';

		$this->load->view('siswa/_partials/_head', $title);
		$this->load->view('siswa/V_Login');
	}

	public function login()
	{
		$nisn = $this->input->post('nisn');
		$nis = $this->input->post('nis');

		$nisn = $this->db->get_where('siswa', ['nisn' => $nisn])->row_array();
		$nis = $this->db->get_where('siswa', ['nis' => $nis])->row_array();

		if ($nisn) {

			if ($nis) {
				$data = [

					'nisn' => $nisn['nisn']

				];
				$this->session->set_userdata($data);
				redirect('dashboard');
			} else {

				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong NIS!</div>');
				redirect('');
			}

		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">NISN is not registered!</div>');
			redirect('');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been logout.</div>');
		redirect('');
	}
}

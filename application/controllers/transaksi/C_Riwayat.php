<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Riwayat extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
		$this->load->model('M_Transaksi');
		$this->load->model('M_Kelas');

		if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Harap Login terlebih dahulu!</div>');
            redirect('');
        }
		
	}
	public function index()
	{
		$profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

		$title['title'] = 'Riwayat Transaksi - Bank Mini';

		$year['year'] = date('Y');

		$transaksi = $this->M_Transaksi->getDataTransaksi();
		$kelas = $this->M_Kelas->getDataKelas();

		$data['transaksi'] = $transaksi;
		$data['kelas'] = $kelas;

		$this->load->view('_partials/_head', $title);
		$this->load->view('_partials/_navbar', $profil);
		$this->load->view('_partials/_sidebar');
		$this->load->view('transaksi/riwayat/V_Riwayat', $data);
		$this->load->view('_partials/_footer', $year);
	}
}

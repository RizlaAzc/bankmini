<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Transaksi extends CI_Controller {

	public function __construct() {

		parent::__construct();

		$this->load->model('M_Pembayaran');
		if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Please login!</div>');
            redirect('admin');
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
		$profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

		$title['title'] = 'Entri Transaksi - Pembayaran SPP';

		$year['year'] = date('Y');

		$this->load->view('admin/_partials/_head', $title);
		$this->load->view('admin/_partials/_navbar', $profil);
		$this->load->view('admin/_partials/_settings-panel');
		$this->load->view('admin/_partials/_sidebar');
		$this->load->view('admin/payment/V_Transaksi');
		$this->load->view('admin/_partials/_footer', $year);
	}

	public function fungsi_tambah()
    {
        $profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        // $id_spp = $this->input->post('id_spp');
        $id_petugas = $this->input->post('id_petugas');
        $nisn = $this->input->post('nisn');
        $tahun_dibayar = $this->input->post('tahun_dibayar');
        $jumlah_bayar = $this->input->post('jumlah_bayar');
        $tgl_bayar = date('Y-m-d');
        $bulan_dibayar = 12;

        $ArrInsert = array(
            'id_petugas' => $id_petugas,
            'nisn' => $nisn,
            'id_spp' => $nisn,
            'tahun_dibayar' => $tahun_dibayar,
            'jumlah_bayar' => $jumlah_bayar,
            'tgl_bayar' => $tgl_bayar,
            'bulan_dibayar' => $bulan_dibayar
        );

        $this->M_Pembayaran->insertDataPembayaran($ArrInsert);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan!</div>');
		redirect($_SERVER['HTTP_REFERER']);
    }
}

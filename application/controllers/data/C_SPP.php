<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_SPP extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
		$this->load->model('M_SPP');

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

		$title['title'] = 'Data SPP - Pembayaran SPP';

		$year['year'] = date('Y');

		$spp = $this->M_SPP->getDataSPP();

		$data['spp'] = $spp;

		$this->load->view('admin/_partials/_head', $title);
		$this->load->view('admin/_partials/_navbar', $profil);
		$this->load->view('admin/_partials/_settings-panel');
		$this->load->view('admin/_partials/_sidebar');
		$this->load->view('admin/data/spp/V_SPP', $data);
		$this->load->view('admin/_partials/_footer', $year);
	}

	public function edit($id)
	{
		$profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

		$title['title'] = 'Edit SPP - Pembayaran SPP';

		$year['year'] = date('Y');

		$spp = $this->M_SPP->getDataSPPDetail($id);

		$data['spp'] = $spp;

		$this->load->view('admin/_partials/_head', $title);
		$this->load->view('admin/_partials/_navbar', $profil);
		$this->load->view('admin/_partials/_settings-panel');
		$this->load->view('admin/_partials/_sidebar');
		$this->load->view('admin/data/spp/V_Edit', $data);
		$this->load->view('admin/_partials/_footer', $year);
	}

	public function fungsi_tambah()
    {
        $profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $id = $this->input->post('id_spp');
        $tahun = $this->input->post('tahun');
        $nominal = $this->input->post('nominal');

        $ArrInsert = array(
            'id_spp' => $id,
            'tahun' => $tahun,
            'nominal' => $nominal
        );

        $this->M_SPP->insertDataSPP($ArrInsert);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan!</div>');
		redirect($_SERVER['HTTP_REFERER']);
    }

	public function fungsi_edit()
    {
        $profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $id = $this->input->post('id_spp');
        $tahun = $this->input->post('tahun');
        $nominal = $this->input->post('nominal');

        $ArrUpdate = array(
            'id_spp' => $id,
            'tahun' => $tahun,
            'nominal' => $nominal
        );

        $this->M_SPP->updateDataSPP($id, $ArrUpdate);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Diedit!</div>');
        redirect(base_url('spp'));
    }

	public function fungsi_hapus($id)
    {
        $profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $this->M_SPP->hapusDataSPP($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}

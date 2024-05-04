<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Kelas extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
		$this->load->model('M_Kelas');

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

		$title['title'] = 'Data Kelas - Pembayaran SPP';

		$year['year'] = date('Y');

		$kelas = $this->M_Kelas->getDataKelas();

		$data['kelas'] = $kelas;

		$this->load->view('admin/_partials/_head', $title);
		$this->load->view('admin/_partials/_navbar', $profil);
		$this->load->view('admin/_partials/_settings-panel');
		$this->load->view('admin/_partials/_sidebar');
		$this->load->view('admin/data/kelas/V_Kelas', $data);
		$this->load->view('admin/_partials/_footer', $year);
	}

	public function edit($id)
	{
		$profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

		$title['title'] = 'Edit Kelas - Pembayaran SPP';

		$year['year'] = date('Y');

		$kelas = $this->M_Kelas->getDataKelasDetail($id);

		$data['kelas'] = $kelas;

		$this->load->view('admin/_partials/_head', $title);
		$this->load->view('admin/_partials/_navbar', $profil);
		$this->load->view('admin/_partials/_settings-panel');
		$this->load->view('admin/_partials/_sidebar');
		$this->load->view('admin/data/kelas/V_Edit', $data);
		$this->load->view('admin/_partials/_footer', $year);
	}

	public function fungsi_tambah()
    {
        $profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $nama_kelas = $this->input->post('nama_kelas');
        $kompetensi_keahlian = $this->input->post('kompetensi_keahlian');

        $ArrInsert = array(
            'nama_kelas' => $nama_kelas,
            'kompetensi_keahlian' => $kompetensi_keahlian
        );

        $this->M_Kelas->insertDataKelas($ArrInsert);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan!</div>');
		redirect($_SERVER['HTTP_REFERER']);
    }

	public function fungsi_edit()
    {
        $profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $id = $this->input->post('id_kelas');
        $nama_kelas = $this->input->post('nama_kelas');
        $kompetensi_keahlian = $this->input->post('kompetensi_keahlian');

        $ArrUpdate = array(
            'id_kelas' => $id,
            'nama_kelas' => $nama_kelas,
            'kompetensi_keahlian' => $kompetensi_keahlian
        );

        $this->M_Kelas->updateDataKelas($id, $ArrUpdate);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Diedit!</div>');
        redirect(base_url('kelas'));
    }

	public function fungsi_hapus($id)
    {
        $profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $this->M_Kelas->hapusDataKelas($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Siswa extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
		$this->load->model('M_Siswa');
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

		$title['title'] = 'Data Siswa - Pembayaran SPP';

		$year['year'] = date('Y');

		$siswa = $this->M_Siswa->getDataSiswa();
		$kelas = $this->M_Kelas->getDataKelas();

		$data['siswa'] = $siswa;
		$data['kelas'] = $kelas;

		$this->load->view('admin/_partials/_head', $title);
		$this->load->view('admin/_partials/_navbar', $profil);
		$this->load->view('admin/_partials/_settings-panel');
		$this->load->view('admin/_partials/_sidebar');
		$this->load->view('admin/data/siswa/V_Siswa', $data);
		$this->load->view('admin/_partials/_footer', $year);
	}

	public function edit($id)
	{
		$profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

		$title['title'] = 'Edit Siswa - Pembayaran SPP';

		$year['year'] = date('Y');

		$kelas = $this->M_Kelas->getDataKelas();
		$siswa = $this->M_Siswa->getDataSiswaDetail($id);

		$data['siswa'] = $siswa;
		$data['kelas'] = $kelas;

		$this->load->view('admin/_partials/_head', $title);
		$this->load->view('admin/_partials/_navbar', $profil);
		$this->load->view('admin/_partials/_settings-panel');
		$this->load->view('admin/_partials/_sidebar');
		$this->load->view('admin/data/siswa/V_Edit', $data);
		$this->load->view('admin/_partials/_footer', $year);
	}

	public function fungsi_tambah()
    {
        $profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $nisn = $this->input->post('nisn');
        $nis = $this->input->post('nis');
        $nama = $this->input->post('nama');
        $id_kelas = $this->input->post('id_kelas');
        $alamat = $this->input->post('alamat');
        $no_telp = $this->input->post('no_telp');
        // $id_spp = $this->input->post('id_spp');

        $ArrInsert = array(
            'nisn' => $nisn,
            'nis' => $nis,
            'nama' => $nama,
            'id_kelas' => $id_kelas,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'id_spp' => $nisn
        );

        $this->M_Siswa->insertDataSiswa($ArrInsert);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Ditambahkan!</div>');
		redirect($_SERVER['HTTP_REFERER']);
    }

	public function fungsi_edit()
    {
        $profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $nisn = $this->input->post('nisn');
        $nis = $this->input->post('nis');
        $nama = $this->input->post('nama');
        $id_kelas = $this->input->post('id_kelas');
        $alamat = $this->input->post('alamat');
        $no_telp = $this->input->post('no_telp');
        $id_spp = $this->input->post('id_spp');

        $ArrUpdate = array(
            'nisn' => $nisn,
            'nis' => $nis,
            'nama' => $nama,
            'id_kelas' => $id_kelas,
            'alamat' => $alamat,
            'no_telp' => $no_telp,
            'id_spp' => $id_spp
        );

        $this->M_Siswa->updateDataSiswa($nisn, $ArrUpdate);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Diedit!</div>');
        redirect(base_url('siswa'));
    }

	public function fungsi_hapus($id)
    {
        $profil['profil'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $this->M_Siswa->hapusDataSiswa($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Berhasil Dihapus!</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}

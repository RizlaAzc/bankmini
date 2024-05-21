<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Petugas extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
		$this->load->model('M_Petugas');
		date_default_timezone_set('Asia/Jakarta');

		if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Harap Login terlebih dahulu!</div>');
            redirect('');
        }
		
	}

	public function index()
	{
		$profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

		$title['title'] = 'Data Petugas - Bank Mini';

		$year['year'] = date('Y');

		$petugas = $this->db->query("SELECT * FROM petugas WHERE id_petugas > 0")->result();

		$data['petugas'] = $petugas;

		$this->load->view('_partials/_head', $title);
		$this->load->view('_partials/_navbar', $profil);
		$this->load->view('_partials/_sidebar');
		$this->load->view('data/petugas/V_Petugas', $data);
		$this->load->view('_partials/_footer', $year);
	}

	public function fungsi_hapus($id)
    {
        $profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

        $this->M_Petugas->hapusDataPetugas($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }

	public function admin_level_user($id)
	{
		$data['level'] = 'Petugas';
		$this->db->where('id_petugas', $id);
		$result = $this->db->update('petugas', $data);
		if($result == 'Admin'){
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Posisi berhasil diubah!</div>');
		}else{
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Posisi gagal diubah!</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function petugas_level_user($id)
	{
		$data['level'] = 'Admin';
		$this->db->where('id_petugas', $id);
		$result = $this->db->update('petugas', $data);
		if($result == 'Admin'){
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Posisi berhasil diubah!</div>');
		}else{
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Posisi gagal diubah!</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function active_status_user($id)
	{
		$data['status'] = 'Tidak Aktif';
		$this->db->where('id_petugas', $id);
		$result = $this->db->update('petugas', $data);
		if($result == 'Sudah Aktif'){
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Status berhasil diubah!</div>');
		}else{
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Status gagal diubah!</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function deactive_status_user($id)
	{
		$data['status'] = 'Sudah Aktif';
		$this->db->where('id_petugas', $id);
		$result = $this->db->update('petugas', $data);
		if($result == 'Sudah Aktif'){
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Status berhasil diubah!</div>');
		}else{
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Status gagal diubah!</div>');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
}

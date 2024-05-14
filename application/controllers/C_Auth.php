<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Auth extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('email')) {
			$this->session->set_flashdata('a', '<div class="alert alert-danger" role="alert">Harap Logout terlebih dahulu!</div>');
			redirect('transaksi_debit');
		}

		$title['title'] = 'Bank Mini';

		$this->load->view('_partials/_head', $title);
		$this->load->view('V_Login');
	}

	public function login()
	{
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);

		$active_check = $this->db->get_where('petugas', ['username' => $username])->row_array();
		$level_check = $this->db->get_where('petugas', ['username' => $username])->row_array();
		$admin = $this->db->get_where('petugas', ['username' => $username]);
		$petugas = $this->db->get_where('petugas', ['username' => $username]);

		if ($admin->num_rows() > 0) {

			$hasil_admin = $admin->row();

			if ($active_check['status'] == 'Sudah Aktif'){

				if ($level_check['level'] == 'Admin'){

					if (password_verify($password, $hasil_admin->password)) {

						$this->session->set_userdata('id', $hasil_admin->id);
						$this->session->set_userdata('nama_lengkap', TRUE);
						$this->session->set_userdata('email', $hasil_admin->email);
						$this->session->set_userdata('username', $hasil_admin->username);
						$this->session->set_userdata('petugas_id', $hasil_admin->petugas_id);
						$this->session->set_userdata('level', $hasil_admin->level);
						redirect('transaksi_debit');
						
					} else {

						$this->session->set_flashdata('a', '<div class="alert alert-danger" role="alert">Password salah!</div>');
						redirect('');
					}

				} else {

					if ($petugas->num_rows() > 0) {

						$hasil_petugas = $petugas->row();
			
						if ($level_check['level'] == 'Petugas'){
			
							if (password_verify($password, $hasil_petugas->password)) {
			
								$this->session->set_userdata('id', $hasil_petugas->id);
								$this->session->set_userdata('nama_lengkap', TRUE);
								$this->session->set_userdata('email', $hasil_petugas->email);
								$this->session->set_userdata('username', $hasil_petugas->username);
								$this->session->set_userdata('petugas_id', $hasil_petugas->petugas_id);
								$this->session->set_userdata('level', $hasil_petugas->level);
								redirect('transaksi_debit');
								
							} else {
			
								$this->session->set_flashdata('a', '<div class="alert alert-danger" role="alert">Password salah!</div>');
								redirect('');
							}
			
						} else {

								$this->session->set_flashdata('a', '<div class="alert alert-danger" role="alert">Akun tidak terdaftar!</div>');
								redirect('');
						}
			
					} else {
			
						$this->session->set_flashdata('a', '<div class="alert alert-danger" role="alert">Username tidak terdaftar!</div>');
						redirect('');
					}
				}

			} else {

				$this->session->set_flashdata('a', '<div class="alert alert-danger" role="alert">Akun anda belum mendapat persetujuan!</div>');
				redirect('');
			}

		} else {

			$this->session->set_flashdata('a', '<div class="alert alert-danger" role="alert">Username tidak terdaftar!</div>');
			redirect('');
		}
	}

	public function registrasi()
	{
		$this->form_validation->set_rules('nama_lengkap', 'nama_lengkap', 'required|trim');
		$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[petugas.email]', [
			'is_unique' => 'Email ini telah terdaftar !'
		]);

		$this->form_validation->set_rules(
			'password1',
			'password',
			'required|trim|min_length[3]|matches[password2]',
			[
				'matches' => 'password dont match!',
				'min_length' => 'password to short!'
			]
		);

		$this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$title['title'] = 'Bank Mini';
			$this->load->view('_partials/_head', $title);
			$this->load->view('V_Register');
		} else {

			$data = [
				'username' => htmlspecialchars($this->input->post('username', true)),
				'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'status' => 'Tidak Aktif',
				'level' => 'Petugas',
				// 'created_at' => date('Y-m-d H:i:s')
			];

			$this->db->insert('petugas', $data);
			$this->session->set_flashdata('a', '<div class="alert alert-success" role="alert">Akun berhasil dibuat. Silahkan login!</div>');
			redirect('');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('a', '<div class="alert alert-success" role="alert">Berhasil Logout.</div>');
		redirect('');
	}
}
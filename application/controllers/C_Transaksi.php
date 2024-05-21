<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Transaksi extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
		$this->load->model('M_Transaksi');
		$this->load->model('M_Siswa');
        date_default_timezone_set('Asia/Jakarta');

		if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Harap Login terlebih dahulu!</div>');
            redirect('');
        }
		
	}
    
	public function index()
	{
		$profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

		$title['title'] = 'Transaksi - Bank Mini';

		$year['year'] = date('Y');

		$transaksi = $this->M_Transaksi->getDataTransaksi();
		$siswa = $this->M_Siswa->getDataSiswa();

		$data['transaksi'] = $transaksi;
		$data['siswa'] = $siswa;

		$this->load->view('_partials/_head', $title);
		$this->load->view('_partials/_navbar', $profil);
		$this->load->view('_partials/_sidebar');
		$this->load->view('V_Transaksi', $data);
		$this->load->view('_partials/_footer', $year);
	}

	public function cari(){
        $nama_siswa=$_GET['nama_siswa'];
        $cari =$this->M_Transaksi->cari($nama_siswa)->result();
        echo json_encode($cari);
    }

	public function transaksi()
    {
        $profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

        $jenis_tabungan = $this->input->post('jenis_tabungan');
        $jenis_transaksi = $this->input->post('jenis_transaksi');

        if($jenis_tabungan == 'Tabungan Harian'){

            if($jenis_transaksi == 'debit'){

                $tanggal = date('Y-m-d');
                $keterangan = $this->input->post('keterangan');
                $check_saldo = $this->input->post('check_saldo');
                $debit = $this->input->post('nominal');
                $saldo = $check_saldo + $debit;
                $nis = $this->input->post('nis');

                $check_saldo_harian = $this->db->query("SELECT saldo_harian FROM riwayat_transaksi WHERE nis = '$nis' ORDER BY id_transaksi DESC LIMIT 1")->result();
                if($check_saldo_harian != null){
                    foreach($check_saldo_harian as $row){
                        $a = $row->saldo_harian;
                    }
                    $saldo_harian = $a + $debit;
                }elseif($check_saldo_harian == null){
                    $saldo_harian = $debit;
                }

                $check_saldo_tahunan = $this->db->query("SELECT saldo_tahunan FROM riwayat_transaksi WHERE nis = '$nis' ORDER BY id_transaksi DESC LIMIT 1")->result();
                if($check_saldo_tahunan != null){
                    foreach($check_saldo_tahunan as $row){
                        $b = $row->saldo_tahunan;
                    }
                }elseif($check_saldo_tahunan == null){
                    $b = 0;
                }

                $id_petugas = $this->input->post('id_petugas');

                $ArrInsert_d = array(
                    'tanggal' => $tanggal,
                    'jenis_tabungan' => $jenis_tabungan,
                    'keterangan' => $keterangan,
                    'debit' => $debit,
                    'kredit' => 0,
                    'saldo' => $saldo,
                    'saldo_harian' => $saldo_harian,
                    'saldo_tahunan' => $b,
                    'nis' => $nis,
                    'id_petugas' => $id_petugas
                );

                $this->M_Transaksi->insertDataTransaksi($ArrInsert_d);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Setor Tunai berhasil!</div>');
                redirect($_SERVER['HTTP_REFERER']);

            }elseif($jenis_transaksi == 'kredit'){

                $tanggal = date('Y-m-d');
                $keterangan = $this->input->post('keterangan');
                $check_saldo = $this->input->post('check_saldo');
                $kredit = $this->input->post('nominal');
                $saldo = $check_saldo - $kredit;
                $nis = $this->input->post('nis');

                $check_saldo_harian = $this->db->query("SELECT saldo_harian FROM riwayat_transaksi WHERE nis = '$nis' ORDER BY id_transaksi DESC LIMIT 1")->result();
                if($check_saldo_harian != null){
                    foreach($check_saldo_harian as $row){
                        $c = $row->saldo_harian;
                    }
                    $saldo_harian = $c - $kredit;
                }

                $check_saldo_tahunan = $this->db->query("SELECT saldo_tahunan FROM riwayat_transaksi WHERE nis = '$nis' ORDER BY id_transaksi DESC LIMIT 1")->result();
                if($check_saldo_tahunan != null){
                    foreach($check_saldo_tahunan as $row){
                        $d = $row->saldo_tahunan;
                    }
                }
                
                $id_petugas = $this->input->post('id_petugas');

                $ArrInsert_k = array(
                    'tanggal' => $tanggal,
                    'jenis_tabungan' => $jenis_tabungan,
                    'keterangan' => $keterangan,
                    'debit' => 0,
                    'kredit' => $kredit,
                    'saldo' => $saldo,
                    'saldo_harian' => $saldo_harian,
                    'saldo_tahunan' => $d,
                    'nis' => $nis,
                    'id_petugas' => $id_petugas
                );
        
                $this->M_Transaksi->insertDataTransaksi($ArrInsert_k);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Tarik Tunai berhasil!</div>');
                redirect($_SERVER['HTTP_REFERER']);

            }

        }elseif($jenis_tabungan == 'Tabungan Tahunan'){

            if($jenis_transaksi == 'debit'){

                $tanggal = date('Y-m-d');
                $keterangan = $this->input->post('keterangan');
                $check_saldo = $this->input->post('check_saldo');
                $debit = $this->input->post('nominal');
                $saldo = $check_saldo + $debit;
                $nis = $this->input->post('nis');

                $check_saldo_tahunan = $this->db->query("SELECT saldo_tahunan FROM riwayat_transaksi WHERE nis = '$nis' ORDER BY id_transaksi DESC LIMIT 1")->result();
                if($check_saldo_tahunan != null){
                    foreach($check_saldo_tahunan as $row){
                        $e = $row->saldo_tahunan;
                    }
                    $saldo_tahunan = $e + $debit;
                }elseif($check_saldo_tahunan == null){
                    $saldo_tahunan = $debit;
                }

                $check_saldo_harian = $this->db->query("SELECT saldo_harian FROM riwayat_transaksi WHERE nis = '$nis' ORDER BY id_transaksi DESC LIMIT 1")->result();
                if($check_saldo_harian != null){
                    foreach($check_saldo_harian as $row){
                        $f = $row->saldo_harian;
                    }
                }elseif($check_saldo_harian == null){
                    $f = 0;
                }

                $id_petugas = $this->input->post('id_petugas');
                
                $ArrInsert_d = array(
                    'tanggal' => $tanggal,
                    'jenis_tabungan' => $jenis_tabungan,
                    'keterangan' => $keterangan,
                    'debit' => $debit,
                    'kredit' => 0,
                    'saldo' => $saldo,
                    'saldo_harian' => $f,
                    'saldo_tahunan' => $saldo_tahunan,
                    'nis' => $nis,
                    'id_petugas' => $id_petugas
                );
        
                $this->M_Transaksi->insertDataTransaksi($ArrInsert_d);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Setor Tunai berhasil!</div>');
                redirect($_SERVER['HTTP_REFERER']);
    
            }elseif($jenis_transaksi == 'kredit'){
    
                $tanggal = date('Y-m-d');
                $keterangan = $this->input->post('keterangan');
                $check_saldo = $this->input->post('check_saldo');
                $kredit = $this->input->post('nominal');
                $saldo = $check_saldo - $kredit;
                $nis = $this->input->post('nis');

                $check_saldo_tahunan = $this->db->query("SELECT saldo_tahunan FROM riwayat_transaksi WHERE nis = '$nis' ORDER BY id_transaksi DESC LIMIT 1")->result();
                if($check_saldo_tahunan != null){
                    foreach($check_saldo_tahunan as $row){
                        $g = $row->saldo_tahunan;
                    }
                    $saldo_tahunan = $g - $kredit;
                }

                $check_saldo_harian = $this->db->query("SELECT saldo_harian FROM riwayat_transaksi WHERE nis = '$nis' ORDER BY id_transaksi DESC LIMIT 1")->result();
                if($check_saldo_harian != null){
                    foreach($check_saldo_harian as $row){
                        $h = $row->saldo_harian;
                    }
                }

                $id_petugas = $this->input->post('id_petugas');
    
                $ArrInsert_k = array(
                    'tanggal' => $tanggal,
                    'jenis_tabungan' => $jenis_tabungan,
                    'keterangan' => $keterangan,
                    'debit' => 0,
                    'kredit' => $kredit,
                    'saldo' => $saldo,
                    'saldo_harian' => $h,
                    'saldo_tahunan' => $saldo_tahunan,
                    'nis' => $nis,
                    'id_petugas' => $id_petugas
                );
        
                $this->M_Transaksi->insertDataTransaksi($ArrInsert_k);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Tarik Tunai berhasil!</div>');
                redirect($_SERVER['HTTP_REFERER']);
    
            }

        }
    }
}

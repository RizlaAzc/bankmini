<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

        $date_start = $this->input->get('dateStart');
        $date_end = $this->input->get('dateEnd');

        $if_start = $date_start;
        $if_end = $date_end;

        $this->session->set_flashdata('if_start', $if_start);
        $this->session->set_flashdata('if_end', $if_end);

        if ($date_start) {
            $transaksi = $this->M_Transaksi->getDataTransaksifiltered($date_start, $date_end);
        } else {
            $transaksi = $this->M_Transaksi->getDataTransaksi();
        }

        $hari_ini = date('Y-m-d');
		$siswa = $this->M_Siswa->getDataSiswa();
        $check_saldo = $this->db->query("SELECT saldo FROM riwayat_transaksi")->result();
        $saldo_saat_ini = $this->db->query("SELECT saldo FROM riwayat_transaksi ORDER BY id_transaksi DESC LIMIT 1")->row_array();
        $saldo_masuk_hari_ini = $this->db->query("SELECT SUM(debit) as saldo_masuk_hari_ini FROM riwayat_transaksi WHERE tanggal = '$hari_ini'")->row_array();
        $saldo_keluar_hari_ini = $this->db->query("SELECT SUM(kredit) as saldo_keluar_hari_ini FROM riwayat_transaksi WHERE tanggal = '$hari_ini'")->row_array();

		$data['transaksi'] = $transaksi;
		$data['siswa'] = $siswa;
		$data['saldo_saat_ini'] = $saldo_saat_ini;
		$data['saldo_masuk_hari_ini'] = $saldo_masuk_hari_ini;
		$data['saldo_keluar_hari_ini'] = $saldo_keluar_hari_ini;
		$data['check_saldo'] = $check_saldo;

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

    public function export()
    {
        $if_start = $this->session->flashdata('if_start');
        $if_end = $this->session->flashdata('if_end');
        
        if (isset($if_start)) {
            $transaksi = $this->M_Transaksi->getDataTransaksifiltered($if_start, $if_end);
        } else {
            $transaksi = $this->M_Transaksi->getDataTransaksi();
        }
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Transaksi - Bank Mini.xlsx"');
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'No');
        $activeWorksheet->setCellValue('B1', 'Tanggal');
        $activeWorksheet->setCellValue('C1', 'No. Transaksi');
        $activeWorksheet->setCellValue('D1', 'Nama Siswa');
        $activeWorksheet->setCellValue('E1', 'Jenis Tabungan');
        $activeWorksheet->setCellValue('F1', 'Debit');
        $activeWorksheet->setCellValue('G1', 'Kredit');
        $activeWorksheet->setCellValue('H1', 'Saldo');

        $no = 1;
        $sn = 2;

        foreach($transaksi as $transaksi){
            $activeWorksheet->setCellValue('A'. $sn, $no++);
            $activeWorksheet->setCellValue('B'. $sn, $transaksi->tanggal);
            $activeWorksheet->setCellValue('C'. $sn, $transaksi->id_transaksi);
            $activeWorksheet->setCellValue('D'. $sn, $transaksi->nama_siswa);
            $activeWorksheet->setCellValue('E'. $sn, $transaksi->jenis_tabungan);
            $activeWorksheet->setCellValue('F'. $sn, $transaksi->debit);
            $activeWorksheet->setCellValue('G'. $sn, $transaksi->kredit);
            $activeWorksheet->setCellValue('H'. $sn, $transaksi->saldo);
            $sn++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }

    public function print()
    {   
        $if_start = $this->session->flashdata('if_start');
        $if_end = $this->session->flashdata('if_end');
        
        if (isset($if_start)) {
            $data['transaksi'] = $this->M_Transaksi->getDataTransaksifiltered($if_start, $if_end);
        } else {
            $data['transaksi'] = $this->M_Transaksi->getDataTransaksi();
        }

        $this->load->view('V_Print', $data);
    }

    // public function pdf()
    // {
    //     $if_start = $this->session->flashdata('if_start');
    //     $if_end = $this->session->flashdata('if_end');
        
    //     if (isset($if_start)) {
    //         $transaksi = $this->M_Transaksi->getDataTransaksifiltered($if_start, $if_end);
    //     } else {
    //         $transaksi = $this->M_Transaksi->getDataTransaksi();
    //     }
    //     $data['transaksi'] = $transaksi;
    
    //     $this->load->library('dompdf_gen');
    //     $this->load->view('V_PdfTransaksi', $data);
    
    //     $paper_size = 'A4';
    //     $orientation = 'portrait';
    //     $html = $this->output->get_output();
    
    //     $this->dompdf->set_paper($paper_size, $orientation);
    //     $this->dompdf->load_html($html);
    //     $this->dompdf->render();
    //     $this->dompdf->stream('Data Transaksi.pdf', array('Attachment' => 0));
    // }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class C_Tahunan extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
		$this->load->model('M_Kelas');
		$this->load->model('M_Siswa');
		$this->load->model('M_Transaksi');
        date_default_timezone_set('Asia/Jakarta');

		if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Harap Login terlebih dahulu!</div>');
            redirect('');
        }
		
	}

	public function index()
	{
		$profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

		$title['title'] = 'Tabungan Tahunan - Bank Mini';

		$year['year'] = date('Y');

        $hari_ini = date('Y-m-d'); 
		$kelas = $this->M_Kelas->getDataKelas();
		$siswa = $this->M_Siswa->getDataSiswa();
		$transaksi = $this->M_Transaksi->getDataTransaksiTahunan();
        $saldo_saat_ini = $this->db->query("SELECT SUM(debit - kredit) as saldo_tahunan FROM riwayat_transaksi WHERE jenis_tabungan = 'Tabungan Tahunan'")->row_array();
        $saldo_tahunan_masuk_hari_ini = $this->db->query("SELECT SUM(debit) as saldo_tahunan_masuk_hari_ini FROM riwayat_transaksi WHERE jenis_tabungan = 'Tabungan Tahunan' AND tanggal = '$hari_ini'")->row_array();
        $saldo_tahunan_keluar_hari_ini = $this->db->query("SELECT SUM(kredit) as saldo_tahunan_keluar_hari_ini FROM riwayat_transaksi WHERE jenis_tabungan = 'Tabungan Tahunan' AND tanggal = '$hari_ini'")->row_array();

		$data['kelas'] = $kelas;
		$data['siswa'] = $siswa;
		$data['transaksi'] = $transaksi;
		$data['saldo_saat_ini'] = $saldo_saat_ini;
		$data['saldo_tahunan_masuk_hari_ini'] = $saldo_tahunan_masuk_hari_ini;
		$data['saldo_tahunan_keluar_hari_ini'] = $saldo_tahunan_keluar_hari_ini;

		$this->load->view('_partials/_head', $title);
		$this->load->view('_partials/_navbar', $profil);
		$this->load->view('_partials/_sidebar');
		$this->load->view('tabungan/tahunan/V_Tahunan', $data);
		$this->load->view('_partials/_footer', $year);
	}

	public function mutasi($id)
	{
		$profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

		$title['title'] = 'Mutasi Tabungan Tahunan - Bank Mini';

		$year['year'] = date('Y');

		$kelas = $this->M_Kelas->getDataKelas();
		$siswa = $this->M_Siswa->getDataSiswaDetail($id);
		$transaksi = $this->M_Transaksi->getDataTransaksiTahunanDetail($id);
        $saldo_saat_ini = $this->db->query("SELECT saldo_tahunan FROM riwayat_transaksi WHERE nis = '$id' ORDER BY id_transaksi DESC LIMIT 1")->row_array();

        $check_saldo = $this->db->query("SELECT saldo FROM riwayat_transaksi WHERE nis = $id ORDER BY id_transaksi DESC LIMIT 1")->row_array();
        $check_transaksi = $this->db->query("SELECT id_transaksi FROM riwayat_transaksi WHERE nis = $id ORDER BY id_transaksi DESC LIMIT 1")->row_array();

		$data['kelas'] = $kelas;
		$data['siswa'] = $siswa;
		$data['transaksi'] = $transaksi;
		$data['saldo_saat_ini'] = $saldo_saat_ini;
		$data['check_saldo'] = $check_saldo;

		$this->load->view('_partials/_head', $title);
		$this->load->view('_partials/_navbar', $profil);
		$this->load->view('_partials/_sidebar');
		$this->load->view('tabungan/tahunan/V_Mutasi', $data);
		$this->load->view('_partials/_footer', $year);
	}

    public function export()
    {
        $data_tabungan_tahunan = $this->M_Transaksi->getDataTransaksiTahunan();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Tabungan Tahunan - Bank Mini.xlsx"');
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'No');
        $activeWorksheet->setCellValue('B1', 'NIS');
        $activeWorksheet->setCellValue('C1', 'Nama Siswa');
        $activeWorksheet->setCellValue('D1', 'Kelas');

        $no = 1;
        $sn = 2;

        foreach($data_tabungan_tahunan as $data_tabungan_tahunan){
            $activeWorksheet->setCellValue('A'. $sn, $no++);
            $activeWorksheet->setCellValue('B'. $sn, $data_tabungan_tahunan->nis);
            $activeWorksheet->setCellValue('C'. $sn, $data_tabungan_tahunan->nama_siswa);
            $activeWorksheet->setCellValue('D'. $sn, $data_tabungan_tahunan->kelas);
            $sn++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }

    public function export_mutasi($id)
    {
        $mutasi_tabungan_tahunan = $this->M_Transaksi->getDataTransaksiTahunanDetail($id);

        $judul = $this->M_Siswa->getDataSiswaDetail($id);
        
        $nama = $judul->nama_siswa;

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Mutasi Tabungan Tahunan - Bank Mini.xlsx"');
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'No');
        $activeWorksheet->setCellValue('B1', 'Tanggal');
        $activeWorksheet->setCellValue('C1', 'No. Transaksi');
        $activeWorksheet->setCellValue('D1', 'Keterangan');
        $activeWorksheet->setCellValue('E1', 'Debit');
        $activeWorksheet->setCellValue('F1', 'Kredit');
        $activeWorksheet->setCellValue('G1', 'Saldo');
        $activeWorksheet->setCellValue('H1', 'Nama Petugas');

        $no = 1;
        $sn = 2;

        foreach($mutasi_tabungan_tahunan as $mutasi_tabungan_tahunan){
            $activeWorksheet->setCellValue('A'. $sn, $no++);
            $activeWorksheet->setCellValue('B'. $sn, $mutasi_tabungan_tahunan->tanggal);
            $activeWorksheet->setCellValue('C'. $sn, $mutasi_tabungan_tahunan->id_transaksi);
            $activeWorksheet->setCellValue('D'. $sn, $mutasi_tabungan_tahunan->keterangan);
            $activeWorksheet->setCellValue('E'. $sn, $mutasi_tabungan_tahunan->debit);
            $activeWorksheet->setCellValue('F'. $sn, $mutasi_tabungan_tahunan->kredit);
            $activeWorksheet->setCellValue('G'. $sn, $mutasi_tabungan_tahunan->saldo);
            $activeWorksheet->setCellValue('H'. $sn, $mutasi_tabungan_tahunan->nama_lengkap);
            $sn++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }

    public function print()
    {   
        $data['tahunan'] = $this->M_Transaksi->getDataTransaksiTahunan();
        $this->load->view('tabungan/tahunan/V_Print', $data);
    }

    public function print_mutasi($id)
    {   
        $data['mutasi_tahunan'] = $this->M_Transaksi->getDataTransaksiTahunanDetail($id);
        $this->load->view('tabungan/tahunan/V_PrintMutasi', $data);
    }
}

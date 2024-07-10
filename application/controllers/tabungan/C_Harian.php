<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class C_Harian extends CI_Controller {

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

		$title['title'] = 'Tabungan Harian - Bank Mini';

		$year['year'] = date('Y');

        $hari_ini = date('Y-m-d');
		$kelas = $this->M_Kelas->getDataKelas();
		$siswa = $this->M_Siswa->getDataSiswa();
		$transaksi = $this->M_Transaksi->getDataTransaksiHarian();
        $saldo_saat_ini = $this->db->query("SELECT SUM(debit - kredit) as saldo_harian FROM riwayat_transaksi WHERE jenis_tabungan = 'Tabungan Harian'")->row_array();
        $saldo_harian_masuk_hari_ini = $this->db->query("SELECT SUM(debit) as saldo_harian_masuk_hari_ini FROM riwayat_transaksi WHERE jenis_tabungan = 'Tabungan Harian' AND tanggal = '$hari_ini'")->row_array();
        $saldo_harian_keluar_hari_ini = $this->db->query("SELECT SUM(kredit) as saldo_harian_keluar_hari_ini FROM riwayat_transaksi WHERE jenis_tabungan = 'Tabungan Harian' AND tanggal = '$hari_ini'")->row_array();

		$data['kelas'] = $kelas;
		$data['siswa'] = $siswa;
		$data['transaksi'] = $transaksi;
		$data['saldo_saat_ini'] = $saldo_saat_ini;
		$data['saldo_harian_masuk_hari_ini'] = $saldo_harian_masuk_hari_ini;
		$data['saldo_harian_keluar_hari_ini'] = $saldo_harian_keluar_hari_ini;

		$this->load->view('_partials/_head', $title);
		$this->load->view('_partials/_navbar', $profil);
		$this->load->view('_partials/_sidebar');
		$this->load->view('tabungan/harian/V_Harian', $data);
		$this->load->view('_partials/_footer', $year);
	}

	public function mutasi($id)
	{
		$profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

		$title['title'] = 'Mutasi Tabungan Harian - Bank Mini';

		$year['year'] = date('Y');

		$kelas = $this->M_Kelas->getDataKelas();
		$siswa = $this->M_Siswa->getDataSiswaDetail($id);
		$transaksi = $this->M_Transaksi->getDataTransaksiHarianDetail($id);
		$saldo_saat_ini = $this->db->query("SELECT saldo_harian FROM riwayat_transaksi WHERE nis = '$id' ORDER BY id_transaksi DESC LIMIT 1")->row_array();
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
		$this->load->view('tabungan/harian/V_Mutasi', $data);
		$this->load->view('_partials/_footer', $year);
	}

    public function export()
    {
        $data_tabungan_harian = $this->M_Transaksi->getDataTransaksiHarian();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Tabungan Harian - Bank Mini.xlsx"');
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'No');
        $activeWorksheet->setCellValue('B1', 'NIS');
        $activeWorksheet->setCellValue('C1', 'Nama Siswa');
        $activeWorksheet->setCellValue('D1', 'Kelas');

        $no = 1;
        $sn = 2;

        foreach($data_tabungan_harian as $data_tabungan_harian){
            $activeWorksheet->setCellValue('A'. $sn, $no++);
            $activeWorksheet->setCellValue('B'. $sn, $data_tabungan_harian->nis);
            $activeWorksheet->setCellValue('C'. $sn, $data_tabungan_harian->nama_siswa);
            $activeWorksheet->setCellValue('D'. $sn, $data_tabungan_harian->kelas);
            $sn++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }

    public function export_mutasi($id)
    {
        $mutasi_tabungan_harian = $this->M_Transaksi->getDataTransaksiHarianDetail($id);

        $judul = $this->M_Siswa->getDataSiswaDetail($id);
        
        $nama = $judul->nama_siswa;

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Mutasi Tabungan Harian - Bank Mini.xlsx"');
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

        foreach($mutasi_tabungan_harian as $mutasi_tabungan_harian){
            $activeWorksheet->setCellValue('A'. $sn, $no++);
            $activeWorksheet->setCellValue('B'. $sn, $mutasi_tabungan_harian->tanggal);
            $activeWorksheet->setCellValue('C'. $sn, $mutasi_tabungan_harian->id_transaksi);
            $activeWorksheet->setCellValue('D'. $sn, $mutasi_tabungan_harian->keterangan);
            $activeWorksheet->setCellValue('E'. $sn, $mutasi_tabungan_harian->debit);
            $activeWorksheet->setCellValue('F'. $sn, $mutasi_tabungan_harian->kredit);
            $activeWorksheet->setCellValue('G'. $sn, $mutasi_tabungan_harian->saldo);
            $activeWorksheet->setCellValue('H'. $sn, $mutasi_tabungan_harian->nama_lengkap);
            $sn++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }
}

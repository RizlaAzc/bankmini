<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class C_Siswa extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
		$this->load->model('M_Siswa');
		$this->load->model('M_Kelas');
        date_default_timezone_set('Asia/Jakarta');

		if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Harap Login terlebih dahulu!</div>');
            redirect('');
        }
		
	}

	public function index()
	{
		$profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

		$title['title'] = 'Data Siswa - Bank Mini';

		$year['year'] = date('Y');

		$siswa = $this->M_Siswa->getDataSiswa();
		$kelas = $this->M_Kelas->getDataKelas();

		$data['siswa'] = $siswa;
		$data['kelas'] = $kelas;

		$this->load->view('_partials/_head', $title);
		$this->load->view('_partials/_navbar', $profil);
		$this->load->view('_partials/_sidebar');
		$this->load->view('data/siswa/V_Siswa', $data);
		$this->load->view('_partials/_footer', $year);
	}

	public function edit($id)
	{
		$profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

		$title['title'] = 'Edit Siswa - Bank Mini';

		$year['year'] = date('Y');

		$kelas = $this->M_Kelas->getDataKelas();
		$siswa = $this->M_Siswa->getDataSiswaDetail($id);

		$data['siswa'] = $siswa;
		$data['kelas'] = $kelas;

		$this->load->view('_partials/_head', $title);
		$this->load->view('_partials/_navbar', $profil);
		$this->load->view('_partials/_sidebar');
		$this->load->view('data/siswa/V_Edit', $data);
		$this->load->view('_partials/_footer', $year);
	}

	public function fungsi_tambah()
    {
        $profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

        $nis = $this->input->post('nis');
        $nama_siswa = $this->input->post('nama_siswa');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $kelas = $this->input->post('kelas');

        $ArrInsert = array(
            'nis' => $nis,
            'nama_siswa' => $nama_siswa,
            'jenis_kelamin' => $jenis_kelamin,
            'kelas' => $kelas
        );

        $this->M_Siswa->insertDataSiswa($ArrInsert);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
		redirect($_SERVER['HTTP_REFERER']);
    }

	public function fungsi_edit()
    {
        $profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

        $nis = $this->input->post('nis');
        $nama_siswa = $this->input->post('nama_siswa');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $kelas = $this->input->post('kelas');

        $ArrUpdate = array(
            'nis' => $nis,
            'nama_siswa' => $nama_siswa,
            'jenis_kelamin' => $jenis_kelamin,
            'kelas' => $kelas
        );

        $this->M_Siswa->updateDataSiswa($nis, $ArrUpdate);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil di edit!</div>');
        redirect(base_url('siswa'));
    }

	public function fungsi_hapus($id)
    {
        $profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

        $this->M_Siswa->hapusDataSiswa($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil di hapus!</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
    
    
    public function download_template()
    {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Template Import Data Siswa - Bank Mini.xlsx"');
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'NIS');
        $activeWorksheet->setCellValue('B1', 'Nama Siswa');
        $activeWorksheet->setCellValue('C1', 'Jenis Kelamin');
        $activeWorksheet->setCellValue('D1', 'Kelas');
        
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }

    public function import()
    {
        $upload_file = $_FILES['file']['name'];
        $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
        if($extension == 'csv')
        {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        }else if($extension == 'xls')
        {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }else
        {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
        $sheetdata = $spreadsheet->getActiveSheet()->toArray();
        $sheetcount = count($sheetdata);
        if($sheetcount > 1)
        {
            $data = array();
            for ($i = 1; $i < $sheetcount; $i++){
                $nis = $sheetdata[$i][0];
                $nama_siswa = $sheetdata[$i][1];
                $jenis_kelamin = $sheetdata[$i][2];
                $kelas = $sheetdata[$i][3];
                $data[] = array(
                    'nis' => $nis,
                    'nama_siswa' => $nama_siswa,
                    'jenis_kelamin' => $jenis_kelamin,
                    'kelas' => $kelas,
                );
            }
            $insertdata = $this->M_Siswa->insertDataSiswaImport($data);
            if($insertdata)
            {
                $message = array(
                    'pesan'=>'<div class="alert alert-success">Impor data siswa telah berhasil!</div>',
                );
                
                $this->session->set_flashdata($message);
                redirect($_SERVER['HTTP_REFERER']);
            }else{
                $message = array(
                    'pesan'=>'<div class="alert alert-danger">Impor data siswa gagal, silahkan coba lagi!</div>',
                );
                
                $this->session->set_flashdata($message);
                redirect($_SERVER['HTTP_REFERER']);   
            }
        }
    }
    
    public function export()
    {
        $data_siswa = $this->M_Siswa->getDataSiswa();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Siswa - Bank Mini.xlsx"');
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'No');
        $activeWorksheet->setCellValue('B1', 'NIS');
        $activeWorksheet->setCellValue('C1', 'Nama Siswa');
        $activeWorksheet->setCellValue('D1', 'Jenis Kelamin');
        $activeWorksheet->setCellValue('E1', 'Kelas');

        $no = 1;
        $sn = 2;
        
        foreach($data_siswa as $data_siswa){
            $activeWorksheet->setCellValue('A'. $sn, $no++);
            $activeWorksheet->setCellValue('B'. $sn, $data_siswa->nis);
            $activeWorksheet->setCellValue('C'. $sn, $data_siswa->nama_siswa);
            $activeWorksheet->setCellValue('D'. $sn, $data_siswa->jenis_kelamin);
            $activeWorksheet->setCellValue('E'. $sn, $data_siswa->kelas);
            $sn++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }

    public function print()
    {
        $data['siswa'] = $this->M_Siswa->getDataSiswa();
        $this->load->view('data/siswa/V_Print', $data);
    }
}

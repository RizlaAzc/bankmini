<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class C_Kelas extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
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

		$title['title'] = 'Data Kelas - Bank Mini';

		$year['year'] = date('Y');

		$kelas = $this->M_Kelas->getDataKelas();

		$data['kelas'] = $kelas;

		$this->load->view('_partials/_head', $title);
		$this->load->view('_partials/_navbar', $profil);
		$this->load->view('_partials/_sidebar');
		$this->load->view('data/kelas/V_Kelas', $data);
		$this->load->view('_partials/_footer', $year);
	}

	public function edit($id)
	{
		$profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

		$title['title'] = 'Edit Kelas - Bank Mini';

		$year['year'] = date('Y');

		$kelas = $this->M_Kelas->getDataKelasDetail($id);

		$data['kelas'] = $kelas;

		$this->load->view('_partials/_head', $title);
		$this->load->view('_partials/_navbar', $profil);
		$this->load->view('_partials/_sidebar');
		$this->load->view('data/kelas/V_Edit', $data);
		$this->load->view('_partials/_footer', $year);
	}

	public function fungsi_tambah()
    {
        $profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

        $kelas = $this->input->post('kelas');
        $kompetensi_keahlian = $this->input->post('kompetensi_keahlian');

        $ArrInsert = array(
            'kelas' => $kelas,
            'kompetensi_keahlian' => $kompetensi_keahlian
        );

        $this->M_Kelas->insertDataKelas($ArrInsert);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
		redirect($_SERVER['HTTP_REFERER']);
    }

	public function fungsi_edit()
    {
        $profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

        $id = $this->input->post('id_kelas');
        $kelas = $this->input->post('kelas');
        $kompetensi_keahlian = $this->input->post('kompetensi_keahlian');

        $ArrUpdate = array(
            'id_kelas' => $id,
            'kelas' => $kelas,
            'kompetensi_keahlian' => $kompetensi_keahlian
        );

        $this->M_Kelas->updateDataKelas($id, $ArrUpdate);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil di edit!</div>');
        redirect(base_url('kelas'));
    }

	public function fungsi_hapus($id)
    {
        $profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

        $this->M_Kelas->hapusDataKelas($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function download_template()
    {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Template Import Data Kelas - Bank Mini.xlsx"');
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Kelas');
        $activeWorksheet->setCellValue('B1', 'Kompetensi Keahlian');
        
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
                $kelas = $sheetdata[$i][0];
                $kompetensi_keahlian = $sheetdata[$i][1];
                $data[] = array(
                    'kelas' => $kelas,
                    'kompetensi_keahlian' => $kompetensi_keahlian,
                );
            }
            $insertdata = $this->M_Kelas->insertDataKelasImport($data);
            if($insertdata)
            {
                $message = array(
                    'pesan'=>'<div class="alert alert-success">Impor data kelas telah berhasil!</div>',
                );
                
                $this->session->set_flashdata($message);
                redirect($_SERVER['HTTP_REFERER']);
            }else{
                $message = array(
                    'pesan'=>'<div class="alert alert-danger">Impor data kelas gagal, silahkan coba lagi!</div>',
                );
                
                $this->session->set_flashdata($message);
                redirect($_SERVER['HTTP_REFERER']);   
            }
        }
    }

    public function export()
    {
        $data_kelas = $this->M_Kelas->getDataKelas();

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Data Kelas - Bank Mini.xlsx"');
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'No');
        $activeWorksheet->setCellValue('B1', 'Kelas');
        $activeWorksheet->setCellValue('C1', 'Kompetensi Keahlian');

        $no = 1;
        $sn = 2;

        foreach($data_kelas as $data_kelas){
            $activeWorksheet->setCellValue('A'. $sn, $no++);
            $activeWorksheet->setCellValue('B'. $sn, $data_kelas->kelas);
            $activeWorksheet->setCellValue('C'. $sn, $data_kelas->kompetensi_keahlian);
            $sn++;
        }
        
        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }
}

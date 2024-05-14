<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Riwayat extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
		$this->load->model('M_Kelas');

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
		$this->load->view('transaksi/riwayat/V_Riwayat', $data);
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

	// public function export()
    // {
    //     $kelas = $this->M_Kelas->getDataKelas();
    //     $data['kelas'] = $kelas;

    //     require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
    //     require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

    //     $object = new PHPExcel();

    //     $object->getProperties()->setCreator("Bank Mini");
    //     $object->getProperties()->setLastModifiedBy("Bank Mini");
    //     $object->getProperties()->setTitle("Data Kelas");

    //     $object->setActiveSheetIndex(0);

    //     $object->getActiveSheet()->setCellValue('A1', 'NIM');
    //     $object->getActiveSheet()->setCellValue('B1', 'Nama Kelas');

    //     $baris = 2;
    //     // $no = 1;

    //     foreach($data['kelas'] as $kelas){
    //         $object->getActivateSheet()->setCellValue('A'. $baris, $kelas->nis);
    //         $object->getActivateSheet()->setCellValue('B'. $baris, $kelas->nama_kelas);

    //         $baris++;
    //     }

    //     $filename = "Data_Kelas". '.xlsx';

    //     $object->getActiveSheet()->setTitle("Data Kelas");

    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment; filename="'.$filename.'"');
    //     header('Cache-Control: max-age=0');

    //     $writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
    //     $writer->save('php://output');

    //     exit;
    // }

	public function import()
    {
        if(isset($_FILES["file"]["name"])){
                // upload
            $file_tmp = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];
            $file_size =$_FILES['file']['size'];
            $file_type=$_FILES['file']['type'];
            // move_uploaded_file($file_tmp,"uploads/".$file_name); // simpan filenya di folder uploads
            
            $object = PHPExcel_IOFactory::load($file_tmp);
    
            foreach($object->getWorksheetIterator() as $worksheet){
    
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
    
                for($row=4; $row<=$highestRow;  $row++){
    
                    $nis = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $nama_siswa = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $kelas = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $jenis_kelamin = $worksheet->getCellByColumnAndRow(3, $row)->getValue();

                    $data[] = array(
                        'nis'          => $nis,
                        'nama_siswa'          =>$nama_siswa,
                        'kelas'         =>$kelas,
                        'jenis_kelamin'         =>$jenis_kelamin
                    );
    
                } 
    
            }

    
            $this->db->insert_batch('siswa', $data);
    
            $message = array(
                'pesan'=>'<div class="alert alert-success">Impor data siswa telah berhasil!</div>',
            );
            
            $this->session->set_flashdata($message);
            redirect($_SERVER['HTTP_REFERER']);
        }
        else
        {
                $message = array(
                'pesan'=>'<div class="alert alert-danger">Impor data siswa gagal, silahkan coba lagi!</div>',
            );
            
            $this->session->set_flashdata($message);
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}

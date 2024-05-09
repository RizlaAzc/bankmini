<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Siswa extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
		$this->load->model('M_Siswa');
		$this->load->model('M_Kelas');

		if (!$this->session->userdata('email')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Harap Login terlebih dahulu!</div>');
            redirect('');
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
		$profil['profil'] = $this->db->get_where('petugas', ['email' => $this->session->userdata('email')])->row_array();

		$title['title'] = 'Data Siswa - Pembayaran SPP';

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

		$title['title'] = 'Edit Siswa - Pembayaran SPP';

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

	public function excel()
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
						// var_dump($data);
						// die;
        
                    } 
        
                }

        
                $this->db->insert_batch('siswa', $data);
        
                $message = array(
                    'pesan'=>'<div class="alert alert-success">Import data siswa berhasil</div>',
                );
                
                $this->session->set_flashdata($message);
                redirect($_SERVER['HTTP_REFERER']);
            }
            else
            {
                 $message = array(
                    'pesan'=>'<div class="alert alert-danger">Import data siswa gagal, coba lagi</div>',
                );
                
                $this->session->set_flashdata($message);
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
}

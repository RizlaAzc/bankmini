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
        $check_saldo = $this->db->query("SELECT saldo FROM riwayat_transaksi")->result();
        $saldo_saat_ini = $this->db->query("SELECT saldo FROM riwayat_transaksi ORDER BY id_transaksi DESC LIMIT 1")->row_array();

		$data['transaksi'] = $transaksi;
		$data['siswa'] = $siswa;
		$data['saldo_saat_ini'] = $saldo_saat_ini;
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

    // public function export()
    // {
    //     // Load plugin PHPExcel nya
    //     include APPPATH.'libraries/PHPExcel.php';
        
    //     // Panggil class PHPExcel nya
    //     $excel = new PHPExcel();
    //     // Settingan awal fil excel
    //     $excel->getProperties()->setCreator('Bank Mini - SMK YAJ Depok')
    //                  ->setLastModifiedBy('Bank Mini - SMK YAJ Depok')
    //                  ->setTitle("Data Transaksi")
    //                  ->setSubject("Transaksi Bank Mini")
    //                  ->setDescription("Laporan Semua Data Transaksi")
    //                  ->setKeywords("Data Transaksi");
    //     // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    //     $style_col = array(
    //       'font' => array('bold' => true), // Set font nya jadi bold
    //       'alignment' => array(
    //         'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
    //         'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    //       ),
    //       'borders' => array(
    //         'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    //         'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    //         'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    //         'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    //       )
    //     );
    //     // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    //     $style_row = array(
    //       'alignment' => array(
    //         'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    //       ),
    //       'borders' => array(
    //         'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
    //         'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
    //         'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
    //         'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    //       )
    //     );
    //     $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA TRANSAKSI"); // Set kolom A1 dengan tulisan "DATA SISWA"
    //     $excel->getActiveSheet()->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai E1
    //     $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    //     $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    //     $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    //     // Buat header tabel nya pada baris ke 3
    //     $excel->setActiveSheetIndex(0)->setCellValue('A3', "Tanggal"); // Set kolom A3 dengan tulisan "NO"
    //     $excel->setActiveSheetIndex(0)->setCellValue('B3', "No. Transaksi"); // Set kolom B3 dengan tulisan "NIS"
    //     $excel->setActiveSheetIndex(0)->setCellValue('C3', "Nama Siswa"); // Set kolom C3 dengan tulisan "NAMA"
    //     $excel->setActiveSheetIndex(0)->setCellValue('D3', "Jenis Tabungan"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
    //     $excel->setActiveSheetIndex(0)->setCellValue('E3', "Debit"); // Set kolom E3 dengan tulisan "ALAMAT"
    //     $excel->setActiveSheetIndex(0)->setCellValue('F3', "Kredit"); // Set kolom E3 dengan tulisan "ALAMAT"
    //     $excel->setActiveSheetIndex(0)->setCellValue('G3', "Saldo"); // Set kolom E3 dengan tulisan "ALAMAT"
    //     // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    //     $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    //     $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    //     $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    //     $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
    //     $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
    //     $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
    //     $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
    //     // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    //     // $siswa = $this->SiswaModel->view();
    //     $transaksi = $this->M_Transaksi->getDataTransaksi();
    //     $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    //     $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    //     foreach($transaksi as $data){ // Lakukan looping pada variabel siswa
    //       $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->tanggal);
    //       $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->id_transaksi);
    //       $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nama_siswa);
    //       $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->jenis_tabungan);
    //       $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->debit);
    //       $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data->kredit);
    //       $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data->saldo);
          
    //       // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
    //       $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
    //       $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
    //       $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
    //       $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
    //       $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
    //       $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
    //       $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
          
    //       $no++; // Tambah 1 setiap kali looping
    //       $numrow++; // Tambah 1 setiap kali looping
    //     }
    //     // Set width kolom
    //     $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
    //     $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
    //     $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
    //     $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
    //     $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
    //     $excel->getActiveSheet()->getColumnDimension('F')->setWidth(30); // Set width kolom E
    //     $excel->getActiveSheet()->getColumnDimension('G')->setWidth(30); // Set width kolom E
        
    //     // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    //     $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    //     // Set orientasi kertas jadi LANDSCAPE
    //     $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    //     // Set judul file excel nya
    //     $excel->getActiveSheet(0)->setTitle("Laporan Data Transaksi - Bank Mini");
    //     $excel->setActiveSheetIndex(0);
    //     // Proses file excel
    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment; filename="Data Transaksi - Bank Mini.xlsx"'); // Set nama file excel nya
    //     header('Cache-Control: max-age=0');
    //     $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    //     $write->save('php://output');
    //   }

    public function export()
    {
        $siswa = $this->M_Transaksi->getDataTransaksi();
        $data['transaksi'] = $transaksi;

        require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel();

        $object->getProperties()->setCreator("Bank Mini");
        $object->getProperties()->setLastModifiedBy("Bank Mini");
        $object->getProperties()->setTitle("Data Siswa");

        $object->setActiveSheetIndex(0);

        $object->getActiveSheet()->setCellValue('A1', 'NIM');
        $object->getActiveSheet()->setCellValue('B1', 'Nama Siswa');
        $object->getActiveSheet()->setCellValue('C1', 'Jenis Kelamin');
        $object->getActiveSheet()->setCellValue('D1', 'Kelas');

        $baris = 2;
        // $no = 1;

        foreach($data['siswa'] as $siswa){
            $object->getActivateSheet()->setCellValue('A'. $baris, $siswa->nis);
            $object->getActivateSheet()->setCellValue('B'. $baris, $siswa->nama_siswa);
            $object->getActivateSheet()->setCellValue('C'. $baris, $siswa->jenis_kelamin);
            $object->getActivateSheet()->setCellValue('D'. $baris, $siswa->kelas);

            $baris++;
        }

        $filename = "Data_Siswa". '.xlsx';

        $object->getActiveSheet()->setTitle("Data Siswa");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Cache-Control: max-age=0');

        $writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
        $writer->save('php://output');

        exit;
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Transaksi extends CI_Model
{
    function getDataTransaksi()
    {
        $this->db->join('siswa', 'siswa.nis = riwayat_transaksi.nis');
        $this->db->order_by("id_transaksi", "asc");
        $query = $this->db->get('riwayat_transaksi');
        return $query->result();
    }

    function getDataTransaksifiltered($date_start, $date_end)
    {
        $this->db->join('siswa', 'siswa.nis = riwayat_transaksi.nis');
        $this->db->where("tanggal BETWEEN '$date_start' AND '$date_end'");
        $this->db->order_by("id_transaksi", "asc");
        $query = $this->db->get('riwayat_transaksi');
        return $query->result();
    }
    
    function getDataTransaksiHarian()
    {
        $this->db->join('siswa', 'siswa.nis = riwayat_transaksi.nis');
        // $this->db->order_by("id_transaksi", "desc limit 1");
        $this->db->where('jenis_tabungan', 'Tabungan Harian');
        $this->db->group_by("nama_siswa");
        $query = $this->db->get('riwayat_transaksi');
        return $query->result();
    }

    function getDataTransaksiTahunan()
    {
        $this->db->join('siswa', 'siswa.nis = riwayat_transaksi.nis');
        $this->db->where('jenis_tabungan', 'Tabungan Tahunan');
        // $this->db->order_by("saldo_tahunan", "desc");
        $this->db->group_by("nama_siswa");
        $query = $this->db->get('riwayat_transaksi');
        return $query->result();
    }
    
    function insertDataTransaksi($data)
    {
        $this->db->insert('riwayat_transaksi', $data);
    }
    
    function getDataTransaksiHarianDetail($id)
    {
        $this->db->join('petugas', 'petugas.id_petugas = riwayat_transaksi.id_petugas');
        $this->db->where('nis', $id);
        $this->db->where('jenis_tabungan', 'Tabungan Harian');
        $this->db->order_by("id_transaksi", "asc");
        $query =  $this->db->get('riwayat_transaksi');
        return $query->result();
    }

    function getDataTransaksiTahunanDetail($id)
    {
        $this->db->join('petugas', 'petugas.id_petugas = riwayat_transaksi.id_petugas');
        $this->db->where('nis', $id);
        $this->db->where('jenis_tabungan', 'Tabungan Tahunan');
        $this->db->order_by("id_transaksi", "asc");
        $query =  $this->db->get('riwayat_transaksi');
        return $query->result();
    }

    function updateDataTransaksi($id, $data)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->update('riwayat_transaksi', $data);
    }

    function hapusDataTransaksi($id)
    {
        $this->db->where('id_transaksi', $id);
        $this->db->delete('riwayat_transaksi');
    }

    function cari($id){
        $query= $this->db->get_where('siswa',array('nama_siswa'=>$id));
        return $query;
    }
}

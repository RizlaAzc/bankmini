<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Transaksi extends CI_Model
{
    function getDataTransaksi()
    {
        $this->db->join('siswa', 'siswa.nis = riwayat_transaksi.nis');
        $query = $this->db->get('riwayat_transaksi');
        return $query->result();
    }

    function insertDataTransaksi($data)
    {
        $this->db->insert('riwayat_transaksi', $data);
    }

    function getDataTransaksiDetail($id)
    {
        $this->db->where('id_transaksi', $id);
        $query =  $this->db->get('riwayat_transaksi');
        return $query->row();
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
}
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Pembayaran extends CI_Model
{
    function getDataPembayaran()
    {
        $query = $this->db->get('pembayaran');
        return $query->result();
    }

    function insertDataPembayaran($data)
    {
        $this->db->insert('pembayaran', $data);
    }

    function getDataPembayaranDetail($id)
    {
        $this->db->where('id_pembayaran', $id);
        $query =  $this->db->get('pembayaran');
        return $query->row();
    }

    function updateDataPembayaran($id, $data)
    {
        $this->db->where('id_pembayaran', $id);
        $this->db->update('pembayaran', $data);
    }

    function hapusDataPembayaran($id)
    {
        $this->db->where('id_pembayaran', $id);
        $this->db->delete('pembayaran');
    }
}

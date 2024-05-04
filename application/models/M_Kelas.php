<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Kelas extends CI_Model
{
    function getDataKelas()
    {
        $query = $this->db->get('kelas');
        return $query->result();
    }

    function insertDataKelas($data)
    {
        $this->db->insert('kelas', $data);
    }

    function getDataKelasDetail($id)
    {
        $this->db->where('id_kelas', $id);
        $query =  $this->db->get('kelas');
        return $query->row();
    }

    function updateDataKelas($id, $data)
    {
        $this->db->where('id_kelas', $id);
        $this->db->update('kelas', $data);
    }

    function hapusDataKelas($id)
    {
        $this->db->where('id_kelas', $id);
        $this->db->delete('kelas');
    }
}

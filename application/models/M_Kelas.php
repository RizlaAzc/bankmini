<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Kelas extends CI_Model
{
    function getDataKelas()
    {
        $this->db->order_by("kelas", "asc");
        $this->db->order_by("kompetensi_keahlian", "asc");
        $query = $this->db->get('kelas');
        return $query->result();
    }

    function insertDataKelas($data)
    {
        $this->db->insert('kelas', $data);
    }

    function insertDataKelasImport($data)
    {
        $this->db->insert_batch('kelas', $data);
        if($this->db->affected_rows() > 0)
        {
            return 1;
        }
        else{
            return 0;
        }
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

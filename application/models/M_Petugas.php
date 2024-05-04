<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Petugas extends CI_Model
{
    function getDataPetugas()
    {
        $query = $this->db->get('petugas');
        return $query->result();
    }

    function insertDataPetugas($data)
    {
        $this->db->insert('petugas', $data);
    }

    function getDataPetugasDetail($id)
    {
        $this->db->where('id_petugas', $id);
        $query =  $this->db->get('petugas');
        return $query->row();
    }

    function updateDataPetugas($id, $data)
    {
        $this->db->where('id_petugas', $id);
        $this->db->update('petugas', $data);
    }

    function hapusDataPetugas($id)
    {
        $this->db->where('id_petugas', $id);
        $this->db->delete('petugas');
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Siswa extends CI_Model
{
    function getDataSiswa()
    {
        $query = $this->db->get('siswa');
        return $query->result();
    }

    function insertDataSiswa($data)
    {
        $this->db->insert('siswa', $data);
    }

    function getDataSiswaDetail($id)
    {
        $this->db->where('nisn', $id);
        $query =  $this->db->get('siswa');
        return $query->row();
    }

    function updateDataSiswa($id, $data)
    {
        $this->db->where('nisn', $id);
        $this->db->update('siswa', $data);
    }

    function hapusDataSiswa($id)
    {
        $this->db->where('nisn', $id);
        $this->db->delete('siswa');
    }
}

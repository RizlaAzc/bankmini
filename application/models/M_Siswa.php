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

    function insertDataSiswaImport($data)
    {
        $this->db->insert_batch('siswa', $data);
        if($this->db->affected_rows() > 0)
        {
            return 1;
        }
        else{
            return 0;
        }
    }

    function getDataSiswaDetail($id)
    {
        $this->db->where('nis', $id);
        $query =  $this->db->get('siswa');
        return $query->row();
    }

    function updateDataSiswa($id, $data)
    {
        $this->db->where('nis', $id);
        $this->db->update('siswa', $data);
    }

    function hapusDataSiswa($id)
    {
        $this->db->where('nis', $id);
        $this->db->delete('siswa');
    }
}

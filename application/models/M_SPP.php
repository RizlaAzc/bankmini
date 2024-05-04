<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_SPP extends CI_Model
{
    function getDataSPP()
    {
        $query = $this->db->get('spp');
        return $query->result();
    }

    function insertDataSPP($data)
    {
        $this->db->insert('spp', $data);
    }

    function getDataSPPDetail($id)
    {
        $this->db->where('id_spp', $id);
        $query =  $this->db->get('spp');
        return $query->row();
    }

    function updateDataSPP($id, $data)
    {
        $this->db->where('id_spp', $id);
        $this->db->update('spp', $data);
    }

    function hapusDataSPP($id)
    {
        $this->db->where('id_spp', $id);
        $this->db->delete('spp');
    }
}

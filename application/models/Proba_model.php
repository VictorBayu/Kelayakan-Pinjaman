<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Proba_model extends CI_Model
{
    public function getData()
    {
        return $this->db->get('tbl_proba')->result_array();
    }
    public function getDataNumerik()
    {
        return $this->db->get('tbl_numerik')->result_array();
    }
    public function gettes($value)
    {
        return $this->db->get_where(
            'tbl_proba',
            [
                'ID_atribut' => $value
            ]
        )->result_array();
    }
    public function groupIDatribut()
    {
        return $this->db->query("SELECT `ID_atribut` FROM `tbl_proba` GROUP BY `ID_atribut`")->result_array();
    }
    public function count_hasil()
    {
        return $this->db->get('tbl_hasil')->num_rows();
    }
    public function getDataHasil($limit, $start)
    {
        return $this->db->get('tbl_hasil', $limit, $start)->result_array();
    }
    public function getHasil()
    {
        return $this->db->get('tbl_hasil')->result_array();
    }
}

<?php
class Grafik_model extends CI_Model
{
    public function getID($value)
    {
        return $this->db->get_where(
            'tbl_grafik',
            [
                'id' => $value
            ]
        )->result_array();
    }
    public function getData()
    {
        return $this->db->query("SELECT `id` FROM `tbl_grafik`")->result_array();
    }
}

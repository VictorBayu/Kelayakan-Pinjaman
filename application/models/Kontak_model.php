<?php
class Kontak_model extends CI_Model
{
    public function getAllKontak()
    {
        return $this->db->get('Kontak_nasabah')->result_array();
    }
    public function getKontakNasabah()
    {
        return $this->db->get('kontak_nasabah')->result();
    }
    public function getKontak($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama_nasabah', $keyword);
        }
        return $this->db->get('Kontak_nasabah', $limit, $start)->result_array();
    }
    public function countAllKontak()
    {
        return $this->db->get('Kontak_nasabah')->num_rows();
    }
    public function updateNasabah($id)
    {
        $data = [
            "nama_nasabah" => $this->input->post('nama_nasabah', true),
            "no_nasabah" => $this->input->post('no_nasabah', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('kontak_nasabah', $data);
    }
    public function hapusNasabah($id_kontak)
    {
        $this->db->delete('kontak_nasabah', ['id_kontak' => $id_kontak]);
    }
}

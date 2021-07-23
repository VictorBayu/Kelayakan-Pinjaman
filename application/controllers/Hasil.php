<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hasil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
    }
    public function index()
    {
        $data['title'] = "Probabilitas";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Proba_model', 'num');
        $data['num'] = $this->num->getDataNumerik();

        $this->load->model('Proba_model');
        $idatrib = $this->Proba_model->groupIDatribut();
        $temp = [];
        for ($i = 0; $i < count($idatrib); $i++) {
            $idat = $idatrib[$i]['ID_atribut'];
            $temp[$idat] = $this->Proba_model->gettes($idat);
        }
        $data['temp'] = $temp;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('Hasil/proba', $data);
        $this->load->view('templates/footer');
    }
    public function evaluasi()
    {
        $data['title'] = "Evaluasi";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('data_model', 'de');
        //load library
        $this->load->library('pagination');
        //config
        $config['base_url'] = 'http://localhost/Skripsi/Hasil/evaluasi';
        $config['total_rows'] = $this->de->count_all_uji();
        $config['per_page'] = 15;
        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data['de'] = $this->de->getDataUji($config['per_page'], $data['start']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('Hasil/evaluasi', $data);
        $this->load->view('templates/footer');
    }
}

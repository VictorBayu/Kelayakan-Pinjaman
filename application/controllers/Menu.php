<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
    }
    public function index()
    {
        $data['title'] = "Menu Management";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                New Menu Added!!
            </div>'
            );
            redirect('menu');
        }
    }
    public function subMenu()
    {
        $data['title'] = "Sub Menu Management";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                New Sub Menu Added!!
            </div>'
            );
            redirect('menu/submenu');
        }
    }
    public function hapus($id)
    {
        $this->load->model('Menu_model', 'menu');
        $this->menu->hapusmenu($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Menu Success Delete !!
        </div>'
        );
        redirect('menu');
    }
    public function hapusSubMenu($id)
    {
        $this->load->model('Menu_model', 'menu');
        $this->menu->hapusSubMenu($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">Success Delete Sub Menu</div>'
        );
        redirect('menu/submenu');
    }
    public function ubahdataMenu()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
            Gagal update menu !!
        </div>'
            );
            redirect('menu');
        } else {
            $data = array(
                "menu" => $_POST['menu'],
            );
            $this->db->where('id', $_POST['id']);
            $this->db->update('user_menu', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Menu Success Update !!
            </div>'
            );
            redirect('menu');
        }
    }
    public function updateSubMenu()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('is_active', 'Active', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger" role="alert">
            Gagal update menu !!
        </div>'
            );
            redirect('menu/Submenu');
        } else {
            $data = array(
                "title" => $_POST['title'],
                "menu_id" => $_POST['menu_id'],
                "url" => $_POST['url'],
                "icon" => $_POST['icon'],
                "is_active" => $_POST['is_active'],
            );
            $this->db->where('id', $_POST['id']);
            $this->db->update('user_sub_menu', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Sub Menu Success Update !!
            </div>'
            );
            redirect('menu/Submenu');
        }
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
        $this->load->model('data_model');
        $this->load->model('hitung_model');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->load->model('Grafik_model');
        $id = $this->Grafik_model->getData();
        $temp = [];
        for ($i = 0; $i < count($id); $i++) {
            $id_data = $id[$i]['id'];
            $temp[$id_data] = $this->Grafik_model->getID($id_data);
        }
        $data['temp'] = $temp;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    public function pengajuan()
    {
        $data['title'] = "Pengajuan Pinjaman";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->load->model('data_model', 'user');
        $this->form_validation->set_rules('no', 'No', 'required');
        $this->form_validation->set_rules('gender', 'Gender', 'required');
        $this->form_validation->set_rules('marital', 'Married', 'required');
        $this->form_validation->set_rules('dependent', 'Dependents', 'required');
        $this->form_validation->set_rules('edu', 'Education', 'required');
        $this->form_validation->set_rules('self', 'Self_Employed', 'required');
        $this->form_validation->set_rules('gaji1', 'ApplicantIncome', 'required');
        $this->form_validation->set_rules('gaji2', 'CopplicantIncome', 'required');
        $this->form_validation->set_rules('pinjaman', 'LoanAmount', 'required');
        $this->form_validation->set_rules('tenor', 'Loan_Amount_Term', 'required');
        $this->form_validation->set_rules('history', 'Credit_History', 'required');
        $this->form_validation->set_rules('property', 'Property_Area', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pengajuan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'No' => $this->input->post('no'),
                'Gender' => $this->input->post('gender'),
                'Married' => $this->input->post('marital'),
                'Dependents' => $this->input->post('dependent'),
                'Education' => $this->input->post('edu'),
                'Self_Employed' => $this->input->post('self'),
                'ApplicantIncome' => $this->input->post('gaji1'),
                'CoapplicantIncome' => $this->input->post('gaji2'),
                'LoanAmount' => $this->input->post('pinjaman'),
                'Loan_Amount_Term' => $this->input->post('tenor'),
                'Credit_History' => $this->input->post('history'),
                'Property_Area' => $this->input->post('property')
            ];
            $this->db->insert('pengajuan', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Berhasil Mengajukan, Tunggu Konfirmasinya!!
            </div>'
            );

            redirect('admin/hasilpengajuan');
        }
    }
    public function hasilpengajuan()
    {
        $data['title'] = "Hasil Pengajuan";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //$this->load->model('hitung_model');

        $data['data_model'] = $this->data_model->loadPengujian();
        // $this->load->model('hitung_model', 'hm');
        // $this->hm->pengajuan();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/hasilPengajuan', $data);
        $this->load->view('templates/footer');
    }
    public function tes()
    {
        $this->load->model('hitung_model', 'hm');
        $this->hm->pengajuan();
        $this->hm->updatePrediksi();
        $this->hm->alert();
        redirect('admin/hasilpengajuan');
    }
    public function role()
    {
        $data['title'] = "Role";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                New Role Added!!
            </div>'
            );
            redirect('admin/role');
        }
    }
    public function hapus($id)
    {
        $this->load->model('Menu_model', 'role');
        $this->role->hapusrole($id);
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Role Success Delete !!
        </div>'
        );
        redirect('admin/role');
    }
    public function ubahdataRole()
    {
        $this->form_validation->set_rules('role', 'Role', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
            Gagal update role !!
        </div>'
            );
            redirect('admin/role');
        } else {
            $data = array(
                "role" => $_POST['role'],
            );
            $this->db->where('id', $_POST['id']);
            $this->db->update('user_role', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Role Success Update !!
            </div>'
            );
            redirect('admin/role');
        }
    }
    public function roleAccess($role_id)
    {
        $data['title'] = "Role Access";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }
    public function changeAccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_Id' => $role_id,
            'menu_id' => $menu_id
        ];
        $result = $this->db->get_where('user_acces_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_acces_menu', $data);
        } else {
            $this->db->delete('user_acces_menu', $data);
        }
        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success" role="alert">
            Access Changed!
        </div>'
        );
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        checkLogin();
    }
    public function index()
    {
        $data['title'] = "My Profile";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    public function beranda()
    {
        $data['title'] = "Beranda";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/beranda', $data);
        $this->load->view('templates/footer');
    }
    public function pesan()
    {
        $data['title'] = "Whatsapp Message";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['send_message'] = $this->db->get('send_message')->row_array();
        $this->form_validation->set_rules('namaNasabah', 'Nama Nasabah', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/pesan', $data);
            $this->load->view('templates/footer');
        } else {
            $pesan = $this->input->post('pesan');
        }
    }
    public function edit()
    {
        $data['title'] = "Edit Profile";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek jika ada gambar yg akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = 'assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        //menghilangkan foto lama yg akan diganti
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Your profile has been updated!!
            </div>'
            );
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = "Change Password";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[5]|matches[new_password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger" role="alert">
                    Wrong Current Password!!!
                </div>'
                );
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger" role="alert">
                        New Password cannot be the sama as current password!!!
                    </div>'
                    );
                    redirect('user/changepassword');
                } else {
                    //pasw yg bener
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success" role="alert">
                        Password Change!!!
                    </div>'
                    );
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function pengajuan()
    {
        $data['title'] = "Pengajuan Pinjaman";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        //nampilin nama user yg masuk sesuia di DB
        //echo 'Selamat datang ' . $data['user']['name'];
        $this->load->model('data_model', 'user');
        $this->form_validation->set_rules('noKontrak', 'NoKontrak', 'required');
        $this->form_validation->set_rules('namaLengkap', 'NamaLengkap', 'required');
        $this->form_validation->set_rules('kelamin', 'Kelamin', 'required');
        $this->form_validation->set_rules('produk', 'Produk', 'required');
        $this->form_validation->set_rules('pinjaman', 'Pinjaman', 'required');
        $this->form_validation->set_rules('barangJaminan', 'BarangJaminan', 'required');
        $this->form_validation->set_rules('tenor', 'Tenor', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/pengajuan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'no_kontrak' => $this->input->post('noKontrak'),
                'nm_nas' => $this->input->post('namaLengkap'),
                'Kelamin' => $this->input->post('kelamin'),
                'sub_produk' => $this->input->post('produk'),
                'pyd' => $this->input->post('pinjaman'),
                'jaminan' => $this->input->post('barangJaminan'),
                'Golongan' => $this->input->post('pinjaman'),
                'Gol_Tenor' => $this->input->post('tenor'),
                'kol' => $this->input->post('kol')
            ];
            $this->db->insert('data_uji', $data);
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-success" role="alert">
                Berhasil Mengajukan, Tunggu Konfirmasinya!!
            </div>'
            );
            redirect('user/pengajuan');
        }
    }
}

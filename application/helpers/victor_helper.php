<?php
function checkLogin()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $queryMenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $ci->db->get_where('user_acces_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);
        if ($userAccess->num_rows() < 1) {
            redirect('auth/block');
        }
    }
}
function check_access($role_id, $menu_id)
{
    $ci = get_instance();
    $result = $ci->db->get_where('user_acces_menu', [
        'role_id' => $role_id,
        'menu_id' => $menu_id
    ]);
    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

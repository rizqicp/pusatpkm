<?php

function isLoginHelper()
{
    $current = get_instance();
    if (!$current->session->userdata('email')) {
        redirect('auth/login');
    } else {
        $role = $current->session->userdata('role');
        $controller = $current->uri->segment(1);
        if ($role != $controller) {
            redirect($role);
        }
    }
}

function unsetSessionHelper()
{
    $current = get_instance();
    $current->session->unset_userdata('id');
    $current->session->unset_userdata('email');
    $current->session->unset_userdata('password');
    $current->session->unset_userdata('role');
    $current->session->unset_userdata('status');
    $current->session->unset_userdata('nama');
    $current->session->unset_userdata('npm');
    $current->session->unset_userdata('nidn');
    $current->session->unset_userdata('prodi_id');
    $current->session->unset_userdata('user_id');
}

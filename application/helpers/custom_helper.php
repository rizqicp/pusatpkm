<?php

function isloginhelper()
{
    $current = get_instance();
    if (!$current->session->userdata('userEmail')) {
        redirect('auth');
    } else {
        $role = $current->session->userdata('userRole');
        $controller = $current->uri->segment(1);
        if ($role != $controller) {
            redirect($role);
        }
    }
}

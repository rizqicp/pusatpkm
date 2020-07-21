<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLoginHelper();
    }

    public function index()
    {
        redirect('dosen/pengajuan');
    }

    public function profilsaya()
    {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->db->get_where('user', ['user_email' => $this->session->userdata('userEmail')])->row_array();
        $this->load->view('user/profilsaya', $data);
    }
}

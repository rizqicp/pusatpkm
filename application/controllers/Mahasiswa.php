<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isloginhelper();
    }

    public function index()
    {
        redirect('mahasiswa/pengajuan');
    }

    public function pengajuan()
    {
        $data['title'] = 'Pengajuan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('userEmail')])->row_array();
        $this->load->view('user/pengajuan', $data);
    }

    public function profilsaya()
    {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('userEmail')])->row_array();
        $this->load->view('user/profilsaya', $data);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isloginhelper();
    }

    public function index()
    {
        redirect('admin/pengajuan');
    }

    public function pengajuan()
    {
        $data['title'] = 'Pengajuan';
        $data['user'] = $this->db->get_where('user', ['user_email' => $this->session->userdata('userEmail')])->row_array();
        $this->load->view('user/pengajuan', $data);
    }

    public function profilsaya()
    {
        $data['title'] = 'Profil Saya';
        $data['user'] = $this->db->get_where('user', ['user_email' => $this->session->userdata('userEmail')])->row_array();
        $this->load->view('user/profilsaya', $data);
    }

    public function historiproposal()
    {
        $data['title'] = 'historiproposal';
        $data['user'] = $this->db->get_where('user', ['user_email' => $this->session->userdata('userEmail')])->row_array();
        $this->load->view('user/profilsaya', $data);
    }

    public function kelolapengguna()
    {
        $data['title'] = 'Kelola Pengguna';
        $data['user'] = $this->db->get_where('user', ['user_email' => $this->session->userdata('userEmail')])->row_array();
        $this->load->view('user/kelolapengguna', $data);
    }
}

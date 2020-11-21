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
        redirect('dosen/profilsaya');
    }

    public function profilSaya()
    {
        $data['user'] = $this->session->userdata();
        $data['prodi'] = $this->db->get_where('prodi', array('id' => $this->session->userdata('prodi_id')))->result_array()[0];
        $data['fakultas'] = $this->db->get_where('fakultas', array('id' => $data['prodi']['fakultas_id']))->result_array()[0];
        $this->load->view('user/profilsaya', $data);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLoginHelper();
        $this->load->model('pengajuan_model');
    }

    public function index()
    {
        redirect('mahasiswa/profilsaya');
    }

    public function pengajuan()
    {
        $data['user'] = $this->session->userdata();
        $data['pengajuan'] = $this->pengajuan_model->lihatPengajuan($data['user']['npm']);
        $this->load->view('user/mahasiswa/pengajuan', $data);
    }

    public function tambahPengajuan()
    {
        $data['user'] = $this->session->userdata();
        $data['periode'] = $this->db->get('periode')->result_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();
        $data['mahasiswa'] = $this->db->get('mahasiswa')->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();

        if ($this->pengajuan_model->tambahPengajuan() == true) {
            redirect('user/mahasiswa');
        } else {
            $this->load->view('user/mahasiswa/tambahpengajuan', $data);
        }
    }

    public function profilSaya()
    {
        $data['user'] = $this->session->userdata();
        $this->load->view('user/profilsaya', $data);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isloginhelper();
        $this->load->model('pengajuan_model');
    }

    public function index()
    {
        redirect('mahasiswa/pengajuan');
    }

    public function pengajuan()
    {
        $data['title'] = 'Pengajuan';
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('mahasiswa', 'user.id = mahasiswa.user_id');
        $this->db->where('email', $this->session->userdata('userEmail'));
        $data['user'] = $this->db->get()->row_array();

        $this->load->view('user/mahasiswa/pengajuan', $data);
    }

    public function tambahPengajuan()
    {
        $data['title'] = 'Tambah Pengajuan';
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('mahasiswa', 'user.id = mahasiswa.user_id');
        $this->db->where('email', $this->session->userdata('userEmail'));
        $data['user'] = $this->db->get()->row_array();

        $data['periode'] = $this->db->get('periode')->result_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();

        if ($this->pengajuan_model->tambahPengajuan() == true) {
            redirect('user/mahasiswa');
        } else {
            $this->load->view('user/mahasiswa/tambahpengajuan', $data);
        }
    }

    public function profilSaya()
    {
        $data['title'] = 'Profil Saya';
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('mahasiswa', 'user.id = mahasiswa.user_id');
        $this->db->where('email', $this->session->userdata('userEmail'));
        $data['user'] = $this->db->get()->row_array();
        $this->load->view('user/profilsaya', $data);
    }
}

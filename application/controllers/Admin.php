<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLoginHelper();
        $this->load->model('user_model');
    }

    public function index()
    {
        redirect('admin/profilsaya');
    }

    public function profilSaya()
    {
        $data['user'] = $this->session->userdata();
        $this->load->view('user/profilsaya', $data);
    }

    public function kelolaPengajuan()
    {
        $data['user'] = $this->session->userdata();
        $data['pengguna'] = $this->user_model->getalluser();
        $this->load->view('user/admin/kelolauser', $data);
    }

    public function kelolaPengumuman()
    {
        $data['user'] = $this->session->userdata();
        $data['pengguna'] = $this->user_model->getalluser();
        $this->load->view('user/admin/kelolauser', $data);
    }

    public function kelolaUser()
    {
        $data['user'] = $this->session->userdata();
        $data['pengguna'] = $this->user_model->getAllUser();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $this->load->view('user/admin/kelolauser', $data);
    }

    public function tambahUser()
    {
        $data['user'] = $this->session->userdata();
        $data['pengguna'] = $this->user_model->getAllUser();
        $data['prodi'] = $this->db->get('prodi')->result_array();

        if ($this->user_model->tambahUser() == true) {
            redirect('admin/kelolauser');
        } else {
            $this->load->view('user/admin/tambahuser', $data);
        }
    }

    public function hapusUser()
    {
        if ($this->user_model->hapusUser() == true) {
            redirect('admin/kelolauser');
        } else {
            redirect('admin/kelolauser');
        }
    }
}

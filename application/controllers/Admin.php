<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLoginHelper();
    }

    public function index()
    {
        redirect('admin/profilsaya');
    }

    public function profilsaya()
    {
        $data['user'] = $this->session->userdata();
        $this->load->view('user/profilsaya', $data);
    }

    public function historiproposal()
    {
        $data['user'] = $this->session->userdata();
        $this->load->view('user/profilsaya', $data);
    }

    public function kelolauser()
    {
        $this->load->model('user_model');
        $data['user'] = $this->session->userdata();
        $data['pengguna'] = $this->user_model->getalluser();
        $this->load->view('user/admin/kelolauser', $data);
    }
}

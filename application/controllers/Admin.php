<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('user_model');
    }

    public function index()
    {
        $data['title'] = "Dashboard";
        if ($this->session->userdata('userEmail')) {
            $data['user'] = $this->db->get_where('user', ['user_email' => $this->session->userdata('userEmail')])->row_array();
            $this->load->view('admin/dashboard', $data);
        } else {
            redirect('auth');
        }
    }
}

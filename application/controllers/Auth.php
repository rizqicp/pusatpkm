<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function index()
    {
        if ($this->session->userdata('userEmail')) {
            switch ($this->session->userdata('userRole')) {
                case 'Admin':
                    redirect('admin');
                    break;
                case 'Dosen':
                    redirect('dosen');
                    break;
                case 'Mahasiswa':
                    redirect('mahasiswa');
                    break;
                default:
                    redirect('auth/login');
            }
        } else {
            redirect('auth/login');
        }
    }

    public function login()
    {
        $data['title'] = "Login Page";

        if ($this->auth_model->login() == true) {
            redirect('auth');
        } else {
            $this->load->view('auth/login', $data);
        }
    }

    public function logout()
    {
        $this->auth_model->logout();
        redirect('auth/login');
    }

    public function register()
    {
        $data['title'] = "Register Page";

        if ($this->auth_model->register() == true) {
            redirect('auth/login');
        } else {
            $this->load->view('auth/register', $data);
        }
    }

    public function forgot()
    {
        $data['title'] = "Forgot Page";
        $this->load->view('auth/forgot', $data);
    }
}

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
        # auth check
    }

    public function login()
    {
        $data['title'] = "Login Page";

        if ($this->auth_model->login() == true) {
            redirect('auth/login');
        } else {
            $this->load->view('auth/login', $data);
        }
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

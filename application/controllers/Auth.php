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
        isLoginHelper();
    }

    public function login()
    {
        if ($this->auth_model->login() == true) {
            redirect('auth');
        } else {
            $this->load->view('auth/login');
        }
    }

    public function loginBarcode()
    {
        if ($this->auth_model->loginBarcode() == true) {
            redirect('auth');
        } else {
            $this->load->view('auth/login');
        }
    }

    public function logout()
    {
        $this->auth_model->logout();
        redirect('auth/login');
    }

    public function register()
    {
        $data['prodi'] = $this->db->get('prodi')->result_array();

        if ($this->auth_model->register() == true) {
            redirect('auth/login');
        } else {
            $this->load->view('auth/register', $data);
        }
    }

    public function verifikasi()
    {
        if ($this->auth_model->verifikasi() == true) {
            redirect('auth/login');
        } else {
            $this->load->view('auth/register');
        }
    }

    public function forgot()
    {
        if ($this->auth_model->forgot() == true) {
            redirect('auth/forgot');
        } else {
            $this->load->view('auth/forgot');
        }
    }

    public function recovery()
    {
        if (($this->input->get('email')) != null) {
            $this->session->set_userdata([
                'recoverEmail' => $this->input->get('email'),
                'recoverHash' => $this->input->get('hash')
            ]);
        }

        $data['user'] = $this->session->userdata();

        if ($this->auth_model->recovery() == true) {
            redirect('auth/login');
        } elseif (!$this->session->userdata('recoverEmail')) {
            show_404();
        } else {
            $this->load->view('auth/recovery', $data);
        }
    }

    public function editProfil()
    {
        var_dump($this->session->userdata());
        var_dump($_POST);
        die;
    }
}

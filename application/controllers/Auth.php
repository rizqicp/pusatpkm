<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    /*
    |--------------------------------------------------------------------------
    | Auth Constructor
    |--------------------------------------------------------------------------
    |
    | Akan dieksekusi saat pertama kali objek di instansiasi
    |
    | Memanggil model 'auth_model'
    | agar bisa dipakai disemua method controller Auth
    |
    */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model');
    }

    /*
    |--------------------------------------------------------------------------
    | Auth Index
    |--------------------------------------------------------------------------
    |
    | Method default controller Auth
    |
    | Memanggil method 'isloginhelper' dari 'custom_helper'
    | akan mengecek apakah user sudah login
    |
    */
    public function index()
    {
        isLoginHelper();
    }

    /*
    |--------------------------------------------------------------------------
    | Auth Login
    |--------------------------------------------------------------------------
    |
    | Method login pada controller Auth
    |
    | akan memanggil method login pada 'auth_model'
    | untuk mengambil data user yang akan disimpan di session
    |
    */
    public function login()
    {
        if ($this->auth_model->login() == true) {
            redirect('auth');
        } else {
            $this->load->view('auth/login');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Auth Logout
    |--------------------------------------------------------------------------
    |
    | Method logout pada controller Auth
    |
    | akan memanggil method logout pada 'auth_model'
    | untuk mengakhiri sesi user
    |
    */
    public function logout()
    {
        $this->auth_model->logout();
        redirect('auth/login');
    }

    /*
    |--------------------------------------------------------------------------
    | Auth register
    |--------------------------------------------------------------------------
    |
    | Method register pada controller Auth
    |
    | akan mengirim data prodi untuk digunakan oleh view
    | menjalankan fungsi register dari 'auth_model'
    |
    */
    public function register()
    {
        $data['prodi'] = $this->db->get('prodi')->result_array();

        if ($this->auth_model->register() == true) {
            redirect('auth/login');
        } else {
            $this->load->view('auth/register', $data);
        }
    }

    public function forgot()
    {
        $this->load->view('auth/forgot');
    }
}

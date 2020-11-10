<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $this->load->model('home_model');
        $data['pengumuman'] = $this->home_model->lihatPengumuman();
        $data['page'] = $this->home_model->pagination();
        $data['user'] = $this->session->userdata();

        $this->load->view('home/index', $data);
    }

    public function panduan()
    {
        $data['user'] = $this->session->userdata();
        $this->load->view('home/panduan', $data);
    }

    public function profil()
    {
        $data['user'] = $this->session->userdata();
        $this->load->view('home/profil', $data);
    }
}

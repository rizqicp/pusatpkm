<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function index()
    {
        $this->load->model('home_model');
        $data['pengumuman'] = $this->home_model->lihatPengumuman();
        $data['page'] = $this->home_model->pagination();

        $this->load->view('home/index', $data);
    }

    public function panduan()
    {
        $this->load->view('home/panduan');
    }

    public function profil()
    {
        $this->load->view('home/profil');
    }
}

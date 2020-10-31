<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function index()
    {
        $data['pengumuman'] = $this->home_model->lihatPengumuman();
        $data['page'] = $this->home_model->pagination();

        $this->load->view('home/index', $data);
    }
}

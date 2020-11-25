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
        $config['base_url'] = base_url('home/index');
        $config['total_rows'] = count($this->home_model->getAllPengumuman());
        $config['per_page'] = 3;
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['pengumuman'] = $this->home_model->getPengumumanLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
        $data['caption'] = $this->home_model->getCaptionData(count($data['pengumuman']), $this->uri->segment(3), $this->home_model->getAllPengumuman());

        $this->load->view('home/index', $data);
    }

    public function pengumuman()
    {
        $this->load->model('home_model');
        $data['pengumuman'] = $this->home_model->getPengumumanById(intval($_GET['id']));
        $data['user'] = $this->session->userdata();

        $this->load->view('home/pengumuman', $data);
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

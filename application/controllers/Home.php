<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('pengajuan_model');
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

    public function profil()
    {
        $data['user'] = $this->session->userdata();
        $this->load->view('home/profil', $data);
    }

    public function pengajuanBarcode()
    {
        if ($this->home_model->pengajuanBarcode() == true) {
            redirect('home/cekpengajuan');
        } else {
            redirect('home');
        }
    }

    public function cekPengajuan()
    {
        if ($this->session->userdata['npm'] != null) {
            $config['base_url'] = base_url('home/cekpengajuan');
            $config['total_rows'] = count($this->pengajuan_model->getUserPengajuan());
            $config['per_page'] = 10;
            $this->pagination->initialize($config);

            $data['pengajuan'] = $this->pengajuan_model->getUserPengajuanLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
            $data['caption'] = $this->pengajuan_model->getCaptionData(count($data['pengajuan']), $this->uri->segment(3), $this->pengajuan_model->getUserPengajuan());
            $this->load->view('home/pengajuan', $data);
        } else {
            redirect('home');
        }
    }
}

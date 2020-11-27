<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLoginHelper();
        $this->load->model('pengajuan_model');
    }

    public function index()
    {
        redirect('mahasiswa/profilsaya');
    }

    public function profilSaya()
    {
        $data['user'] = $this->session->userdata();
        $data['prodi'] = $this->db->get_where('prodi', array('id' => $this->session->userdata('prodi_id')))->result_array()[0];
        $data['fakultas'] = $this->db->get_where('fakultas', array('id' => $data['prodi']['fakultas_id']))->result_array()[0];
        $this->load->view('user/profilsaya', $data);
    }

    public function pengajuan()
    {
        $config['base_url'] = base_url('mahasiswa/pengajuan');
        $config['total_rows'] = count($this->pengajuan_model->getAllPengajuan());
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['pengajuan'] = $this->pengajuan_model->getPengajuanLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
        $data['caption'] = $this->pengajuan_model->getCaptionData(count($data['pengajuan']), $this->uri->segment(3), $this->pengajuan_model->getAllPengajuan());
        $this->load->view('user/mahasiswa/pengajuan', $data);
    }

    public function tambahPengajuan()
    {
        $data['user'] = $this->session->userdata();
        $this->db->where('status', 'aktif');
        $data['periode'] = $this->db->get('periode')->result_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();
        $data['mahasiswa'] = $this->db->get('mahasiswa')->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();

        if ($this->pengajuan_model->tambahPengajuan() == true) {
            redirect('mahasiswa/pengajuan');
        } else {
            $this->load->view('user/mahasiswa/tambahpengajuan', $data);
        }
    }
}

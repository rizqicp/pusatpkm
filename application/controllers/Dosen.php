<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLoginHelper();
        $this->load->model('pengajuan_model');
        $this->load->model('user_model');
    }

    public function index()
    {
        redirect('dosen/profilsaya');
    }

    public function profilSaya()
    {
        $data['user'] = $this->session->userdata();
        $data['prodi'] = $this->db->get_where('prodi', array('id' => $this->session->userdata('prodi_id')))->result_array()[0];
        $data['fakultas'] = $this->db->get_where('fakultas', array('id' => $data['prodi']['fakultas_id']))->result_array()[0];
        $this->load->view('user/profilsaya', $data);
    }

    public function bimbingan()
    {
        $config['base_url'] = base_url('dosen/bimbingan');
        $config['total_rows'] = count($this->pengajuan_model->getDosenBimbingan());
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['pengajuan'] = $this->pengajuan_model->getDosenBimbinganLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
        for ($i = 0; $i < count($data['pengajuan']); $i++) {
            $data['pengajuan'][$i]['mahasiswa_npm'] = $this->db->get_where('pengusul', array('pengajuan_id' => $data['pengajuan'][$i]['pengajuan_id']))->row_array()['mahasiswa_npm'];
            $data['pengajuan'][$i]['mahasiswa_nama'] = $this->db->get_where('mahasiswa', array('npm' => $data['pengajuan'][$i]['mahasiswa_npm']))->row_array()['nama'];
        }
        $data['caption'] = $this->pengajuan_model->getCaptionData(count($data['pengajuan']), $this->uri->segment(3), $this->pengajuan_model->getDosenBimbingan());
        $this->load->view('user/dosen/bimbingan', $data);
    }

    public function ulasan()
    {
        $config['base_url'] = base_url('dosen/ulasan');
        $config['total_rows'] = count($this->pengajuan_model->getDosenUlasan());
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['pengajuan'] = $this->pengajuan_model->getDosenUlasanLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
        $data['caption'] = $this->pengajuan_model->getCaptionData(count($data['pengajuan']), $this->uri->segment(3), $this->pengajuan_model->getDosenUlasan());
        $this->load->view('user/dosen/ulasan', $data);
    }

    public function detailPengajuan()
    {
        if (isset($_GET['id'])) {
            $this->session->set_userdata(array('detailpengajuanid' => $_GET['id']));
        }
        $data['user'] = $this->session->userdata();
        $data['pengajuan'] = $this->pengajuan_model->getPengajuanById($this->session->userdata('detailpengajuanid'));
        $data['kelompok'] = $this->user_model->getKelompok($data['pengajuan']);
        $data['keterangan'] = $this->pengajuan_model->getKeterangan($data['pengajuan']);
        $data['tahap'] = $this->db->get('tahap')->result_array();
        if ($data['pengajuan']['tahap_id'] >= 2) {
            $data['pengulas'] = $this->pengajuan_model->getPengulas($this->session->userdata('detailpengajuanid'));
        }
        if ($this->pengajuan_model->kirimUlasan($this->session->userdata('detailpengajuanid'),$this->session->userdata('nidn')) == true) {
            redirect('dosen/ulasan');
        } else {
            // var_dump($data);die;
            $this->load->view('user/dosen/detailpengajuan', $data);
        }
    }

    public function historiProposal()
    {
        $config['base_url'] = base_url('dosen/historiproposal');
        $config['total_rows'] = count($this->pengajuan_model->getFinishPengajuan());
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['pengajuan'] = $this->pengajuan_model->getFinishPengajuanLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
        $data['caption'] = $this->pengajuan_model->getCaptionData(count($data['pengajuan']), $this->uri->segment(3), $this->pengajuan_model->getFinishPengajuan());
        $this->load->view('user/historiproposal', $data);
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
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
        $config['total_rows'] = count($this->pengajuan_model->getUserPengajuan());
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['pengajuan'] = $this->pengajuan_model->getUserPengajuanLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
        $data['caption'] = $this->pengajuan_model->getCaptionData(count($data['pengajuan']), $this->uri->segment(3), $this->pengajuan_model->getUserPengajuan());
        $this->load->view('user/mahasiswa/pengajuan', $data);
    }

    public function tambahPengajuan()
    {
        $data['user'] = $this->session->userdata();
        $data['periode'] = $this->db->get_where('periode', array('status' => 'aktif'))->row_array();
        $data['hibah'] = $this->db->get_where('hibah', array('status' => 'aktif'))->result_array();
        $data['mahasiswa'] = $this->db->get('mahasiswa')->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();

        if ($this->pengajuan_model->tambahPengajuan() == true) {
            redirect('mahasiswa/pengajuan');
        } else {
            $this->load->view('user/mahasiswa/tambahpengajuan', $data);
        }
    }

    public function editPengajuan()
    {
        if (isset($_GET['id'])) {
            $this->session->set_userdata(array('editpengajuanid' => $_GET['id']));
        }
        $data['user'] = $this->session->userdata();
        $this->db->where('status', 'aktif');
        $data['periode'] = $this->db->get('periode')->row_array();
        $data['hibah'] = $this->db->get('hibah')->result_array();
        $data['mahasiswa'] = $this->db->get('mahasiswa')->result_array();
        $data['dosen'] = $this->db->get('dosen')->result_array();
        $data['editpengajuan'] = $this->pengajuan_model->getPengajuanById($this->session->userdata('editpengajuanid'));

        if ($this->pengajuan_model->editPengajuan($data['editpengajuan']) == true) {
            redirect('mahasiswa/pengajuan');
        } else {
            $this->load->view('user/mahasiswa/editpengajuan', $data);
        }
    }

    public function hapusPengajuan()
    {
        if ($this->pengajuan_model->hapusPengajuan() == true) {
            redirect('mahasiswa/pengajuan');
        } else {
            redirect('mahasiswa/pengajuan');
        }
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
        if ($data['pengajuan']['tahap_id'] >= 2) {
            $data['pengulas'] = $this->pengajuan_model->getPengulas($this->session->userdata('detailpengajuanid'));
            $data['ulasan'] = $this->db->get_where('ulasan', array('dosen_nidn' => $data['pengulas']['nidn']))->row_array();
        }

        if ($this->pengajuan_model->kirimRevisi($data['pengajuan']) == true) {
            redirect('mahasiswa/detailpengajuan');
        } else {
            $this->load->view('user/mahasiswa/detailpengajuan', $data);
        }
    }

    public function unggahLaporan()
    {
        if (isset($_GET['id'])) {
            $this->session->set_userdata(array('detailpengajuanid' => $_GET['id']));
        }
        $data['user'] = $this->session->userdata();
        $data['pengajuan'] = $this->pengajuan_model->getPengajuanById($this->session->userdata('detailpengajuanid'));

        if ($this->pengajuan_model->unggahLaporan($data['pengajuan']) == true) {
            redirect('mahasiswa/detailpengajuan');
        } else {
            redirect('mahasiswa/detailpengajuan');
        }
    }

    public function historiProposal()
    {
        $config['base_url'] = base_url('mahasiswa/historiproposal');
        $config['total_rows'] = count($this->pengajuan_model->getFinishPengajuan());
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['pengajuan'] = $this->pengajuan_model->getFinishPengajuanLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
        $data['caption'] = $this->pengajuan_model->getCaptionData(count($data['pengajuan']), $this->uri->segment(3), $this->pengajuan_model->getFinishPengajuan());
        $this->load->view('user/historiproposal', $data);
    }
}

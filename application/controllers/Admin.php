<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLoginHelper();
        $this->load->model('user_model');
        $this->load->model('pengumuman_model');
        $this->load->model('pengajuan_model');
        $this->load->model('kategori_model', 'kategori');
        $this->load->model('hibah_model', 'hibah');
        $this->load->model('periode_model', 'periode');
        $this->load->library('datatables');
    }

    public function index()
    {
        redirect('admin/profilsaya');
    }

    public function profilSaya()
    {
        $data['user'] = $this->session->userdata();
        $this->load->view('user/profilsaya', $data);
    }

    // method User
    public function kelolaUser()
    {
        $config['base_url'] = base_url('admin/kelolauser');
        $config['total_rows'] = $this->db->get('user')->num_rows();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['pengguna'] = $this->user_model->getUserLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
        $data['caption'] = $this->user_model->getCaptionData(count($data['pengguna']), $this->uri->segment(3), $this->user_model->getAllUser());
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $this->load->view('user/admin/kelolauser', $data);
    }

    public function tambahUser()
    {
        $data['user'] = $this->session->userdata();
        $data['pengguna'] = $this->user_model->getAllUser();
        $data['prodi'] = $this->db->get('prodi')->result_array();
        $data['fungsional'] = $this->db->get('fungsional')->result_array();

        if ($this->user_model->tambahUser() == true) {
            redirect('admin/kelolauser');
        } else {
            $this->load->view('user/admin/tambahuser', $data);
        }
    }

    public function editUser()
    {
        if (isset($_GET['id'])) {
            $this->session->set_userdata(array('edituserid' => $_GET['id']));
        }
        $data['user'] = $this->session->userdata();
        $data['pengguna'] = $this->user_model->getAllUser();
        $data['edituser'] = $this->user_model->getUserById($this->session->userdata('edituserid'));
        $data['prodi'] = $this->db->get_where('prodi', array('id' => $data['edituser']['prodi_id']))->result_array()[0];
        $data['fungsional'] = $this->db->get_where('fungsional', array('id' => $data['edituser']['fungsional_id']))->result_array()[0];
        $data['fakultas'] = $this->db->get_where('fakultas', array('id' => $data['prodi']['fakultas_id']))->result_array()[0];

        if ($this->user_model->editUser($data['edituser']) == true) {
            redirect('admin/kelolauser');
        } else {
            $this->load->view('user/admin/edituser', $data);
        }
    }

    public function hapusUser()
    {
        if ($this->user_model->hapusUser() == true) {
            redirect('admin/kelolauser');
        } else {
            redirect('admin/kelolauser');
        }
    }

    // method pengajuan
    public function kelolaPengajuan()
    {
        $config['base_url'] = base_url('admin/kelolapengajuan');
        $config['total_rows'] = count($this->pengajuan_model->getAllPengajuan());
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['pengajuan'] = $this->pengajuan_model->getAllPengajuanLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
        $data['caption'] = $this->pengajuan_model->getCaptionData(count($data['pengajuan']), $this->uri->segment(3), $this->pengajuan_model->getAllPengajuan());
        $this->load->view('user/admin/kelolapengajuan', $data);
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
        }
        if ($this->pengajuan_model->kirimAkun($this->session->userdata('detailpengajuanid')) == true) {
            redirect('admin/detailPengajuan');
        } else {
            $this->load->view('user/admin/detailpengajuan', $data);
        }
    }

    public function tugaskanPengajuan()
    {
        $config['base_url'] = base_url('admin/tugaskanpengajuan');
        $config['total_rows'] = $this->db->get('dosen')->num_rows();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['dosen'] = $this->user_model->getDosenLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
        $data['caption'] = $this->user_model->getCaptionData(count($data['dosen']), $this->uri->segment(3), $this->user_model->getAllDosen());
        $data['pengajuan'] = $this->pengajuan_model->getPengajuanById($this->session->userdata('detailpengajuanid'));

        if ($this->pengajuan_model->tugaskanPengajuan() == true) {
            redirect('admin/detailPengajuan');
        } else {
            $this->load->view('user/admin/tugaskanpengajuan', $data);
        }
    }

    public function ubahStatusPengajuan()
    {
        if($this->pengajuan_model->ubahStatusPengajuan()){
            redirect('admin/detailPengajuan');
        }else {
            redirect('admin/detailPengajuan');
        }
    }

    public function hapusPengajuan()
    {
        if ($this->pengajuan_model->hapusPengajuan() == true) {
            redirect('admin/kelolapengajuan');
        } else {
            redirect('admin/kelolapengajuan');
        }
    }

    public function historiProposal()
    {
        $config['base_url'] = base_url('admin/historiproposal');
        $config['total_rows'] = count($this->pengajuan_model->getFinishPengajuan());
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['pengajuan'] = $this->pengajuan_model->getFinishPengajuanLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
        $data['caption'] = $this->pengajuan_model->getCaptionData(count($data['pengajuan']), $this->uri->segment(3), $this->pengajuan_model->getFinishPengajuan());
        $this->load->view('user/historiproposal', $data);
    }

    // method pengumuman
    public function kelolaPengumuman()
    {
        $config['base_url'] = base_url('admin/kelolapengumuman');
        $config['total_rows'] = $this->db->get('pengumuman')->num_rows();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['pengumuman'] = $this->pengumuman_model->getPengumumanLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
        $data['caption'] = $this->user_model->getCaptionData(count($data['pengumuman']), $this->uri->segment(3), $this->pengumuman_model->getAllPengumuman());
        $this->load->view('user/admin/kelolapengumuman', $data);
    }

    public function tambahPengumuman()
    {
        $data['user'] = $this->session->userdata();

        if ($this->pengumuman_model->tambahPengumuman() == true) {
            redirect('admin/kelolapengumuman');
        } else {
            $this->load->view('user/admin/tambahpengumuman', $data);
        }
    }

    public function hapusPengumuman()
    {
        if ($this->pengumuman_model->hapusPengumuman() == true) {
            redirect('admin/kelolapengumuman');
        } else {
            redirect('admin/kelolapengumuman');
        }
    }

    public function editPengumuman()
    {
        if (isset($_GET['id'])) {
            $this->session->set_userdata(array('editpengumumanid' => $_GET['id']));
        }
        $data['user'] = $this->session->userdata();
        $data['editpengumuman'] = $this->pengumuman_model->getPengumumanById($this->session->userdata('editpengumumanid'));

        if ($this->pengumuman_model->editPengumuman($data['editpengumuman']) == true) {
            redirect('admin/kelolapengumuman');
        } else {
            $this->load->view('user/admin/editpengumuman', $data);
        }
    }

    // method kategori
    public function kelolaKategori()
    {
        $data['user'] = $this->session->userdata();
        $this->load->view('user/admin/kelola_kategori', $data);
    }

    public function getKategori()
    {
        return ($this->kategori->dataTables());
    }

    public function tambahKategori()
    {
        $data['user'] = $this->session->userdata();

        if ($this->kategori->tambahKategori() == true) {
            redirect('admin/kelolakategori');
        } else {
            $this->load->view('user/admin/tambah_kategori', $data);
        }
    }

    public function ubahKategori()
    {
        if (isset($_GET['id'])) {
            $this->session->set_userdata(array('kategoriId' => $_GET['id']));
        }
        $data['user'] = $this->session->userdata();
        $data['kategori'] = $this->kategori->getById($this->session->userdata('kategoriId'));

        if ($this->kategori->ubahKategori($data['kategori']) == TRUE || $data['kategori']==NULL) {
            redirect('admin/kelolakategori');
        } else {
            $this->load->view('user/admin/ubah_kategori', $data);
        }
    }

    public function hapusKategori($idKategori)
    {
        if ($this->kategori->hapusKategori($idKategori) == true) {
            redirect('admin/kelolakategori');
        } else {
            redirect('admin/kelolakategori');
        }
    }

    // method hibah
    public function kelolaHibah()
    {
        $data['user'] = $this->session->userdata();
        $this->load->view('user/admin/kelola_hibah', $data);
    }

    public function getHibah()
    {
        return ($this->hibah->dataTables());
    }

    public function tambahHibah()
    {
        $data['user'] = $this->session->userdata();
        $data['kategori'] = $this->kategori->getAll();

        if ($this->hibah->tambahhibah() == true) {
            redirect('admin/kelolahibah');
        } else {
            $this->load->view('user/admin/tambah_hibah', $data);
        }
    }

    public function ubahHibah()
    {
        if (isset($_GET['id'])) {
            $this->session->set_userdata(array('hibahId' => $_GET['id']));
        }
        $data['user'] = $this->session->userdata();
        $data['kategori'] = $this->kategori->getAll();
        $data['hibah'] = $this->hibah->getById($this->session->userdata('hibahId'));

        if ($this->hibah->ubahHibah($data['hibah']) == TRUE || $data['hibah']==NULL) {
            redirect('admin/kelolahibah');
        } else {
            $this->load->view('user/admin/ubah_hibah', $data);
        }
    }

    public function hapushibah($id)
    {
        $data = $this->hibah->getById($id);
        if ($this->hibah->hapushibah($data) == true) {
            redirect('admin/kelolahibah');
        } else {
            redirect('admin/kelolahibah');
        }
    }

    // method periode
    public function kelolaPeriode()
    {
        $data['user'] = $this->session->userdata();
        $this->load->view('user/admin/kelola_periode', $data);
    }

    public function getPeriode()
    {
        return ($this->periode->dataTables());
    }

    public function tambahPeriode()
    {
        $data['user'] = $this->session->userdata();

        if ($this->periode->tambahPeriode() == true) {
            redirect('admin/kelolaperiode');
        } else {
            $this->load->view('user/admin/tambah_periode', $data);
        }
    }

    public function ubahPeriode()
    {
        if (isset($_GET['id'])) {
            $this->session->set_userdata(array('periodeId' => $_GET['id']));
        }
        $data['user'] = $this->session->userdata();
        $data['periode'] = $this->periode->getById($this->session->userdata('periodeId'));

        if ($this->periode->ubahPeriode($data['periode']) == TRUE || $data['periode']==NULL) {
            redirect('admin/kelolaperiode');
        } else {
            $this->load->view('user/admin/ubah_periode', $data);
        }
    }

    public function hapusPeriode($id)
    {
        $data = $this->periode->getById($id);
        if ($this->periode->hapusPeriode($data) == true) {
            redirect('admin/kelolaperiode');
        } else {
            redirect('admin/kelolaperiode');
        }
    }
}

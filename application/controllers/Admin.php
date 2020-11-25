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

    public function kelolaPengajuan()
    {
        $data['user'] = $this->session->userdata();
        $data['pengguna'] = $this->user_model->getalluser();
        $this->load->view('user/admin/kelolauser', $data);
    }

    public function kelolaPengumuman()
    {
        $config['base_url'] = base_url('admin/kelolapengumuman');
        $config['total_rows'] = $this->db->get('pengumuman')->num_rows();
        $config['per_page'] = 10;
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['pengumuman'] = $this->pengumuman_model->getPengumumanLimit($config['per_page'], $this->uri->segment(3), $this->input->post('search'));
        $data['caption'] = $this->pengumuman_model->getCaptionData(count($data['pengumuman']), $this->uri->segment(3), $this->pengumuman_model->getAllPengumuman());
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
}

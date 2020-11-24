<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLoginHelper();
        $this->load->model('user_model');
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
        $data['user'] = $this->session->userdata();
        $data['pengguna'] = $this->user_model->getalluser();
        $this->load->view('user/admin/kelolauser', $data);
    }

    public function kelolaUser()
    {
        $config['base_url'] = base_url('admin/kelolauser');
        $config['total_rows'] = $this->db->get('user')->num_rows();
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<nav><ul class="pagination pagination-sm justify-content-center">';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_link'] = 'Pertama';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_link'] = 'Terakhir';
        $config['last_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_link'] = '&raquo';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_close'] = '</ul></nav>';
        $config['attributes'] = array('class' => 'page-link');
        $this->pagination->initialize($config);

        $data['user'] = $this->session->userdata();
        $data['pengguna'] = $this->user_model->getUserLimit($config['per_page'], $this->uri->segment(3));
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

        if ($this->user_model->editUser($data) == true) {
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

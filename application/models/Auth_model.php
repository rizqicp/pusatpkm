<?php defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function login()
    {
        $this->form_validation->set_rules('userEmail', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('userPassword', 'Password', 'required|trim');

        if ($this->form_validation->run() == true) {
            $userEmail = $this->input->post('userEmail');
            $userPassword = $this->input->post('userPassword');
            $user = $this->db->get_where('user', ['user_email' => $userEmail])->row_array();

            if ($user) {
                if ($user['user_active'] == 1) {
                    if (password_verify($userPassword, $user['user_password'])) {
                        $data = [
                            'userEmail' => $user['user_email'],
                            'userRole' => $user['user_role']
                        ];
                        $this->session->set_userdata($data);
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil login!</div>');
                        return true;
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                        return false;
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Email is not activated!</div>');
                    return false;
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
                return false;
            }
        } else {
            return false;
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('userEmail');
        $this->session->unset_userdata('userRole');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Logout!</div>');
    }

    public function register()
    {
        $this->form_validation->set_rules('userName', 'Name', 'required|trim');
        $this->form_validation->set_rules('userEmail', 'Email', 'required|trim|valid_email|is_unique[user.user_email]', ['is_unique' => 'This email has already registered!']);
        $this->form_validation->set_rules('userPassword', 'Password', 'required|trim|min_length[6]|matches[repeatPassword]', ['matches' => 'Password dont match!', 'min_length' => 'Password too short!']);
        $this->form_validation->set_rules('repeatPassword', 'Repeat', 'required|trim|matches[userPassword]');

        if ($this->form_validation->run() == true) {
            $data = [
                'user_id' => null,
                'user_name' => htmlspecialchars($this->input->post('userName', true)),
                'user_email' => htmlspecialchars($this->input->post('userEmail', true)),
                'user_password' => password_hash($this->input->post('userPassword'), PASSWORD_DEFAULT),
                'user_role' => 'mahasiswa',
                'user_active' => '0'
            ];
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun berhasil dibuat!</div>');
            return true;
        } else {
            return false;
        }
    }

    public function forgot()
    {
    }
}
